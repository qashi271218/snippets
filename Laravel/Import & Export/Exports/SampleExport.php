<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;
class SampleExport implements FromCollection,WithHeadings
{
        public function collection() {
        return DB::Table('products')->where('id',5)->select('id','tags','attribute_set','brand_id','name','current_stock','unit_price','locations')->get();  
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
