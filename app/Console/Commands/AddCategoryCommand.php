<?php

namespace App\Console\Commands;

use App\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AddCategoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Amazon:categoryTree {categoryId} {categoryName=-1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Search Amazon for child categories, while adding it to DB
                               {CategoryId: Id of caregory you want to analize}
                               {CategoryName: (Optional) Create new parent category with name }';

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
    {   if ($this->argument( 'categoryName')==-1){
        //take CategoryName from "category" table by ID
        $category="test";
        Log::warning('Searching throw existing category "'.$category.'"');
    }
    else {
        //add new record to Category Table
        $category=Category::create([
            "CategoryId"=>$this->argument('categoryId'),
            "CategoryName"=>$this->argument('categoryName')
        ]);
        Log::warning('Parent category '.$category->categoryName.'with id='.$category->CategoryId.' was added to db');
    }
    }
}
