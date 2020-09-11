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
use App\Jobs\UpdateDB\UpdateLotInfoJob;
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

        $sortBy=$request->orderBy;
        $searchAt=$request->option;
        $data=Product::SearchDB($search, $sortBy, $searchAt);
        switch ($sortBy) {
          case 1:
                $data=collect($data)->sortBy('AmazonPrice')->toArray();
                break;
          case 2:
                $data=collect($data)->sortBy('AmazonPrice')->reverse()->toArray();
                break;
        }       
        
        /* dd($data); */
        return view('pages.sresult', compact('data'));

    }
}
