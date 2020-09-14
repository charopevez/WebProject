<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductID extends Model
{
    //Update yahoo data
    public static function updateYahooData($bananaId,$link,$price)
    {

        DB::table("product_i_d_s")->where('BananaId',$bananaId)
            ->update([
                'YahooLink'=>$link,
                'YahooPrice'=>$price,
                'YahooLinkWasUpdatedAt'=>Carbon::today()
            ]);
    }
    public static function updateRakutenData($bananaId,$link,$price)
    {
        DB::table("product_i_d_s")->where('BananaId',$bananaId)
            ->update([
                'RakutenLink'=>$link,
                'RakutenPrice'=>$price,
                'RakutenLinkWasUpdatedAt'=>Carbon::today()
            ]);
    }


    public static function getBananaIdWithoutJan()
    {
        return DB::table('product_i_d_s')->whereNull('JAN')->pluck('AmazonId', 'BananaId');
    }

    public static function insertAmazonData($bananaId, $asin, $price )
    {
        DB::table('product_i_d_s')->insert([
            'BananaId'=>$bananaId,
            'AmazonId'=>$asin,
            'AmazonLink'=>"https://www.amazon.co.jp/dp/".$asin,
            'AmazonPrice'=>$price
            ]);
    }

    public static function updateAmazonData($asin, $price)
    {
        DB::table('product_i_d_s')->where('AmazonId',$asin)
            ->update(['AmazonPrice'=>$price]);
    }


    public static function getBananaId($amazonId)
    {
        if (DB::table('product_i_d_s')->where('AmazonId', $amazonId)->first()===null){
            //if not exist create new id
            return DB::table('product_i_d_s')->max('BananaID')+1;
        }else{
            //if exists return true
            return -1;
        }
    }

    public static function addJan($asin, $jan)
    {
        DB::table('product_i_d_s')->where('AmazonId',$asin)
            ->update(['AmazonPrice'=>$jan]);
    }

    public static function GetListEmptyYahooItems()
    {
        return DB::table('product_i_d_s')
            ->join('products','product_i_d_s.BananaId','=', 'products.BananaId')
            ->whereNotNull('products.ItemName')
            #->where('YahooLinkWasUpdatedAt', '<', Carbon::now()->subWeek())
            #->orwhereNull('YahooLinkWasUpdatedAt')
            ->select('product_i_d_s.AmazonId', 'product_i_d_s.BananaId', 'product_i_d_s.JAN', 'product_i_d_s.AmazonPrice', 'products.ItemName', 'products.ImgSRC')
            ->get()->toArray();

    }
    public static function GetListOutdatedYahooItems()
    {
        return DB::table('product_i_d_s')
            ->join('products','product_i_d_s.BananaId','=', 'products.BananaId')
            ->whereNotNull('products.ItemName')
            ->where('YahooLinkWasUpdatedAt', '<', Carbon::now()->subWeek())
            ->whereNotNull('YahooLinkWasUpdatedAt')
            ->select('product_i_d_s.AmazonId', 'product_i_d_s.BananaId', 'product_i_d_s.JAN', 'product_i_d_s.AmazonPrice', 'products.ItemName', 'products.ImgSRC')
            ->get()->toArray();
    }

    public static function GetListEmptyRakutenIems()
    {
        return DB::table('product_i_d_s')
            ->join('products','product_i_d_s.BananaId','=', 'products.BananaId')
            ->whereNotNull('products.ItemName')
            #->where('YahooLinkWasUpdatedAt', '<', Carbon::now()->subWeek())
            #->orwhereNull('YahooLinkWasUpdatedAt')
            ->select('product_i_d_s.AmazonId', 'product_i_d_s.BananaId', 'product_i_d_s.JAN', 'product_i_d_s.AmazonPrice', 'products.ItemName', 'products.ImgSRC')
            ->get()->toArray();
    }

    public static function GetItemWithLinkandPrice($min, $max)
    {
        return DB::table('product_i_d_s')
            ->select(['BananaId','AmazonLink','AmazonPrice','RakutenLink','RakutenPrice','YahooLink','YahooPrice'])
            ->whereBetween('BananaId',[$min, $max])->get()->toArray();
    }

    public static function UpdatePriceAndLink($bananaId,$price, $link)
    {
        DB::table('product_i_d_s')->where('BananaId',$bananaId)
            ->update(['Price'=>$price, 'Link'=>$link]);

    }
}
