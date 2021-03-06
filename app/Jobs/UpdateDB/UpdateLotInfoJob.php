<?php


namespace App\Jobs\UpdateDB;



use App\Product;
use App\Services\GoutteService;

class UpdateLotInfoJob extends AbstractJob
{
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

        //get New Item list
            $asin=$this->lot->AmazonId;
        print($asin=$this->lot->BananaId);
        $data=GoutteService::getItemData($this->lot->AmazonId);
        print_r($data);
        Product::updateLotInfo($this->lot->BananaId, $data);
        $this->debug("Added ". $asin);


        //仕事終了をローグに登録
        $this->debug("finish");
    }

}
