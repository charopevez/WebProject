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
       $search=$request->search;// $_get['search]
      $searchResult=Product::SearchDB($search);
      dd($searchResult);





        //return view('pages.sresult', compact('data'));
    }
}
