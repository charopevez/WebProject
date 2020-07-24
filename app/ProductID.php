<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductID extends Model
{
    //Update yahoo data
    public static function updateYahooData($bananaId,$data)
    {
        DB::table("product_i_d_s")->where('BananaId',$bananaId)
            ->update($data);
    }

    public static function getBananaIdAndAsin($category)
    {
        return DB::table("product_i_d_s")->where('Ca',$category)->pluck('AmazonId', 'BananaId');
    }

    public static function insertAmazonData($bananaId, $asin, $price )
    {
        DB::table("product_i_d_s")->insert([
            'BananaId'=>$bananaId,
            'AmazonId'=>$asin,
            'AmazonLink'=>"https://www.amazon.co.jp/dp/".$asin,
            'AmazonPrice'=>$price
            ]);
    }

    public static function updateAmazonData($asin, $price)
    {
        DB::table("product_i_d_s")->where('AmazonId',$asin)
            ->update($price);
    }


    public static function getBananaId($amazonId)
    {
        if (DB::table('product_i_d_s')->where('AmazonId', $amazonId)->first()===null){
            //if not exist create new id
            return DB::table('product_i_d_s')->max('BananaID')+1;
        }else{
            //if exists return true
            return true;
        }
    }

}
