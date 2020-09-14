<?php

namespace App\Jobs\UpdateDB;


use App\ProductID;

class UpdateIDGetLowestPrice extends AbstractJob
{

    public function handle()
    {
        //仕事開始をローグに登録
        $this->debug("start");

        //get all prices
        $items=ProductID::GetItemWithLinkandPrice();

        foreach ($items as $item){
            $minPrice=array_keys($item, min($item));
        }


        //仕事終了をローグに登録
        $this->debug("finish");
    }
}

