<?php

namespace App\Http\Controllers;


use App\Jobs\UpdateDB\UpdateIDMainJob;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function __construct(){

    }

    //商品検索
    function search(Request $request){
        $data=$request->search;
        $this->dispatch(new UpdateIDMainJob($data));

        //return view('pages.sresult', compact('data'));
    }
}
