<?php

namespace App\Http\Controllers\Developer\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Subscriber;
use App\Auction;
use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

use App\Category;
use App\SubCatogory;
use App\AuctionBidder;
use App\Payment;
use App\User;
class HomeController extends Controller
{
    public function filter_auction(Request $request)
    {
        $query=http_build_query($request->query());
        if($query=="")
        {
            return redirect()->route('homepage');
        }
        else
        {
        $categoryId = $request->category;
        $subcategoryId = $request->subcategory;
        $priceId=$request->price;
        $statusId=$request->status;
       if($request->category){
            $filter_records=Auction::join('users','auctions.user_id','users.id')
                        ->join('categories','auctions.category_id','categories.id')
                        ->join('sub_catogories','auctions.sub_category_id','sub_catogories.id')
                        ->select(['auctions.id','auctions.title','auctions.slug',
                                  'auctions.description','auctions.image',
                                  'auctions.reserve_price','auctions.auction_status','live_auction_start_time'])
                        ->whereIn('auctions.category_id', $request->category)
                        ->where('auctions.admin_status','approved')
                        ->where('users.role_id',getRoleData('seller'))
                        ->where('users.approved',1)
                        ->where('auctions.end_date','>=',NOW())
                        ->where('categories.status','Active')
                        ->where('sub_catogories.status','Active')
                        ->where(function ($query) {
                        $query->where('auctions.auction_status', '=', 'open')
                              ->orWhere('auctions.auction_status', '=', 'new');
                        })
                        ->orderBy('auctions.id','desc')
                        ->get(); 
       }
       elseif($request->subcategory){
            $filter_records=Auction::join('users','auctions.user_id','users.id')
                        ->join('categories','auctions.category_id','categories.id')
                        ->join('sub_catogories','auctions.sub_category_id','sub_catogories.id')
                        ->select(['auctions.id','auctions.title','auctions.slug',
                                  'auctions.description','auctions.image',
                                  'auctions.reserve_price','auctions.auction_status','live_auction_start_time'])
                        ->whereIn('auctions.sub_category_id', $request->subcategory)
                        ->where('auctions.admin_status','approved')
                        ->where('users.role_id',getRoleData('seller'))
                        ->where('users.approved',1)
                        ->where('auctions.end_date','>=',NOW())
                        ->where('categories.status','Active')
                        ->where('sub_catogories.status','Active')
                        ->where(function ($query) {
                        $query->where('auctions.auction_status', '=', 'open')
                              ->orWhere('auctions.auction_status', '=', 'new');
                        })
                        ->orderBy('auctions.id','desc')
                        ->get(); 
       }
       elseif($request->price){
            $filter_records=Auction::join('users','auctions.user_id','users.id')
                        ->join('categories','auctions.category_id','categories.id')
                        ->join('sub_catogories','auctions.sub_category_id','sub_catogories.id')
                        ->select(['auctions.id','auctions.title','auctions.slug',
                                  'auctions.description','auctions.image',
                                  'auctions.reserve_price','auctions.auction_status','live_auction_start_time'])
                        ->whereIn('auctions.buy_now_price', $request->price)
                        ->where('auctions.admin_status','approved')
                        ->where('users.role_id',getRoleData('seller'))
                        ->where('users.approved',1)
                        ->where('auctions.end_date','>=',NOW())
                        ->where('categories.status','Active')
                        ->where('sub_catogories.status','Active')
                        ->where(function ($query) {
                        $query->where('auctions.auction_status', '=', 'open')
                              ->orWhere('auctions.auction_status', '=', 'new');
                        })
                        ->orderBy('auctions.id','desc')
                        ->get(); 
       }
       elseif($request->status){
            $filter_records=Auction::join('users','auctions.user_id','users.id')
                        ->join('categories','auctions.category_id','categories.id')
                        ->join('sub_catogories','auctions.sub_category_id','sub_catogories.id')
                        ->select(['auctions.id','auctions.title','auctions.slug',
                                  'auctions.description','auctions.image',
                                  'auctions.reserve_price','auctions.auction_status','live_auction_start_time'])
                        ->whereIn('auctions.auction_status', $request->status)
                        ->where('auctions.admin_status','approved')
                        ->where('users.role_id',getRoleData('seller'))
                        ->where('users.approved',1)
                        ->where('auctions.end_date','>=',NOW())
                        ->where('categories.status','Active')
                        ->where('sub_catogories.status','Active')
                        ->where(function ($query) {
                        $query->where('auctions.auction_status', '=', 'open')
                              ->orWhere('auctions.auction_status', '=', 'new');
                        })
                        ->orderBy('auctions.id','desc')
                        ->get(); 
       }
        return view('frontend.home',compact('filter_records','categoryId','subcategoryId','priceId','statusId'));
        }
    }
}