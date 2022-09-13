<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ShoppingListController extends Controller
{
    //買い物リストページの表示
    public function list()
    {
        return view('shopping.list');
    }
}