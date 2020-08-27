<?php

namespace App\Http\Controllers;

use App\Category;
use App\Jobs\UpdateDB\UpdateIDfromAmazonJob;
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
        /* $array=GoutteService::getItemData($data);
        print_r($array);
        Product::updateLotInfo(11, $array);
        //$this->dispatch(new UpdateIDMainJob($data));
        print($array['Maker']);
        print($array['ItemName']);
        print($array['ItemName']);
        print($array['ImgSRC']);*/
        dd(GoutteService::searchRakutenByString($data,400,10000,1));
        //dd(Category::getCategoryChildrenList($data));
        //$this->dispatch(new UpdateIDMainJob($data));





        //return view('pages.sresult', compact('data'));
    }
}
