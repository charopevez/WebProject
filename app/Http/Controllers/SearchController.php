<?php

namespace App\Http\Controllers;

use App\Category;
use App\Jobs\UpdateDB\GetLotInfoJob;
use App\Jobs\UpdateDB\SearchItemOnAmazonPageJob;
use App\Jobs\UpdateDB\UpdateIDfromAmazonJob;
use App\Jobs\UpdateDB\UpdateIDfromRakutenJob;
use App\Jobs\UpdateDB\UpdateIDfromYahooJob;
use App\Jobs\UpdateDB\UpdateIDGetListWithoutJan;
use App\Jobs\UpdateDB\UpdateIDMainJob;
use App\Product;
use App\ProductID;
use App\Services\GoutteService;

use App\Services\GuzzleService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function __construct(){

    }

    //商品検索
    function search(Request $request){
       $data=$request->search;// $_get['search]
      /*  $itemData=Product::GetItemData($data);
        $keyWords=explode(" ",$itemData[0]->ItemName);
        dd($keyWords);*/
        $category=$request->category;
        //$array=GoutteService::getItemData($data);
        /* Product::updateLotInfo(11, $array);
        //$this->dispatch(new UpdateIDMainJob($data));
        print($array['Maker']);
        print($array['ItemName']);
        print($array['ImgSRC']);*/
        //dd(GoutteService::searchAmazonByString($data,1));
        dd(GoutteService::searchRakutenByString($data, 1000, 110000, 2));
        //$this->dispatch(new UpdateIDMainJob($data));






        //return view('pages.sresult', compact('data'));
    }
}
