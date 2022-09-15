<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Completed_shopping_list as CompleteShoppinglistModel;

class CompletedShoppingListController extends Controller
{
    //買い物リストページの表示
    public function list()
    {
        $per_page =5;
        
        $list = CompleteShoppinglistModel::where('user_id', Auth::id())->orderBy('name')->orderBy('created_at')->paginate($per_page);
        return view('shopping.completed_list',['list' => $list]);
    }
}