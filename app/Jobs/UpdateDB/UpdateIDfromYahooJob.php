<?php

namespace App\Jobs\UpdateDB;


use App\ProductID;

class UpdateIDfromYahooJob extends AbstractJob
{
    public function handle()
    {
        //仕事開始をローグに登録
        $this->debug("start");

        //get list of new items
        $newItemList=ProductID::GetListEmptyYahooItems();
        foreach ($newItemList as $item) {
            dispatch(new UpdateIDSearchYahooLink($item));
        }

        /*//get list of outdated items
        $outdateditemList=ProductID::GetListOutdatedYahooItems();
        foreach ($outdateditemList as $item) {
            dispatch(new UpdateIDSearchYahooLink($item));
        }*/

        //仕事終了をローグに登録
        $this->debug("finish");
    }
}

