<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//DBのProductIDのモデル追加する
use App\ProductID;

class DBController extends Controller
{
    //MySQLController

    //test
    public function test(){
    	//データベースに接続し、”select * from ProductID”のキュエリを実行する
    	$data=ProductID::get();
        return view('search', compact('data'));
    }
}
