<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;
class Location implements FromCollection,WithHeadings
{
        public function collection() {
        return DB::Table('locations')->select('id','name')->get();  
    }
    public function headings(): array {
        return [
            'Id',
            'Name'

        ];
    }
}
