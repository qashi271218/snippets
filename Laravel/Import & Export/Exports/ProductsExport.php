<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;
class ProductsExport implements FromCollection,WithHeadings
{
    protected $attribute;

 function __construct($attribute) {
        $this->attribute = $attribute;
 }
    /**
    * @return \Illuminate\Support\Collection
    */
        public function collection() {
        return DB::Table('products')->where('attribute_set',$this->attribute)->select('id','tags','attribute_set','brand_id','name','current_stock','unit_price','locations')->get();  
    }
    public function headings(): array {
        return [
            'id',
            'Sku',
            'Attribute',
            'Brand',
            'Name',
            'Qty',
            'Unit Price',
            'Location'

        ];
    }
}
