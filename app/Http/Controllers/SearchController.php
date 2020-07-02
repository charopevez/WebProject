<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    //商品検索
    function search(Request $request){
    	$data=$request->search;
        return view('search', compact('data'));
    }
}
