<?php

namespace App\Jobs\UpdateDB;

use App\ProductID;

class UpdateIDfromRakutenJob extends AbstractJob
{
    public function handle()
    {
        //仕事開始をローグに登録
        $this->debug("start");

        //get list not updated items
        $itemList=ProductID::GetListEmptyRakutenIems();

        foreach ($itemList as $item) {
            dispatch(new UpdateIDSearchRakutenLink($item));
        }

        /*//get list of outdated items
        $outdateditemList=ProductID::GetListOutdatedRakutenItems();
        foreach ($outdateditemList as $item) {
            dispatch(new UpdateIDSearchRakutenLink($item));
        }*/


        //仕事終了をローグに登録
        $this->debug("finish");
    }
}
