<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateDB\GetLotInfo;
use App\Jobs\UpdateDB\GetLotInfoJob;
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
        dd(GoutteService::getItemData($data));

        //return view('pages.sresult', compact('data'));
    }
}
