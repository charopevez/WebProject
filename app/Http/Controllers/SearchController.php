<?php

namespace App\Http\Controllers;

use App\Services\GoutteService;
use Illuminate\Http\Request;
use App\ProductID;

class SearchController extends Controller
{
    public function __construct(GoutteService $goutteService){
        $this->goutteService=$goutteService;

    }

    //商品検索
    function search(Request $request){
    	$data=$request->search;
    	//$value=$this->goutteService->getChildGategoriesFromAmazon(1000000,"2127209051",0);
    	//dd($value);
        return view('pages.sresult', compact('data'));
    }
}
