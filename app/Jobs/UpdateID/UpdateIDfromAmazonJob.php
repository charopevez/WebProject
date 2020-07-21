<?php

namespace App\Jobs\UpdateID;

use App\ProductID;

class UpdateIDfromAmazonJob extends AbstractJob
{
    public function handle()
    {
        //仕事開始をローグに登録
        $this->debug("start");

        //ProductID::updateYahooData("11111",$this->goutteService->searchYahooByJan(619659169299));

        //仕事終了をローグに登録
        $this->debug("finish");
    }
}

