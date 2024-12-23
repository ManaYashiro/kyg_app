<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointments;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class  AppointmentListController extends Controller
{
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
        $appointments = Appointments::where('user_id', Auth::user()->id);

        // 予約番号の並び替え
        if ($request->filled('sort_number')) {
            $appointments->orderBy('reservation_number', $request->sort_number); // 'desc' または 'asc'
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
        // Find the appointment by ID
        $appointment = Appointments::where('user_id', Auth::user()->id)->where('id', $id)->first();

        // reservation_datetimeを秒数を除いてフォーマット変更
        $appointment->reservation_datetime = Carbon::parse($appointment->reservation_datetime)->format('Y/m/d H:i');

        // 予約詳細ビューにデータを渡す
        return view('appointmentDetails', compact('appointment'));
    }

    /**
     * 予約削除
     */
    public function destroy($id)
    {
        // 指定されたIDのユーザーを取得
        $Appointment = Appointments::findOrFail($id);

        // ユーザー削除
        $Appointment->delete();

        // 成功メッセージを表示してリストにリダイレクト
        return redirect()->route('appointmentList.index')->with('success', '予約をキャンセルしました。');
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

        $startOfWeek = $currentDate->startOfWeek(config('appointment.day_start'));

        $endOfWeek = $startOfWeek->copy()->endOfWeek(config('appointment.day_end'));

        // Query appointments within the weekly date range
        $appointments = Appointments::whereBetween('reservation_datetime', [$startOfWeek, $endOfWeek])->get();

        $events = [];
        $existingAppointments = [];
        $startTime = Carbon::createFromFormat('H:i:s', config('appointment.time_start'));
        $endTime = Carbon::createFromFormat('H:i:s', config('appointment.time_end'));
        $intervalTime = Carbon::parse(config('appointment.time_interval'));
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

            while ($currentTime <= $endTime) {

                $cloneCurrentTime = clone $currentTime;
                $logTimeStart = $cloneCurrentTime->format('H:i:s');
                $logTimeEnd = $cloneCurrentTime->addMinutes($intervalTime)->format('H:i:s');

                $dateTimeStart = $currentDate->format('Y-m-d') . ' ' . $logTimeStart;
                $dateTimeEnd = $currentDate->format('Y-m-d') . ' ' . $logTimeEnd;

                $start = Carbon::parse($dateTimeStart)->format('Y-m-d\TH:i:s');
                $end = Carbon::parse($dateTimeEnd)->format('Y-m-d\TH:i:s');

                $currentTime->addMinutes($intervalTime);

                if ((int) $dayIndex === (int) config('appointment.break_day')) {
                    // 休日
                    array_push($events, $this->breakEvent($start, $end));
                } else if ($logTimeStart === config('appointment.break_time')) {
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
        return response()->json([
            'date' => Carbon::now()->addDays(30)->format('Y-m-d'),
        ]);
    }

    public function hasExistingAppointment($existingAppointments, $start)
    {
        return in_array($start, $existingAppointments);
    }

    public function reservedEvent($start, $end): array
    {
        return [
            // 'title' => '✖',
            'type' => 'reserved',
            'start' => $start,
            'end' => $end,
            'textColor' => '#999999',
        ];
    }

    public function unreservedEvent($start, $end): array
    {
        return [
            // 'title' => '〇',
            'type' => 'unreserved',
            'start' => $start,
            'end' => $end,
            'textColor' => '#2266dd',
        ];
    }

    public function breakEvent($start, $end): array
    {
        return [
            // 'title' => '',
            'type' => 'break',
            'start' => $start,
            'end' => $end,
        ];
    }
}
