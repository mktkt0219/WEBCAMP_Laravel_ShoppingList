<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //会員登録ページの表示
    public function index()
    {
        return view('userregister');
    }
    
    //入力用データを受け取る
    
    public function register(UserRegisterRequest $request)
    {
        // データの取得
        $datum = $request->validated();
        $datum['password'] = Hash::make($datum['password']);
        
        //テーブルへインサート
        $r = UserModel::create($datum);

        //登録成功
        $request->session()->flash('user_register_success', true);
        return redirect('/');
    }
}