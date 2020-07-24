<?php

namespace App\Jobs\UpdateID;

use App\Category;
use App\Product;
use App\ProductID;
use App\Services\GoutteService;

class UpdateIDfromAmazonJob extends AbstractJob
{
    protected $categiriesList;

    public function __construct($categiriesArray)
    {
        parent::__construct();
        $this->categiriesList=$categiriesArray;
    }

    public function handle()
    {
        //仕事開始をローグに登録
        $this->debug("start");

        //collecting job stats variable
        $updateCount=0;
        $addCount=0;

        //updating/adding ProductId table
        foreach ($this->categiriesList as $category ) {
            //for each category get products from it
            $productList=GoutteService::searchProductFromAmazonByCategory($category->AmazonCategoryNode);
            // for each product
            foreach ($productList as $product){
                //checking if product exist in DB, if get true, upadete data, else adding data to generated ID
                $bananaID=ProductID::getBananaId($product['AmazonId']);
                if ($bananaID==-1) {
                    //if exist update info
                    ProductID::updateAmazonData($product['AmazonId'], $product['AmazonPrice']);
                    //increase update counter
                    $updateCount++;
                } else {
                    //else add to Products table record
                    ProductID::insertAmazonData($bananaID,$product['AmazonId'], $product['AmazonPrice']);
                    //increase update counter
                    $addCount++;
                }
            }
        }

        //log statistic
        $this->debug("updated".$updateCount."record(s), added new".$addCount."record(s)");

        //仕事終了をローグに登録
        $this->debug("finish");
    }
}

