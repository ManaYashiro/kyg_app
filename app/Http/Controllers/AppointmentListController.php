<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;
use App\Models\ReservationTask;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class  AppointmentListController extends Controller
{
    public $day_start;
    public $day_end;
    public $time_start;
    public $time_end;
    public $time_interval;
    public $break_day;
    public $break_time;

    public function __construct()
    {
        $this->day_start = config('appointment.day_start');
        $this->day_end = config('appointment.day_end');
        $this->time_start = config('appointment.time_start');
        $this->time_end = config('appointment.time_end');
        $this->time_interval = config('appointment.time_interval');
        $this->break_day = config('appointment.break_day');
        $this->break_time = config('appointment.break_time');
    }


    /**
     * Display the appointments list with optional role filtering.
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
        $currentDateTime = now(); // 現在の日時を取得

        // フィルタとソート
        $appointments = Appointments::join('reservation_tasks', 'appointments.reservation_task_id', '=', 'reservation_tasks.id')
            ->where('appointments.user_id', Auth::user()->id)
            ->select('appointments.*', 'reservation_tasks.reservation_name as reservation_name');

        // 予約番号の並び替え
        if ($request->filled('sort_number')) {
            $appointments = $appointments->orderBy('reservation_number', $request->sort_number); // 'desc' または 'asc'
        }

        $appointments = $appointments->get();

        $filteredGroupedAppointments = $appointments->filter(function ($appointment) {
            return Carbon::parse($appointment->reservation_datetime)
                ->setTimezone('Asia/Tokyo')
                ->gte(Carbon::now('Asia/Tokyo'));
        });

        // 予約日時のフォーマット変更（時間部分のみ）
        $filteredGroupedAppointments = $filteredGroupedAppointments->map(function ($appointment) {
            // フォーマットして新しいプロパティを追加
            $appointment->reservation_datetime = Carbon::parse($appointment->reservation_datetime)
                ->setTimezone('Asia/Tokyo')
                ->format('Y-m-d H:i');  // '2024-12-20 10:00' の形式
            return $appointment;
        });

        // ビューにデータを渡す
        return view('appointmentHistory', compact('appointments', 'filteredGroupedAppointments'));
    }

    /**
     * 予約詳細画面
     */

    public function edit($id)
    {
        // 特定の予約を取得する
        $appointment = Appointments::join('reservation_tasks', 'appointments.reservation_task_id', '=', 'reservation_tasks.id')
            ->where('appointments.user_id', Auth::user()->id)
            ->where('appointments.id', $id)
            ->select('appointments.*', 'reservation_tasks.reservation_name as reservation_name')
            ->first();

        // reservation_datetimeを秒数を除いてフォーマット変更
        $appointment->reservation_datetime = Carbon::parse($appointment->reservation_datetime)->format('Y/m/d H:i');

        // 予約詳細ビューにデータを渡す
        return view('appointmentDetails', compact('appointment'));
    }

    /**
     * 予約確認
     */

    public function confirm(Request $request)
    {
        //バリデーション
        $rules = [
            'inspection_due_date' => 'required|date_format:Y/m/d',
        ];
        // バリデーションエラーメッセージ
        $errorMessages = [
            'inspection_due_date' => '車検満期日は、正しい日付ではありません。',
        ];

        // バリデーションの実行
        $validatedData = $request->validate($rules, $errorMessages);

        $appointment = $request->all();

        session([
            'inspection_due_date' => $request->input('inspection_due_date'),
        ]);

        // 確認画面に必要なデータを渡す
        return view('appointmentDetailsConfirm', compact('appointment'));
    }

    /**
     * 予約確定
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        // 指定されたIDのユーザーを取得
        $appointment = Appointments::where('appointments.id', $id)->first();
        $appointment->update($request->all());

        // 成功メッセージを表示してリストにリダイレクト
        return redirect()->route('reservations.index');
    }

    /**
     * 予約削除
     */
    public function destroy($id)
    {
        // 指定されたIDのユーザーを取得
        $appointment = Appointments::findOrFail($id);
        //論理削除
        $appointment->delete();
    }

    public function events(Request $request)
    {
        // Validate the month and year parameters
        $request->validate([
            'day' => 'required|integer|between:1,31', // Ensure month is a valid number between 1 and 12
            'month' => 'required|integer|between:1,12', // Ensure month is a valid number between 1 and 12
            'year' => 'required|integer|min:1000|max:9999', // Ensure the year is a valid 4-digit year
        ]);

        // Get the month and year from the request
        $day = $request->day;
        $month = $request->month;
        $year = $request->year;

        // Get the current date using the provided year, month, and day
        $currentDate = Carbon::create($year, $month, $day);
        $startOfWeek = $currentDate->startOfWeek($this->day_start);
        $endOfWeek = $startOfWeek->copy()->endOfWeek($this->day_end);

        // Query appointments within the weekly date range
        $appointments = Appointments::whereBetween('reservation_datetime', [$startOfWeek, $endOfWeek])->get();

        $events = [];
        $existingAppointments = [];
        $startTime = Carbon::createFromFormat('H:i:s', $this->time_start);
        $endTime = Carbon::createFromFormat('H:i:s', $this->time_end);
        $intervalTime = Carbon::parse($this->time_interval);
        $intervalTime = $intervalTime->hour * 60 + $intervalTime->minute;
        // $intervalMinutes = abs($intervalTime->diffInMinutes(Carbon::createFromFormat('H:i:s', '00:00:00')));

        // add reserved events
        foreach ($appointments as $key => $appointment) {
            $start = Carbon::parse($appointment->reservation_datetime)->format('Y-m-d\TH:i:s');
            $end = Carbon::parse($appointment->reservation_datetime)->addMinutes($intervalTime)->format('Y-m-d\TH:i:s');

            // already has an appointment time
            $existingAppointments[] = $start;

            // 予約済み
            array_push($events, $this->reservedEvent($start, $end));
        }

        // add unreserved events
        // Loop through the dates
        $currentDate = $startOfWeek;
        $dayIndex = 0;
        while ($currentDate <= $endOfWeek) {

            $currentTime = clone $startTime;

            // 09:00:00 ~ 18:00:00
            while ($currentTime < $endTime) {

                $cloneCurrentTime = clone $currentTime;
                $logTimeStart = $cloneCurrentTime->format('H:i:s');
                $logTimeEnd = $cloneCurrentTime->addMinutes($intervalTime)->format('H:i:s');

                $dateTimeStart = $currentDate->format('Y-m-d') . ' ' . $logTimeStart;
                $dateTimeEnd = $currentDate->format('Y-m-d') . ' ' . $logTimeEnd;

                $start = Carbon::parse($dateTimeStart)->format('Y-m-d\TH:i:s');
                $end = Carbon::parse($dateTimeEnd)->format('Y-m-d\TH:i:s');

                $currentTime->addMinutes($intervalTime);

                if ($currentDate->dayOfWeek() === (int) $this->break_day) {
                    // 休日
                    array_push($events, $this->breakEvent($start, $end));
                } else if ($logTimeStart === $this->break_time) {
                    // 休憩
                    array_push($events, $this->breakEvent($start, $end));
                } else if (!$this->hasExistingAppointment($existingAppointments, $start)) {
                    // 未予約
                    array_push($events, $this->unreservedEvent($start, $end));
                } else {
                    // 予約済み
                    // 予約イベントはすでに追加されています
                }
            }

            $currentDate->addDay(); // Increment the date by one day
            $dayIndex++;
        }

        return response()->json($events); // Return the results as JSON
    }

    public function gotoNearestUnreserved(Request $request)
    {
        $currentDate = Carbon::now();
        $startOfWeek = $currentDate->startOfWeek($this->day_start);
        $endOfWeek = $startOfWeek->copy()->endOfWeek($this->day_end);

        $earliestAvailableDate = null;
        $foundAvailable = false;
        $reservation_date = 0;

        while (!$foundAvailable) {

            // Find the earliest date with less than 9 reservations, from 09:00 to 18:00 except 12:00
            $firstAvailableDate = $this->firstAvailableDate($startOfWeek, $endOfWeek);
            $earliestAvailableDate = $this->earliestAvailableDate($startOfWeek, $endOfWeek);

            if (!empty($firstAvailableDate) && $firstAvailableDate->reservation_date) {
                $foundAvailable = true;
                $reservation_date = $firstAvailableDate->reservation_date;
                break;
            }

            // Found earliest date then exit;
            if (!empty($earliestAvailableDate) && $earliestAvailableDate->reservation_date) {
                $foundAvailable = true;
                $reservation_date = $earliestAvailableDate->reservation_date;
                break;
            }

            // Move to the next week until we reach unreserved date
            // Add 7 days to the current date
            $updatedDate = $currentDate->addDays(7);

            // Set start and end of the week based on the updated date
            $startOfWeek = $updatedDate->startOfWeek($this->day_start);
            $endOfWeek = $startOfWeek->copy()->endOfWeek($this->day_end);
        }

        return response()->json([
            'date' => $reservation_date,
        ]);
    }

    private function hasExistingAppointment($existingAppointments, $start)
    {
        return in_array($start, $existingAppointments);
    }

    private function reservedEvent($start, $end): array
    {
        return [
            // 'title' => '✖',
            'type' => 'reserved',
            'start' => $start,
            'end' => $end,
            'textColor' => '#999999',
        ];
    }

    private function unreservedEvent($start, $end): array
    {
        return [
            // 'title' => '〇',
            'type' => 'unreserved',
            'start' => $start,
            'end' => $end,
            'textColor' => '#2266dd',
        ];
    }

    private function breakEvent($start, $end): array
    {
        return [
            // 'title' => '',
            'type' => 'break',
            'start' => $start,
            'end' => $end,
        ];
    }

    private function firstAvailableDate($startOfWeek, $endOfWeek): null|object
    {
        $now = Carbon::now();
        $currentDate = Carbon::parse($startOfWeek);

        while ($currentDate <= $endOfWeek) {
            // skip break day
            if ($this->break_day == $currentDate->dayOfWeek()) {
                $currentDate->addDay();
                continue;
            }
            // skip previous days
            if ($currentDate >= $now) {
                $reservationCount = Appointments::whereDate('reservation_datetime', $currentDate->format('Y-m-d'))
                    ->whereNull('deleted_at')
                    ->count();

                if ($reservationCount === 0) {
                    return (object) ['reservation_date' => $currentDate->format('Y-m-d')];
                }
            }
            $currentDate->addDay();
        }

        return null;  // No available date
    }


    private function earliestAvailableDate($startOfWeek, $endOfWeek): null|object
    {

        $break_day = Carbon::parse($startOfWeek)->next((int) $this->break_day);
        return Appointments::selectRaw("
                CAST(reservation_datetime AS DATE) as reservation_date,
                COUNT(*) as reservation_count
            ")
            ->whereBetween('reservation_datetime', [$startOfWeek, $endOfWeek])
            ->whereRaw('CAST(reservation_datetime AS DATE) != ?', [$break_day])
            ->whereNull('deleted_at')
            ->groupByRaw("CAST(reservation_datetime AS DATE)")
            ->havingRaw('COUNT(*) < 9')
            ->orderByRaw("CAST(reservation_datetime AS DATE) ASC")
            ->first();
    }
}
