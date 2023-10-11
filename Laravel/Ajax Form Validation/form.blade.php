@extends('frontend.layouts.app')
@section('style')
<style>
.form-group.row {
border-radius:8px;
}
.form-horizontal {
background:#000;
}
.form-horizontal label {
color:white;
}
.form-horizontal i {
font-size: 6px;color: red;position: relative;top: -3px;left: 1px;
}
</style>
@endsection
@section('content')
@php
$referral_form=DB::table('referral_forms')->first();
$data=json_decode($referral_form->value);
@endphp
<div class="container-fluid pb-5" style="padding:0;">
    <div>
        <div class="card" style="box-shadow:none;">
            <div class="card-body">
                <form action="{{route('customer.verification.form.store')}}" method="post" autocomplete="off" class="py-3">
                    {{csrf_field()}}
                    <div class="row">
                        <input type="hidden" name="code" value="{{$user_code}}">
                        <input type="hidden" name="code_by_name" value="{{$user_name}}">
                        <input type="hidden" name="code_by_email" value="{{$user_email}}">
                        @if($data)
                        <div class="col-lg-8 form-horizontal mx-auto" id="form" style="padding: 25px;border-radius: 17px;border:2px solid {{typography()->border_color}};">
                            @foreach($data as $row)
                            @if($row->type=="text")
                            @php
                            $name=str_replace(' ','_',$row->label);
                            @endphp
                            <div class="form-group row" style="background:rgba(0,0,0,0.1);padding:10px 0;">
                                <input type="hidden" name="type[]" value="text">
                                <input type="hidden" name="name[]" value="{{$row->label}}">
                                <div class="col-lg-3">
                                    <label class="col-from-label">{{$row->label}}@if($row->required=='yes')<i class="fas fa-star"></i>@endif</label>
                                </div>
                                <div class="col-lg-7">
                                    <input class="form-control" type="{{$row->type}}" name="value[]" placeholder="Enter {{$row->label}}" autocomplete="off" @if($row->required=='yes') required @endif>
                                </div>
                            </div>
                            @elseif($row->type=="email")
                            @php
                            $name=str_replace(' ','_',$row->label);
                            @endphp
                            <div class="form-group row" style="background:rgba(0,0,0,0.1);padding:10px 0;">
                                <input type="hidden" name="type[]" value="{{$row->type}}">
                                <input type="hidden" name="name[]" value="{{$row->label}}">
                                <div class="col-lg-3">
                                    <label class="col-from-label">{{$row->label}}@if($row->required=='yes')<i class="fas fa-star"></i>@endif</label>
                                </div>
                                <div class="col-lg-7">
                                    <input type="hidden" name="email_id" id="email_id" value="">
                                    <input class="form-control" type="{{$row->type}}" id="email" name="value[]" placeholder="Enter {{$row->label}}" autocomplete="off" @if($row->required=='yes') required @endif>
                                    <input type="number" class="form-control mt-2" id="verify-box" placeholder="Enter 4 digit otp" style="display:none;" value="">
                                    <span id="chkPwd"></span>
                                </div>
                                <div class="col-lg-2"><a href="#" class="btn-primary p-1" id="verify-email" style="position: relative;top: 4px;">Verify Email</a>
                            </div>
                        </div>
                        @elseif($row->type=="number")
                        @php
                        $name=str_replace(' ','_',$row->label);
                        @endphp
                        <div class="form-group row" style="background:rgba(0,0,0,0.1);padding:10px 0;">
                            <input type="hidden" name="type[]" value="{{$row->type}}">
                            <input type="hidden" name="name[]" value="{{$row->label}}">
                            <div class="col-lg-3">
                                <label class="col-from-label">{{$row->label}}@if($row->required=='yes')<i class="fas fa-star"></i>@endif</label>
                            </div>
                            <div class="col-lg-7" style="display: grid;grid-template-columns: 8% 80%;grid-column-gap: 47px;">
                                <input class="phone_country_code" style="border: none!important;width: 0px;height: 38px;border-radius: 5px;"><input class="form-control" type="{{$row->type}}" name="value[]" placeholder="Enter {{$row->label}}" @if($row->required=='yes') required @endif>
                            </div>
                        </div>
                        @elseif($row->type=="select")
                        @php
                        $name=str_replace(' ','_',$row->label);
                        @endphp
                        <div class="form-group row" style="background:rgba(0,0,0,0.1);padding:10px 0;">
                            <input type="hidden" name="type[]" value="select">
                            <input type="hidden" name="name[]" value="{{$row->label}}">
                            <div class="col-lg-3">
                                <label class="col-from-label">{{$row->label}}@if($row->required=='yes')<i class="fas fa-star"></i>@endif</label>
                            </div>
                            <div class="col-lg-7">
                                <select class="form-control select2" style="width: 100%;" name="value[]" @if($row->required=='yes') required @endif>
                                    <option value="" disabled selected>Select {{$row->label}}</option>
                                    @php
                                    $options=json_decode($row->options);
                                    @endphp
                                    @foreach($options as $option)
                                    <option>{{$option}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @elseif($row->type=="radio")
                        <div class="form-group row" style="background:rgba(0,0,0,0.1);padding:10px 0;">
                            <input type="hidden" name="type[]" value="radio">
                            <input type="hidden" name="name[]" value="{{$row->label}}">
                            <div class="col-lg-3">
                                <label class="col-from-label">{{$row->label}}</label>
                            </div>
                            <div class="col-lg-7">
                                @php
                                $radios=json_decode($row->options);
                                $name=str_replace(' ','_',$row->label);
                                @endphp
                                @foreach($radios as $radio)
                                <div class="icheck-primary d-inline">
                                    <input type="{{$row->type}}" name="value[]" value="{{$radio}}" @if($row->required=='yes') required @endif>
                                    <label for="radioPrimary3">
                                        {{$radio}}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @elseif($row->type=="file")
                        @php
                        $name=str_replace(' ','_',$row->label);
                        @endphp
                        <div class="form-group row" style="background:rgba(0,0,0,0.1);padding:10px 0;">
                            <input type="hidden" name="type[]" value="file">
                            <input type="hidden" name="name[]" value="{{$row->label}}">
                            <div class="col-lg-3">
                                <label class="col-from-label">{{$row->label}}@if($row->required=='yes')<i class="fas fa-star"></i>@endif</label>
                            </div>
                            <div class="col-lg-7">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="{{$row->type}}" class="custom-file-input" id="exampleInputFile" name="value[]" @if($row->required=='yes') required @endif>
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div
                            </div>
                        </div>
                    </div>
                    @elseif($row->type=="multi_select")
                    @php
                    $name=str_replace(' ','_',$row->label);
                    @endphp
                    <div class="form-group row" style="background:rgba(0,0,0,0.1);padding:10px 0;">
                        <input type="hidden" name="type[]" value="multi_select">
                        <input type="hidden" name="name[]" value="{{$row->label}}">
                        <div class="col-lg-3">
                            <label class="col-from-label">{{$row->label}}@if($row->required=='yes')<i class="fas fa-star"></i>@endif</label>
                        </div>
                        <div class="col-lg-7">
                            <select class="select2" multiple="multiple" data-placeholder="Select a State" name="value[]" style="width: 100%;" @if($row->required=='yes') required @endif>
                                <option value="" disabled selected>Select {{$row->label}}</option>
                                @php
                                $options=json_decode($row->options);
                                @endphp
                                @foreach($options as $option)
                                <option>{{$option}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @if($column->country==1)
                    <div class="form-group row" style="background:rgba(0,0,0,0.1);padding:10px 0;">
                        <input type="hidden" name="type[]" value="Country">
                        <input type="hidden" name="name[]" value="Country">
                        <div class="col-lg-3">
                            <label class="col-from-label">@if($column->country_required==1)Country<i class="fas fa-star"></i>@else Country @endif</label>
                        </div>
                        <div class="col-lg-7">
                            <select class="form-control select2" style="width: 100%;" name="value[]" @if($column->country_required==1) required @endif>
                                <option value="" disabled selected>Select Country</option>
                                @foreach($countries as $country)
                                <option value="{{$country->name}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                    @if($column->nationality==1)
                    <div class="form-group row" style="background:rgba(0,0,0,0.1);padding:10px 0;">
                        <input type="hidden" name="type[]" value="Nationality">
                        <input type="hidden" name="name[]" value="Nationality">
                        <div class="col-lg-3">
                            <label class="col-from-label">@if($column->nationality_required==1)Nationality<i class="fas fa-star"></i>@else Nationality @endif</label>
                        </div>
                        <div class="col-lg-7">
                            <select class="form-control select2" style="width: 100%;" name="value[]" @if($column->nationality_required==1) required @endif>
                                <option value="" disabled selected>Select Country</option>
                                @foreach($countries as $country)
                                <option value="{{$country->name}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                </div>
                @endif
            </div>
            <div class="form-group mb-0 text-right">
                <button type="submit" class="btn btn-primary btn-block w-50 mx-auto py-2 mt-3" id="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection
@section('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
$('#submit').attr('disabled','disabled');
$('#verify-email').click(function() {
var email=$('#email').val();
$.ajax({
type:'get',
url: '{{route('verify.mail')}}',
data:{email:email},
success:function(resp) {
if(resp=="true")
{
$("#chkPwd").html("<font color='red'></font>");
$('#verify-box').show();
Swal.fire({
title: 'An 4 digit otp sent to your mail.Please check your spam folder also',
showClass: {
popup: 'animate__animated animate__fadeInDown'
},
hideClass: {
popup: 'animate__animated animate__fadeOutUp'
}
})
}
else if(resp=="false")
{
$("#chkPwd").html("<font color='red'>Email already taken</font>");
}
}
});
});
});
</script>
<script>
$(document).ready(function() {
$('#verify-box').keyup(function() {
var value=$(this).val();
if(value.length > 3)
{
var email=$('#email').val();
var otp=$('#verify-box').val();
$.ajax({
type:'get',
url: '{{route('verify.otp')}}',
data:{email:email,otp:otp},
success:function(resp) {
if(resp=="false")
{
$("#chkPwd").html("<font color='red'>otp is incorrect</font>");
$('#submit').attr('disabled','disabled');
}else if(resp=="true")
{
$("#chkPwd").html("<font color='green'>otp is correct</font>");
$('#submit').removeAttr('disabled');
}
}
});
}
});
});
</script>
<script>
$(document).ready(function() {
$('#email').keyup(function() {
var email=$(this).val();
$('#email_id').val(email);
$.ajax({
type:'get',
url: '{{route('email.check')}}',
data:{email:email},
success:function(resp) {
if(resp=="false")
{
$("#chkPwd").html("<font color='red'>Email already taken</font>");
}
else if(resp=="true")
{
$("#chkPwd").html("<font color='red'></font>");
}
}
});
});
});
</script>
@endsection