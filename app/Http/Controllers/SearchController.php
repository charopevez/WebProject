<?php

namespace App\Http\Controllers;
use App\Jobs\UpdateDB\UpdateIDfromRakutenJob;
use App\Jobs\UpdateDB\UpdateIDfromYahooJob;
use App\Product;
use JavaScript;
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
        $data=Product::SearchDB($search);
        //JavaScript::put(['data'=>$data]);

        switch ($searchAt.$sortBy) {
          case 'Amazon1':
                $data=collect($data)->sortBy('AmazonPrice')->toArray();
                break;
          case 'Amazon2':
                $data=collect($data)->sortBy('AmazonPrice')->reverse()->toArray();
                break;
            case 'Rakuten1':
                $data=collect($data)->sortBy('RakutenPrice')->toArray();
                break;
            case 'Rakuten2':
                $data=collect($data)->sortBy('RakutenPrice')->reverse()->toArray();
                break;
            case 'Yahoo1':
                $data=collect($data)->sortBy('YahooPrice')->toArray();
                break;
            case 'Yahoo2':
                $data=collect($data)->sortBy('YahooPrice')->reverse()->toArray();
                break;

        }
        return view('pages.sresult', ['data' => $data]);
    }
}
