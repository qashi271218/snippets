<?php

namespace App\Http\Controllers\Developer\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Location;
class HomeController extends Controller
{
    public function shipping_and_discounts()
    {
        return view('backend.developer.backend.shipping-and-discount');
    }
    
    public function shipping_and_discounts_update(Request $request)
    {
        $free_shipping=DB::table('shipping_and_discounts')->where('id',$request->free_shipping_id)->update(['amount'=>$request->free_shipping_amount]);
        flash('Record has been updated successfully')->success();
        return redirect()->back();
    }
    
    public function add_country_shipping_charge(Request $request)
    {
        $count=DB::table('shipping_and_discounts')->where('country',$request->country)->count();
        if($count > 0)
        {
        flash('Country already exist')->error();
        }
        else
        {
        $country=json_encode($request->country);
        DB::table('shipping_and_discounts')->insert(['country'=>$country,'type'=>$request->type,'amount'=>$request->country_shipping_amount]);
         flash('Record has been inserted successfully')->success();
        }
        return redirect()->back();
    }
    
    public function edit_country_shipping_charge($id)
    {
        $data=DB::table('shipping_and_discounts')->where('id',$id)->first();
        return view('backend.developer.backend.edit_country_shipping_charge',compact('data'));
    }
    
    public function update_country_shipping_charge(Request $request)
    {
        $count=DB::table('shipping_and_discounts')->where('id','!=',$request->country_shipping_id)->where('country',$request->country)->count();
        if($count > 0)
        {
        flash('Country already exist')->error();
        }
        else
        {
        $country=json_encode($request->country);
        $free_shipping=DB::table('shipping_and_discounts')->where('id',$request->country_shipping_id)->update(['country'=>$country,'amount'=>$request->country_shipping_amount]);
        flash('Record has been updated successfully')->success();
        }
        return redirect()->route('admin.shipping-discounts');
    }
     
    public function delete_country_shipping_charge($id)
    {
        $free_shipping=DB::table('shipping_and_discounts')->where('id',$id)->delete();
        flash('Record has been deleted successfully')->success();
        return redirect()->back();
    }
     
    public function add_customer_type(Request $request)
    {
        $count=DB::table('customers_type')->where('name',$request->customer_type_name)->count();
        if($count > 0)
        {
        flash('Data already exist')->error();
        }
        else
        {
      DB::table('customers_type')->insert(['name'=>$request->customer_type_name]);  
      flash('Record has been inserted successfully')->success();
        }
        return redirect()->back();
    }
    
    public function update_customer_type(Request $request)
    {
        $count=DB::table('customers_type')->where('id','!=',$request->customer_type_id)->where('name',$request->edit_customer_type_name)->count();
        if($count > 0)
        {
        flash('Data already exist')->error();
        }
        else
        {
       DB::table('customers_type')->where('id',$request->customer_type_id)->update(['name'=>$request->edit_customer_type_name]);  
      flash('Record has been updated successfully')->success();
        }
        return redirect()->back();  
    }
    
    public function add_customer_type_discount(Request $request)
    {
        $count=DB::table('shipping_and_discounts')->where('customer_type_name',$request->customer_type_name)->count();
        if($count > 0)
        {
        flash('Data already exist')->error();
        }
        else
        {
        DB::table('shipping_and_discounts')->insert(['type'=>'customer_type','customer_type_name'=>$request->customer_type_name,'amount'=>$request->customer_type_discount]);
         flash('Record has been inserted successfully')->success();
        }
        return redirect()->back();
    }
    
    public function update_customer_type_discount(Request $request)
    {
        $count=DB::table('shipping_and_discounts')->where('id','!=',$request->edit_cutomer_type_discount_id)->where('customer_type_name',$request->edit_cutomer_type_discount_name)->count();
        if($count > 0)
        {
        flash('Data already exist')->error();
        }
        else
        {
        DB::table('shipping_and_discounts')->where('id',$request->edit_cutomer_type_discount_id)->update(['customer_type_name'=>$request->edit_cutomer_type_discount_name,'amount'=>$request->edit_cutomer_type_discount_amount]);
         flash('Record has been updated successfully')->success();
        }
        return redirect()->back();
    }
    
    public function delete_customer_type_discount($id)
    {
     $free_shipping=DB::table('shipping_and_discounts')->where('id',$id)->delete();
        flash('Record has been deleted successfully')->success();
        return redirect()->back();   
    }
    public function update_free_shipping_status(Request $request)
    {
        $product = DB::table('shipping_and_discounts')->where('id',$request->id)->update(['status'=>$request->status]);
        return 1;
    }
    
    public function update_ecustomer_type_status(Request $request)
    {
      $product = DB::table('customers_type')->where('id',$request->id)->update(['status'=>$request->status]);
        return 1;  
    }
    
    public function warehouse_location(Request $request)
    {
        $locations = Location::orderBy('id','desc')->get();
        return view('backend.developer.backend.location',compact('locations'));
    }
    
    public function add_warehouse_location(Request $request)
    {
        $input=$request->all();
        Location::create($input);
        flash('Record has been added successfully')->success();
        return redirect()->back(); 
    }
    
    public function update_warehouse_location(Request $request)
    {
        $location=Location::findOrFail($request->edit_id);
        $input=$request->all();
         $location->update($input);
        flash('Record has been updated successfully')->success();
        return redirect()->back(); 
        
    }
     
    public function delete_warehouse_location($id)
    {
        Location::where('id',$id)->delete();
        flash('Record has been deleted successfully')->success();
        return redirect()->back(); 
    }
    
    public function ajax_warehouse_location_search(Request $request)
    {
        $locations=DB::table('locations')->where('name','LIKE',"%$request->value%")->get();
        return view('backend.developer.backend.include.location',compact('locations'));
    }
    
    public function update_warehouse_location_status(Request $request)
    {
       $product = Location::where('id',$request->id)->update(['status'=>$request->status]);
        return 1;  
    }
    
    public function update_popup_status(Request $request)
    {
       $product = DB::table('authors')->where('id',$request->id)->update(['status'=>$request->status]);
        return 1;  
    }
    
    public function update_popup(Request $request)
    {
        DB::table('authors')->where('id',$request->id)->update(['name'=>$request->content]);
        flash('Record has been updated successfully')->success();
        return redirect()->back(); 
    }
    
    public function add_author(Request $request)
    {
      DB::table('authors')->insert(['name'=>$request->author]);
        flash('Record has been updated successfully')->success();
        return redirect()->back();   
    }
}
