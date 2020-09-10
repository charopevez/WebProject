<?php

namespace App\Jobs\UpdateDB;

use App\ProductID;

class UpdateIDGetListWithoutJan extends AbstractJob
{
    public function handle()
    {
        //noy in use

        //仕事開始をローグに登録
        $this->debug("start");

        //get bananaId items with empty JAN code
        $itemList=ProductID::getBananaIdWithoutJan();
        if (!empty($itemList)) {
            foreach ($itemList as $item) {
                dispatch(new UpdateIDGetJanCodeJob($item));
            }
        }

        //仕事終了をローグに登録
        $this->debug("finish");
    }
}
