<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CutomerFormDetails;
use App\ReferralCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\AfterUserRegisteration;
use App\Mail\OtpMail;
use DB;
use Str;
use Carbon\Carbon;
class CustomerController extends Controller
{
    public function form_view(Request $request)
    {
    $code=ReferralCode::where('code',$request->code)->first();
    $code_validity=DB::table('code_validity')->where('code',$request->code)->first();
    if($code)
    {
    $column=DB::table('registration_column')->first();
    $countries=DB::table('countries')->get();
    $user_code=$code->code;
    $user_email=$code->email;
    $user_name=$code->name;
    return view('frontend.customer.form',compact('user_code','user_email','user_name','column','countries'));
    }
    elseif($code_validity && ($code_validity->remaining < $code_validity->validity))
    {
    $column=DB::table('registration_column')->first();
    $countries=DB::table('countries')->get();
    $user_code=$code_validity->code;
    $name=DB::table('cutomer_form_details')->where('code',$user_code)->first();
    $email=DB::table('cutomer_form_details')->where('code',$user_code)->where('type','email')->value('value');
    $user_email=$email;
    $user_name=$name->value;
    DB::table('code_validity')->where('code',$user_code)->update(['remaining'=>$code_validity->remaining + 1]);
    return view('frontend.customer.form',compact('user_code','user_email','user_name','column','countries'));  
    }
    else
    {
      $notification = array(
            'messege' => 'Invalid Code',
            'alert-type' => 'error'
        );
           return Redirect()->route('homepage')->with($notification);  
    }
    }
    public function store(Request $request)
    {
    $count_user=ReferralCode::where('email',$request->email_id)->where('code',$request->code)->count();
    $type = $request->type;
    $value = $request->value;
    $name = $request->name;
    $user_id=random_int(1000,9999);
    $username=substr($request->value[0], 0, 3);
    $code=$username.random_int(100,999);
    $date=Carbon::now();
    if($count_user == 0)
    {
      for($count = 0; $count < count($type); $count++)
      {
       $data = array(
        'type' => $type[$count],
        'user_id'=>$user_id,
        'old_code'=>$request->code,
        'code_by'=>$request->code_by_name,
        'code_by_email'=>$request->code_by_email,
        'value'  => isset($value[$count]) ? $value[$count] : 'None',
        'name'  => $name[$count],
        'created_at'=>$date,
       );
       $insert_data[] = $data; 
      }
    }
    else
    {
      for($count = 0; $count < count($type); $count++)
      {
       $data = array(
        'type' => $type[$count],
        'user_id'=>$user_id,
        'old_code'=>$request->code,
        'code'=>$code,
        'code_by'=>'Admin',
        'code_by_email'=>env('MAIL_FROM_ADDRESS'),
        'value'  => $value[$count],
        'name'  => $name[$count],
        'created_at'=>$date,
       );
       $insert_data[] = $data; 
      }
    }
      $mail_data = array(
           'name'=>$request->value[0],
        );
     Mail::to($request->email_id)->send(new AfterUserRegisteration($mail_data));
      CutomerFormDetails::insert($insert_data);
      $notification = array(
            'messege' => 'Customer details added successfully',
            'alert-type' => 'success'
        );
        $code=DB::table('referral_codes')->get();
        DB::table('referral_codes')->where('code',$request->code)->delete();
           return Redirect()->route('homepage')->with($notification);
    }
    public function sendemail()
    {
        \Mail::raw('Customer wants a referral code!', function($msg) {$msg->to('qasimsumal@gmail.com')->subject('Referral Email'); });
        $notification = array(
            'messege' => 'Email send successfully',
            'alert-type' => 'success'
        );
           return Redirect()->route('homepage')->with($notification);
    }
    public function verifymail(Request $request)
    {
        $count=DB::table('otp_sent')->where('email',$request->email)->count();
        $email_count=DB::table('cutomer_form_details')->where('value',$request->email)->count();
        if($request->email && $count ==0 && $email_count ==0)
        {
        $otp=random_int(1000,9999);
        DB::table('otp_sent')->insert([
            'email'=>$request->email,
            'otp'=>$otp
            ]);
      $mail_data = array(
           'otp'=>$otp,
           'email'=>$request->email,
        );
     Mail::to($request->email)->send(new OtpMail($mail_data));
       echo "true";die;
      }
      elseif($email_count>0)
      {
      	echo "false";die;
      }
    }
    
    public function verifyotp(Request $request)
    {
        $data=DB::table('otp_sent')->where('email',$request->email)->where('otp',$request->otp)->first();
        if($data)
        {
        echo "true";die;
      }
      else
      {
      	echo "false";die;
      }
    }
    public function emailcheck(Request $request)
    {
        $email_count=DB::table('cutomer_form_details')->where('value',$request->email)->count();
        if($email_count==0)
        {
        echo "true";die;
      }
      else
      {
      	echo "false";die;
      }
    }
}
