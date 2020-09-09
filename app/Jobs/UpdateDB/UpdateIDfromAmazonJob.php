<?php

namespace App\Jobs\UpdateDB;

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

        //log statistic
        $this->debug("scanning ".count($this->categiriesList)." categories");

        //create jobs for each category
        foreach ($this->categiriesList as $category ) {
            $this->debug("scanning ".$category->CategoryName);
            dispatch(new SearchItemOnAmazonPageJob($category, 23));
        }

        //仕事終了をローグに登録
        $this->debug("finish");
    }
}

