<?php

namespace App\Jobs\UpdateDB;

class UpdateIDJob extends AbstractJob
{
    public function handle()
{
    //仕事開始をローグに登録
    $this->debug("start");


    //仕事終了をローグに登録
    $this->debug("finish");
}
}
