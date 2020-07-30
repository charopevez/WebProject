<?php

namespace App\Jobs\UpdateDB;

use App\Product;
use App\Services\GoutteService;
use mysql_xdevapi\Result;
use phpDocumentor\Reflection\Types\This;

class UpdateIDJob extends AbstractJob
{
    protected $item;

    public function __construct($item)
    {
        $this->item=$item;
    }

    public function handle()
{
    //仕事開始をローグに登録
    $this->debug("start");

    $date=GoutteService::getItemData($this->item->AmazonId);
    Product::updateLotInfo($this->item->BananaId, $date);

    //仕事終了をローグに登録
    $this->debug("finish");
}
}
