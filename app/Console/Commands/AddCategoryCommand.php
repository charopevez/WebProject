<?php

namespace App\Console\Commands;

use App\Category;
use App\Services\GoutteService;
use Illuminate\Console\Command;


class AddCategoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Amazon:categoryTree {categoryId} {AmazonCategoryNode} {categoryName=-1} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Search Amazon for child categories, while adding it to DB
                               {CategoryId}: Id of caregory you want to analize
                               {AmazonCategoryNode}:Amazons CategoryId
                               {CategoryName}: (Optional) Create new parent category with name';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $gService = new GoutteService();
        $categoriesList=array(
            0=>array("CategoryId"=>$this->argument('categoryId'),
                    "CategoryName"=>$this->argument('categoryName'),
                    "AmazonCategoryNode"=>$this->argument('AmazonCategoryNode')));

        //add Parent Category
        if (Category::createCategory($categoriesList[0])==0) $this->info("カテゴリ　".$categoriesList[0]['CategoryName']."追加しました。");
           else {
               $this->info("カテゴリ　" . $categoriesList[0]['CategoryName'] . "追加出来ませんでした。　終了します");
               exit(1);
           }
           /*if ($categoriesList[0]['CategoryId'] % 100!=0) $parentLevel=2;
           else if ($categoriesList[0]['CategoryId'] % 10000!=0) $parentLevel=1;
           else $parentLevel=0;*/

           //get child list
        $child=$gService->getChildGategoriesFromAmazon($categoriesList[0]['CategoryId'], $categoriesList[0]['AmazonCategoryNode'], 0);
        dd ($child);
        /*if (!empty($categoriesList[0]['CategoryId'])) {
            if ($this->argument('categoryName') == -1) {
                $this->info("child");

                //take Categorynode from "category" table by ID

            } else {

                if (!empty($this->argument('AmazonCategoryNode'))) {
                    $this->info($this->argument('categoryId'));
                    $this->info($this->argument('categoryId'). $this->argument('categoryName').$this->argument('AmazonCategoryNode'));

                    //add new record to Category Table
                    Category::createCategory($this->argument('categoryId'), $this->argument('categoryName'), $this->argument('AmazonCategoryNode'));
                    }
            }
        }*/
    }
}
