<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    //非ログイン時TOPページの表示
    public function index()
    {
        return view('index');
    }
    
    //入力用データを受け取る
    
    public function login(LoginRequest $request)
    {
        // データの取得
        $validatedData = $request->validated();
        var_dump($validatedData); exit;
    }
}