<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateID\UpdateIDfromAmazonJob;

use App\Jobs\UpdateID\UpdateIDMainJob;
use App\Services\GoutteService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function __construct(){

    }

    //商品検索
    function search(Request $request){
        $data=$request->search;
        dd(GoutteService::searchProductFromAmazonByCategory($data));

        //return view('pages.sresult', compact('data'));
    }
}
