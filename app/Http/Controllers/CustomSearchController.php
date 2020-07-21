<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateID\UpdateIDMainJob;
use App\Product;
use App\ProductID;
use Illuminate\Http\Request;

class CustomSearchController extends Controller
{
    //
    public function search()
    {
        UpdateIDMainJob::dispatch();
        return view('customPages.custom');
    }

    /*
   AJAX request
   */
    public function autocomplete(Request $request){
        if($request->ajax()) {

            $data = Product::where('itemname','like','%'.$request->input('search').'%')->get();
            $output = '';

            if (count($data)>0) {

                $output = '<ul>';

                foreach ($data as $row){

                    $output .= '<li>'.$row->ItemName.'</li>';
                }

                $output .= '</ul>';
            }
            else {

                $output .= 'No results'.'</li>';
            }

            return $output;
        }
        if ($request->has('search')){
            $response=Product::where('itemname','like','%'.$request->input('search').'%')->get();
            return response()->json($response);
        }
    }
}
