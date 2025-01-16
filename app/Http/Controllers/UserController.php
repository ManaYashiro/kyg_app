<?php

namespace App\Http\Controllers;

use App\Enums\FormTypeEnum;
use App\Enums\SubmitTypeEnum;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Requests\RegisteredUserRequest;
use App\Http\Requests\UserVehicleRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{

    protected static $title = "会員";
    /**
     * Display the user list with optional role filtering.
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = $this->filterUsers($request);

        // 絞り込んだユーザーを5件ずつページネートして取得
        $users = $query->paginate(config("app.pagination.admin")); // ページごとに5件表示

        // ビューにユーザー情報を渡す
        return view('admin.userLists.userList', compact('users'));
    }

    /**
     * ユーザー編集
     */
    public function create()
    {
        $formType = FormTypeEnum::ADMIN_REGISTER->value;
        $submitType = SubmitTypeEnum::SUBMIT->value;
        $route = route('admin.userList.store');
        $method = "POST";
        return view('admin.userLists.userCreate', compact('route', 'method', 'formType', 'submitType')); // 編集ページにユーザー情報を渡す
    }

    /**
     * ユーザー更新
     */
    public function store(RegisteredUserRequest $request): RedirectResponse
    {
        $registerUser = new RegisteredUserController();
        return $registerUser->store($request);
    }

    /**
     * ユーザー編集
     */
    public function edit($id)
    {
        $formType = FormTypeEnum::ADMIN_UPDATE->value;
        $submitType = SubmitTypeEnum::SUBMIT->value;
        $route = route('admin.userList.update', ['userList' => $id]);
        $user = User::where('id', $id)->with('userVehicles')->first();
        $method = "PATCH";
        return view('admin.userLists.userEdit', compact('user', 'route', 'method', 'formType', 'submitType')); // 編集ページにユーザー情報を渡す
    }

    /**
     * ユーザー更新
     */
    public function update(RegisteredUserRequest $request, $userList): RedirectResponse
    {
        $rerunSave = false;

        // リクエストからユーザー情報を更新
        $user = User::where('id', $request->route('userList'))->first();
        $originalEmail = $user->email;

        $user->update($request->except('password'));

        // 会員登録と別に作成する
        $userVehicles = $request->validate((new UserVehicleRequest())->rules());
        $user->createVehicles($userVehicles);

        // パスワードを上書きする
        if ($request->has('password') && !empty($request->password)) {
            $user->password = bcrypt($request->password);
            $rerunSave = true;
        }

        // メールアドレスが変更された場合は、メールの確認日をリセット
        if ($user->email !== $originalEmail) {
            $user->email_verified_at = null;
            $rerunSave = true;
        }

        // ユーザー情報を保存
        if ($rerunSave) {
            $user->save();
        }

        return Redirect::route('admin.userList.index')->with('success', 'ユーザーを更新しました');
    }

    /**
     * ユーザー削除
     */
    public function destroy($id)
    {
        // 指定されたIDのユーザーを取得
        $user = User::findOrFail($id);

        // ユーザー削除
        $user->delete();

        // 成功メッセージを表示してリストにリダイレクト
        // return redirect()->route('admin.userList.index')->with('success', 'ユーザーを削除しました。');

        return response()->json([
            'success' => true,
            'message' => self::$title . 'を削除しました！',
            'redirectUrl' => route('admin.userList.index'),
        ], 200);
    }

    /**
     * 複数ユーザー削除
     */
    public function deleteUsers(Request $request)
    {
        $userIds = $request->input('ids');

        if (!empty($userIds)) {
            // ユーザーを一括削除
            User::whereIn('id', $userIds)->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function filterUsers(Request $request): \Illuminate\Database\Eloquent\Builder
    {
        // ユーザー情報を取得するクエリビルダーを初期化
        $query = User::query();

        // ロールで絞り込む
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        // 顧客名で絞り込む
        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // フリガナで絞り込む
        if ($request->has('name_furigana') && $request->name_furigana != '') {
            $query->where('name_furigana', 'like', '%' . $request->name_furigana . '%');
        }

        // ログインIDで絞り込む
        if ($request->has('loginid') && $request->loginid != '') {
            $query->where('loginid', 'like', '%' . $request->loginid . '%');
        }

        // 電話番号で絞り込む
        if ($request->has('phone_number') && $request->phone_number != '') {
            $query->where('phone_number', 'like', '%' . $request->phone_number . '%');
        }

        // メールアドレスで絞り込む
        if ($request->has('email') && $request->email != '') {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        // 月で絞り込む
        if ($request->has('birthday_month') && $request->birthday_month != '') {
            $query->whereMonth('birthday', $request->birthday_month);
        }

        // 日で絞り込む
        if ($request->has('birthday_day') && $request->birthday_day != '') {
            $query->whereDay('birthday', $request->birthday_day);
        }

        if ($request->has('registration_order') || $request->has('update_order')) {
            // 登録順で並べ替える
            if ($request->has('registration_order')) {
                if ($request->registration_order == 'newest') {
                    // 新しい順（降順）
                    $query->orderBy('created_at', 'desc');
                } elseif ($request->registration_order == 'oldest') {
                    // 古い順（昇順）
                    $query->orderBy('created_at', 'asc');
                }
            }

            // 更新順で並べ替える
            if ($request->has('update_order')) {
                if ($request->update_order == 'newest') {
                    // 新しい順（降順）
                    $query->orderBy('updated_at', 'desc');
                } elseif ($request->update_order == 'oldest') {
                    // 古い順（昇順）
                    $query->orderBy('updated_at', 'asc');
                }
            }
        } else {
            $query->orderBy('customer_no', 'asc');
        }

        return $query;
    }

    /**
     * CSVでユーザーダウンロード
     */
    public function downloadUsersAsCSV(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $query = $this->filterUsers($request);
        $users = $query->get();

        $csvFileName = 'userlist_' . Carbon::now()->toDateString() . '.csv';
        $csvFile = fopen($csvFileName, 'w');
        $csvColumns = $this->csvColumns();

        // Add BOM for UTF-8 encoding (to support Japanese characters in Excel)
        fputs($csvFile, "\xEF\xBB\xBF");

        // Add column headings
        fputcsv($csvFile, array_values($csvColumns));

        // Add user data dynamically using the keys from the $csvColumns
        foreach ($users as $user) {
            // Prepare a row array based on the keys
            $row = [];
            foreach (array_keys($csvColumns) as $columnKey) {
                // For each key, map it to the corresponding user property

                switch ($columnKey) {
                        // ENUMS
                    case 'gender':
                        $row[] = $user->gender ? $user->gender->getLabel() : '';
                        break;
                    case 'call_time':
                        $row[] = $user->call_time ? $user->call_time->getLabel() : '';
                        break;
                    case 'prefecture':
                        $row[] = $user->prefecture ? $user->prefecture->getLabel() : '';
                        break;
                    case 'is_receive_newsletter':
                        $row[] = $user->is_receive_newsletter ? $user->is_receive_newsletter->getLabel() : '';
                        break;
                    case 'is_receive_notification':
                        $row[] = $user->is_receive_notification ? $user->is_receive_notification->getLabel() : '';
                        break;

                        // regular columns
                    default:
                        // Example: 'customer_no' => $user->customer_no
                        $row[] = $user->$columnKey ?? '';  // Use null coalescing in case any property is missing
                        break;
                }
            }

            // Write the row to the CSV file
            fputcsv($csvFile, $row);
        }

        return Response::download(public_path($csvFileName))->deleteFileAfterSend(true);
    }

    public function csvColumns(): array
    {
        return [
            'customer_no' => '会員番号',
            'loginid' => 'ログインID',
            'name' => '顧客名',
            'name_furigana' => 'フリガナ',
            'email' => 'メールアドレス',
            'gender' => '性別',
            'birthday' => '誕生日',
            'call_time' => '電話連絡の希望時間帯',
            'zipcode' => '郵便番号',
            'prefecture' => '都道府県',
            'address1' => '市区町村・番地',
            'address2' => '建物名など',
            'is_receive_newsletter' => 'メルマガ配信',
            'is_receive_notification' => '店からのお知らせメール',
        ];
    }
}
