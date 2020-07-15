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

    public static function getBananaIdAndAsin()
    {
        return DB::table("product_i_d_s")->pluck('AmazonId', 'BananaId');
    }

}
