<?php

namespace App\Http\Controllers;

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
        /* $array=GoutteService::getItemData($data);
        print_r($array);
        Product::updateLotInfo(11, $array);
        //$this->dispatch(new UpdateIDMainJob($data));
        print($array['Maker']);
        print($array['ItemName']);
        print($array['ItemName']);
        print($array['ImgSRC']);*/
        dd(GoutteService::searchYahooByJan($data));






        //return view('pages.sresult', compact('data'));
    }
}
