<?php

namespace App\Jobs\UpdateDB;

use App\Product;
use App\ProductID;
use App\Services\GoutteService;

class UpdateIDSearchYahooLink extends AbstractJob
{
    protected $item;

    /**
     * GetLotInfo constructor.
     * @param $item
     */
    public function __construct($item)
    {
        parent::__construct();
        $this->item=$item;
    }


    public function handle()
    {
        //仕事開始をローグに登録
        $this->debug("start");

        //get item data
        //$itemData=Product::GetItemData($this->item->BananaId);
        //$keyWords=explode(" ",$itemData->ItemName);


        /*        $result=[];
         * //if JAV Code is Known
        if (!empty($this->item->JAN)) {
            //search Yahoo by Jan
            $result[0]=GoutteService::searchYahooByJan($this->item->JAN);
        } else {*/
            //search item by data
            $searchResult=[];
            //search 1
            //$searchResult[0]=GoutteService::searchYahooByString("Tuloka ヒートシンク", 650, 750,1);
            //search 2
            #$searchResult[1]=GoutteService::searchYahooByString();
            //search 3
            #$searchResult[2]=GoutteService::searchYahooByString();

        /*}*/
        //filter most matches


        return $searchResult;
        //add link to DB
        //ProductID::updateYahooData($this->item->BananaId, $result);


        //仕事終了をローグに登録
        $this->debug("finish");
    }
}
