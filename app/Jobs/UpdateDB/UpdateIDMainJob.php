<?php

namespace App\Jobs\UpdateDB;

use App\Category;

class UpdateIDMainJob extends AbstractJob
{
    protected $categories;

    public function __construct($categoryId)
    {
        parent::__construct();
        $this->categories=Category::getCategoryChildrenList($categoryId);
    }

    public function handle()
    {
        //仕事開始をローグに登録
        $this->debug("start");

        //updating Products List
        $chainMain=[
            new UpdateIDfromAmazonJob($this->categories),
                    ];

        //updating Product info
        $chainBranch=[
            //new GetLotInfoJob(),
            #******in development****
            #******Get JAN code for Items`*******
            #new UpdateIDGetListWithoutJan(),
            ];

        //getting price from another sources
        $chainLast=[
            #*******Update Rakuten Price***********
            #new UpdateIDfromRakutenJob(),
            #*******Update Yahooo Price***********
            #new UpdateIDfromYahooJob(),
            #reserved Job
            #new UpdateIDUpdateDatabaseJob()
        ];

        $chain=array_merge($chainMain, $chainBranch ,$chainLast);

        UpdateIDJob::withChain($chain)->dispatch();


        //仕事終了をローグに登録
        $this->debug("finish");
    }
}
