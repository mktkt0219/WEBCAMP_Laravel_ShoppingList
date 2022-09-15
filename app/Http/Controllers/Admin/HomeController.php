<?php
declare(strict_types=1);
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //TOPページの表示
    public function top()
    {
        return view('admin.top');
    }
   
}