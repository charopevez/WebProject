<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateID\UpdateIDJob;
use App\Jobs\UpdateID\UpdateIDMainJob;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //商品検索
    function search(Request $request){
    	$data=$request->search;
        return view('pages.sresult', compact('data'));
    }
}
