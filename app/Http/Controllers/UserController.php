<?php

namespace App\Http\Controllers;

use App\Enums\FormTypeEnum;
use App\Enums\SubmitTypeEnum;
use App\Http\Requests\RegisteredUserRequest;
use App\Models\Anket;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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


        // 絞り込んだユーザーを5件ずつページネートして取得
        $users = $query->paginate(100); // ページごとに5件表示

        // ビューにユーザー情報を渡す
        return view('admin.userLists.userList', compact('users'));
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
        // これを実際の アンケートリストに変更します (DB から)
        $questionnaire = Anket::get();
        return view('admin.userLists.userEdit', compact('user', 'route', 'formType', 'submitType', 'questionnaire')); // 編集ページにユーザー情報を渡す
    }

    /**
     * ユーザー更新
     */
    public function update(RegisteredUserRequest $request, $userList): RedirectResponse
    {
        $rerunSave = false;

        // リクエストからユーザー情報を更新
        $user = User::where('id', $request->route('userList'))->first();

        // パスワードを上書きする
        if ($request->has('password') && !empty($request->password)) {
            $user->password = bcrypt($request->password);
            $rerunSave = true;
        }

        // メールアドレスが変更された場合は、メールの確認日をリセット
        if ($user->isDirty('email')) {
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
}
