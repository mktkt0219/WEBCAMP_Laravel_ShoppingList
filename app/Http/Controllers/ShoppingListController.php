<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRegisterRequest;
use App\Models\Shopping_list as ShoppinglistModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\completed_shopping_lists as CompleteShoppinglistModel;

class ShoppingListController extends Controller
{
    //買い物リストページの表示
    public function list()
    {
        $per_page =10;
        
        $list = ShoppinglistModel::where('user_id', Auth::id())->orderBy('name')->paginate($per_page);
        return view('shopping.list',['list' => $list]);
    }
    
    //買うもの登録
    public function register(ItemRegisterRequest $request)
    {
        //データの取得
        $datum = $request->validated();
        $datum['user_id'] = Auth::id();

        $r = ShoppinglistModel::create($datum);  
        
        //登録成功
        $request->session()->flash('shoppinglist_register_success', true);
        return redirect('/shopping_list/list');
    }
    
    //データ削除
     public function delete(Request $request,$shopping_list_id)
    {
        // shopping_list_idのレコードを取得する
          $list = ShoppinglistModel::find($shopping_list_id);
          
        // タスクを削除する
        if ($list !== null) {
            $list->delete();
        }
        // 削除成功
        $request->session()->flash('shoppinglist_delete_success', true);
        return redirect('/shopping_list/list');
    }
    
     public function complete(Request $request,$shopping_list_id)
    {
        try {
            // トランザクション開始
            DB::beginTransaction();

            // task_idのレコードを取得する
            $list = ShoppinglistModel::find($shopping_list_id);
            if ($list === null) {
                // task_idが不正なのでトランザクション終了
                throw new \Exception('');
            }

            // list側を削除する
            $list->delete();

            // completed側にinsertする
            $dask_datum = $list->toArray();
            unset($dask_datum['created_at']);
            unset($dask_datum['updated_at']);
            $r = CompleteShoppinglistModel::create($dask_datum);
            if ($r === null) {
                // insertで失敗したのでトランザクション終了
                throw new \Exception('');
            }

            // トランザクション終了
            DB::commit();
        } catch(\Throwable $e) {

            // トランザクション異常終了
            DB::rollBack();
        }
        
        $request->session()->flash('shoppinglist_completed_failure', true);
        return redirect('/shopping_list/list');        
    }
}