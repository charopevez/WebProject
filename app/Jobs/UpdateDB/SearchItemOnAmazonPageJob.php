<?php

namespace App\Jobs\UpdateDB;


use App\Product;
use App\ProductID;
use App\Services\GoutteService;

class SearchItemOnAmazonPageJob extends AbstractJob
{
    protected $page;
    protected $category;

    public function __construct($category,$page)
    {
        parent::__construct();
        $this->page=$page;
        $this->category=$category;
    }

    public function handle()
    {
        //仕事開始をローグに登録
        $this->debug("start");

        //collecting job stats variable
        $updateCount=0;
        $addCount=0;


        //get products from page
        $productList=GoutteService::searchProductFromAmazonByCategory($this->category->AmazonCategoryNode, $this->page);
        //check result, if got any
        if ($this->page<50) {
        if (!empty($productList)) {
            // for each product
            foreach ($productList as $product) {
                //checking if product exist in DB, if get true, update data, else adding data to generated ID
                $bananaID = ProductID::getBananaId($product['AmazonId']);
                if ($bananaID == -1) {
                    //if exist update info
                    ProductID::updateAmazonData($product['AmazonId'], $product['AmazonPrice']);
                    //increase update counter
                    $updateCount++;
                } else {
                    //else add to Products table record
                    ProductID::insertAmazonData($bananaID, $product['AmazonId'], $product['AmazonPrice']);
                    Product::AddNewItem($bananaID, $this->category->CategoryId);
                    //increase update counter
                    $addCount++;
                }
            }
        }
        //create job to scan next page
        dispatch(new SearchItemOnAmazonPageJob($this->category, $this->page+1));
        }

        //log statistic
        $this->debug("Category ".$this->category->CategoryName." page ".$this->page." scanned, updated ".$updateCount." record(s), added new ".$addCount." record(s)");

        //仕事終了をローグに登録
        $this->debug("finish");
    }
}
