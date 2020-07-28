<?php


namespace App\Jobs\UpdateDB;


use App\Product;


class GetLotInfoJob extends AbstractJob
{

    /**
     * GetLotInfo constructor.
     */

    public function handle()
    {
        //仕事開始をローグに登録
        $this->debug("start");

        //get New Item list
        $items=Product::GetNewItemsID();
        print_r($items);
        foreach ($items as $item){
            dispatch(new UpdateLotInfoJob($item));

        }

        //仕事終了をローグに登録
        $this->debug("finish");
    }

}
