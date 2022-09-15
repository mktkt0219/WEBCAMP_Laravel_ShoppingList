<?php
declare(strict_types=1);
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //非ログイン時TOPページの表示
    public function index()
    {
        return view('admin.index');
    }
   
    //ログイン
    public function login(AdminLoginRequest $request)
    {
        // データの取得
        $datum = $request->validated();
        
        //認証
        if (Auth::guard('admin')->attempt($datum) === false) {
            return back()
                    ->withInput()
                    ->withErrors(['auth' => 'ログインIDかパスワードに誤りがあります。',]);
        }
        $request->session()->regenerate();
        return redirect()->intended('/admin/top');
    }
    
    //ログアウト
    public function logout()
    {
        Auth::logout();
        return redirect('/admin');
    }  
}