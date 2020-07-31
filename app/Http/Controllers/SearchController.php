<?php

namespace App\Http\Controllers;


use App\Jobs\UpdateDB\UpdateIDMainJob;

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
        $array=GoutteService::getItemData($data);
        //$this->dispatch(new UpdateIDMainJob($data));
        print($array['Maker']);
        print($array['ItemName']);
        print($array['ImgSRC']);

        //return view('pages.sresult', compact('data'));
    }
}
