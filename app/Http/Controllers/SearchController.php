<?php

namespace App\Http\Controllers;


use App\Jobs\UpdateDB\UpdateIDfromYahooJob;
use App\Jobs\UpdateDB\UpdateIDSearchRakutenLink;
use App\Jobs\UpdateDB\UpdateIDSearchYahooLink;
use App\ProductID;

use App\Services\GoutteService;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\While_;


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
        /*$data=Product::SearchDB($search, $sortBy, $searchAt);
        switch ($sortBy) {
          case 1:
                $data=collect($data)->sortBy('AmazonPrice')->toArray();
                break;
          case 2:
                $data=collect($data)->sortBy('AmazonPrice')->reverse()->toArray();
                break;
        }*/
        $this->dispatch(new UpdateIDfromYahooJob());
        //return view('pages.sresult', compact('data'));

    }
}
