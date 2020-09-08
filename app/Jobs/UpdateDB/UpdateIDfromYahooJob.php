<?php

namespace App\Jobs\UpdateDB;


use App\ProductID;

class UpdateIDfromYahooJob extends AbstractJob
{
    public function handle()
    {
        //仕事開始をローグに登録
        $this->debug("start");

        //get list not updated items
        $itemList=ProductID::GetListNotUpdatedYahooIems();
        print_r($itemList);

        foreach ($itemList as $item) {
            dispatch(new UpdateIDSearchYahooLink($item));
        }


        //仕事終了をローグに登録
        $this->debug("finish");
    }
}

