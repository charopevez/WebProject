<?php

namespace App\Http\Controllers;
use App\Jobs\UpdateDB\UpdateIDfromRakutenJob;
use App\Product;
use App\ProductID;
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

        return view('pages.sresult', compact('data'));
        //$this->dispatch(new UpdateIDfromRakutenJob());
        /*$items=ProductID::GetItemWithLinkandPrice(0,1000);
        foreach ($items as $item){
            $price=array();
            if (!empty($item->AmazonPrice)) $price['Amazon']=$item->AmazonPrice;
            if (!empty($item->YahooPrice)) $price['Yahoo']=$item->YahooPrice;
            if (!empty($item->RakutenPrice)) $price['Rakuten']=$item->RakutenPrice;
            $minPrice=array_keys($price, min($price));
            switch ($minPrice[0]){
                case 'Amazon':
                    ProductID::UpdatePriceAndLink($item->BananaId,$item->AmazonPrice,$item->AmazonLink);
                    break;
                case 'Yahoo':
                    ProductID::UpdatePriceAndLink($item->BananaId,$item->YahooPrice,$item->YahooLink);
                    break;
                case 'Rakuten':
                    ProductID::UpdatePriceAndLink($item->BananaId,$item->RakutenPrice,$item->RakutenLink);
                    break;

            }
        }*/
        //dd($minPrice);
    }
}
