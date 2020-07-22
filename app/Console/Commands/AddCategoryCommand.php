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
               }
        $categoryLevel=0;
        //creating categories tree
        while ($categoryLevel<5) {
            $childCategoriesList=Category::getCategoryList($this->argument('categoryId'));
            // Getting all childs for existing categories
            foreach ($childCategoriesList as $category) {
                //checking what categories level we are investigating
                if(($category->CategoryId)%pow(10, 10-$categoryLevel*2)!=0) {
                    //childs array
                    $childs=$gService->getChildGategoriesFromAmazon($category->CategoryId, $category->AmazonCategoryNode, $categoryLevel+1);
                    Category::createCategory($childs);
                }
            }
            $categoryLevel++;
            Log::info($categoryLevel);
        }
    }
}
