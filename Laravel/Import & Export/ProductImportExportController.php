<?php

namespace App\Http\Controllers\Developer\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Exports\ProductsExport;
use App\Exports\SampleExport;
use App\Exports\Brand;
use App\Exports\Location;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Artisan;
class ProductImportExportController extends Controller
{
    public function export($attribute)
    {
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
       return Excel::download(new ProductsExport($attribute), 'Products.xlsx');
    }
    
    public function import()
    {
      return view('backend.developer.backend.import-products');  
    }
    
    public function bulk_import()
    {
      Excel::import(new ProductsImport,request()->file('file'));  
       flash('products has been imported successfully')->success();
          return redirect()->back();

    }
    
    public function sample_download()
    {
      return Excel::download(new SampleExport, 'sample.xlsx');  
    }
    
    public function brand_download()
    {
      return Excel::download(new Brand, 'brands.xlsx'); 
      flash('Brand has been downloaded successfully')->success();
        return redirect()->back();
    }
    
    public function location_download()
    {
      return Excel::download(new Location, 'locations.xlsx'); 
      flash('Location has been downloaded successfully')->success();
        return redirect()->back();
    }
}