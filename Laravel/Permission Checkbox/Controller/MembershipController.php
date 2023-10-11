<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Membership;
use Auth;
use DB;
class MembershipController extends Controller
{
    public function index()
    {
       $data=Membership::all();
       return view('company.membership.index',compact('data'));
    }
    public function create()
    {
       return view('company.membership.create');
    }
    public function store(Request $request)
    {
        $data=$request->all();
if (isset($data['permission_id'])) {
            $length = count($data['permission_id']);
            $j = 0;
            for ($i=0; $i < $length; $i++) { 
                $permissionId = $data['permission_id'][$i];
                $content[] = array(
                    'permissionId' => $permissionId,
                );
            }
        }
        $data['name'] = $request->name;
        $data['price_per_month'] = $request->price_per_month;
        $data['discount_yearly_payment'] = $request->discount_yearly_payment;
        $data['content'] = $request->content;
        $data['days'] = $request->days;
        $data['tax'] = $request->tax;
        $data['functionality'] = json_encode($content);
        Membership::create($data);
        return redirect()->back()->with('success','Membership added successfully');
    }
    public function edit($id)
    {
        $data=Membership::findOrFail($id);
        $subContentData=json_decode($data->functionality);
        foreach($subContentData as $key=>$row)
        {
        $arr[]=$row->permissionId;
        }
        $length=count($arr);
        for($i=0;$i<$length;$i++)
        {
            $data1[$i]=$arr[$i];
        }
        $permissions=DB::table('laravel_permission')->whereNotIn('id',$data1)->get();
        return view('company.membership.edit',compact('data','permissions','subContentData'));
    }
    public function update(Request $request,$id)
    {
        $membership=Membership::findOrFail($id);
        $data=$request->all();
if (isset($data['permission_id'])) {
            $length = count($data['permission_id']);
            $j = 0;
            for ($i=0; $i < $length; $i++) { 
                $permissionId = $data['permission_id'][$i];
                $content[] = array(
                    'permissionId' => $permissionId,
                );
            }
        }
        $data['name'] = $request->name;
        $data['price_per_month'] = $request->price_per_month;
        $data['discount_yearly_payment'] = $request->discount_yearly_payment;
        $data['content'] = $request->content;
        $data['days'] = $request->days;
        $data['tax'] = $request->tax;
        $data['functionality'] = json_encode($content);
        $membership->update($data);
        return redirect()->back()->with('success','Membership updated successfully');
    }
    public function delete($id)
    {
        Membership::findOrFail($id)->delete();
        return redirect()->back()->with('success','Membership deleted successfully');
    }
    public function transactions()
    {
        $data=DB::table('stripe_transactions')->orderBy('id','desc')->get();
        return view('admin.transaction',compact('data'));
    }
     public function user_transactions()
    {
        $data=DB::table('stripe_transactions')->where('email',Auth::user()->email)->orderBy('id','desc')->get();
        return view('admin.transaction',compact('data'));
    }
    public function view_functionality($id)
    {
       $data=Membership::findOrFail($id);
        $subContentData=json_decode($data->functionality);
        return view('company.membership.view_functionality',compact('subContentData'));
    }
}