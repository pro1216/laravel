<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

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
            //ログインｓ失敗時エラーカウントを1増やす
            $user->error_count =
                $this->user->addErrorCount($user->error_count);
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
    /**
     * ユーザーを登録する
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Request
     */
    public function register(Request $request){
        //ユーザーチェック
       
        $email = $request->input('email');
        $user = $this->user->getUserByEmail($email);
        if(is_null($user)){

            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $name = $last_name.$first_name;
            $password = $request->input('password');
            $this->user->name = $name;
            $this->user->email = $email;
            $this->user->password=Hash::make($password);
            $this->user->save();
            event(new Registered($user));
           
            return redirect()->route('login.show')
            ->with('success', 'アカウント作成に成功しました。');
        }
        return back() ->with('danger', '既に存在するアカウントです');

    }
}
