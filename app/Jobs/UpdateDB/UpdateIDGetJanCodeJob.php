<?php

namespace App\Jobs\UpdateDB;

use App\Product;
use App\ProductID;
use App\Services\GoutteService;

class UpdateIDGetJanCodeJob extends AbstractJob
{

    //not used
    protected $lot;

    /**
     * GetLotInfo constructor.
     * @param $lot
     */
    public function __construct($lot)
    {
        parent::__construct();
        $this->lot=$lot;
    }
    public function handle()
    {
        //仕事開始をローグに登録
        $this->debug("start");

        //log what item jan is being researched
        $this->debug("Looking for ".$this->lot);

        $jan=GoutteService::searchJanFor($this->lot);
        //update date
        if ($jan!=-1)  ProductID::addJan($this->lot,$jan);

        //仕事終了をローグに登録
        $this->debug("finish");
    }
}
