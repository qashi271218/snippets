<?php



namespace App\Imports;



use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithHeadingRow;

use DB;

use App\Models\Product;

use App\Models\ProductStock;

use Str;

class ProductsImport implements ToModel,WithHeadingRow

{

    /**

    * @param array $row

    *

    * @return \Illuminate\Database\Eloquent\Model|null

    */

    public function model(array $row)

    {
// row[0] is the ID
//dd($row['id']);
        if($row['id']!=null)

        {

        $product = Product::find($row['id']);

        $product->update([

                'tags'     => strval($row['sku']),

                'attribute_set'    => $row['attribute'], 

            'brand_id'=>$row['brand'],

            'name'=>$row['name'],

            'current_stock'=>$row['qty'],

            'unit_price'=>$row['unit_price'],

            'locations'=>$row['location'],

            'user_id'=>9

            ]);

            DB::table('product_stocks')->where('product_id',$product->id)->update(['price'=>$row['unit_price'],'qty'=>$row['qty']]);

        }

       else

        {
//dd($row);
         DB::table('products')->insert ([


              'attribute_set'    => $row['attribute'], 
                           'tags'     => strval($row['sku']),

            'brand_id'=>$row['brand'],

            'name'=>$row['name'],

            'current_stock'=>$row['qty'],

            'unit_price'=>$row['unit_price'],

            'locations'=>$row['location'],

            'user_id'=>9,

            'video_provider'=>'youtube',

            'attributes'=>'[]',

            'choice_options'=>'[]',

            'colors'=>'[]',

            'slug'=>$row['name'].'-'.Str::random(10),

            'published'=>0,

            'cash_on_delivery'=>1,

            'low_stock_quantity'=>1,

            'published'=>1

             ]);  

             $last=DB::table('products')->orderBy('id','desc')->orderBy('id','desc')->first();
             return new ProductStock(['product_id'=>$last->id,'price'=>$row['unit_price'],'qty'=>$row['qty']]);

        }

}

}

