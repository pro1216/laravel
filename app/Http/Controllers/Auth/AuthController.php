<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class AuthController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * @return View
     */

    public function showLogin()
    {
        return view('login.login_form');
    }

    /**
     * @param App\Http\Requests\LoginFormRequest
     * $return
     */
    public function login(LoginFormRequest $request)
    {

        $credentials = $request->only('email', 'password');

        //アカウントがロックされていたらはじく
        $user = $this->user->getUserByEmail($credentials['email']);
        if (!is_null($user)) {
            if ($this->user->isAccountLocked($user)) {

                return back()->withErrors([
                    'danger' => 'アカウントがロックされています'
                ]);
            }
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                //ログイン成功時error_acountを0にする
                $this->user->resetErrorCount($user);

                return redirect()->route('home')
                    ->with('success', 'ログイン成功');
            }
            //ログインｓ失敗時エラーアカウントを1増やす
            $user->error_account =
                $this->user->addErrorAccount($user->error_account);
            if ($this->user->lockAccount($user)) {
                return back()->withErrors([
                    'danger' => 'アカウントがロックされました。'
                ]);
            }
            $user->save();
        }
        return back()->withErrors([
            'danger' => 'メールアドレスかパスワードが間違っています。'
        ]);
    }
    /**
     * ユーザーをアプリケーションからログアウトさせる
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Request
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login.show')
            ->with('danger', 'ログアウトしました。');
    }
}
