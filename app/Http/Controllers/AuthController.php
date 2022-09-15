<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //非ログイン時TOPページの表示
    public function index()
    {
        return view('index');
    }
    
    //ログイン
    public function login(LoginRequest $request)
    {
        // データの取得
        $datam = $request->validated();
        
        //認証
        if (Auth::attempt($datam) === false){
            return back()
                    ->withInput()
                    ->withErrors(['auth' => 'emailかパスワードに誤りがあります。',]);
        }
        $request->session()->regenerate();
        return redirect()->intended('/shopping_list/list');
    }
    
    //ログアウト
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}