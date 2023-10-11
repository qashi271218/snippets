@extends('backend.layouts.app')
@section('content')
@php
$free_shipping=DB::table('shipping_and_discounts')->where('type','free_shipping_charge')->first();
$express_shipping=DB::table('shipping_and_discounts')->where('type','express_shipping_charge')->first();
$normal_shipping=DB::table('shipping_and_discounts')->where('type','normal_shipping_charge')->first();
$country_shipping_charges=DB::table('shipping_and_discounts')->where('type','country_shipping_charge')->get();
$customer_type_shipping_charges=DB::table('shipping_and_discounts')->where('type','customer_type')->get();
$customer_types=DB::table('customers_type')->orderBy('id','desc')->get();
$authors=DB::table('authors')->orderBy('id','desc')->get();
@endphp
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header row gutters-5">
                <div class="col">
                    <h5 class="mb-md-0 h6">Shipping In Ireland</h5>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-responsive-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Type</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-capitalize">
                            <td>1</td>
                            <td>free shipping</td>
                            <td>{{ single_price($free_shipping->amount) }}</td>
                            <td>
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input onchange="update_free_shipping_status(this)" value="{{ $free_shipping->id }}" type="checkbox" <?php if ($free_shipping->status == 1) echo "checked"; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td><a class="btn btn-soft-primary btn-icon btn-circle btn-sm shipping_edit_modal" href="#" data-toggle="modal" data-target="#free_shipping" data-id ="{{$free_shipping->id}}" data-amount="{{$free_shipping->amount}}" title="Edit"><i class="las la-edit"></i></a></td>
                        </tr>
                        <tr class="text-capitalize">
                            <td>2</td>
                            <td>express shipping</td>
                            <td>{{ single_price($express_shipping->amount) }}</td>
                            <td>
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input onchange="update_free_shipping_status(this)" value="{{ $express_shipping->id }}" type="checkbox" <?php if ($express_shipping->status == 1) echo "checked"; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td><a class="btn btn-soft-primary btn-icon btn-circle btn-sm shipping_edit_modal" href="#" data-toggle="modal" data-target="#free_shipping" data-id ="{{$express_shipping->id}}" data-amount="{{$express_shipping->amount}}" title="Edit"><i class="las la-edit"></i></a></td>
                        </tr>
                        <tr class="text-capitalize">
                            <td>3</td>
                            <td>normal shipping</td>
                            <td>{{ single_price($normal_shipping->amount) }}</td>
                            <td>
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input onchange="update_free_shipping_status(this)" value="{{ $normal_shipping->id }}" type="checkbox" <?php if ($normal_shipping->status == 1) echo "checked"; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td><a class="btn btn-soft-primary btn-icon btn-circle btn-sm shipping_edit_modal" href="#" data-toggle="modal" data-target="#free_shipping" data-id ="{{$normal_shipping->id}}" data-amount="{{$normal_shipping->amount}}" title="Edit"><i class="las la-edit"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header row gutters-5 d-flex justify-content-between">
                <div class="col">
                    <h5 class="mb-md-0 h6">Other Country Shipping Charges</h5>
                </div>
                <div>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#country_shipping_charge">Add New</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-responsive-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Country</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($country_shipping_charges as $key=>$country_shipping_charge)
                        <tr class="text-capitalize">
                            <td>{{$key+1}}</td>
                            <td>
                                {{$country_shipping_charge->region}}
                            </td>
                            <td>{{single_price($country_shipping_charge->amount)}}</td>
                            <td>
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input onchange="update_free_shipping_status(this)" value="{{ $country_shipping_charge->id }}" type="checkbox" <?php if ($country_shipping_charge->status == 1) echo "checked"; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td><a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('edit.country.shipping.charge',[$country_shipping_charge->id])}}"  title="Edit"><i class="las la-edit"></i></a>
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm d-none" onclick="return confirm('Are You Sure?')" href="{{route('delete.country.shipping.charge',[$country_shipping_charge->id])}}" title="Delete"><i class="las la-trash"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header row gutters-5 d-flex justify-content-between">
                <div class="col">
                    <h5 class="mb-md-0 h6">Add Customer type</h5>
                </div>
                <div>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add_customer_type">Add New</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-responsive-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customer_types as $key=>$customer_type)
                        <tr class="text-capitalize">
                            <td>{{$key+1}}</td>
                            <td>{{$customer_type->name}}</td>
                            <td>
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input onchange="update_customer_type_status(this)" value="{{ $customer_type->id }}" type="checkbox" <?php if ($customer_type->status == 1) echo "checked"; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td><a class="btn btn-soft-primary btn-icon btn-circle btn-sm customer_type_edit_modal" href="#" data-toggle="modal" data-target="#edit_customer_type" data-id ="{{$customer_type->id}}" data-name="{{$customer_type->name}}" title="Edit"><i class="las la-edit"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header row gutters-5 d-flex justify-content-between">
                <div class="col">
                    <h5 class="mb-md-0 h6">Manage Author</h5>
                </div>
                <div>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add_customer_type_discount">Add New</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-responsive-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($authors as $key=>$popup)
                        <tr class="text-capitalize">
                            <td>{{$key+1}}</td>
                            <td>{{$popup->name}}</td>
                            <td>
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input onchange="update_popup_status(this)" value="{{ $popup->id }}" type="checkbox" <?php if ($popup->status == 1) echo "checked"; ?>>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td><a class="btn btn-soft-primary btn-icon btn-circle btn-sm customer_type_edit_discount_modal" href="#" data-toggle="modal" data-target="#edit_customer_discount" data-id ="{{$popup->id}}" data-content="{{$popup->name}}" title="Edit"><i class="las la-edit"></i></a>
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm d-none" onclick="return confirm('Are You Sure?')" href="{{route('delete.customer.discount',[$popup->id])}}" title="Delete"><i class="las la-trash"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Edit free Shipping Modal -->
<div class="modal fade" id="free_shipping" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Free Shipping</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('free.shipping.update')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="free_shipping_id" id="free_shipping_id" value="">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Amount</label>
                        <input type="number" class="form-control" id="free_shipping_amount" name="free_shipping_amount" value="" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Country Shipping Charges -->
<div class="modal fade" id="country_shipping_charge" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Country Shipping Charge</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('add.country.shipping.charge')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="type" value="country_shipping_charge">
                    <div class="form-group">
                        <label>Country</label>
                        <select class="selectpicker form-control" name="country[]" data-live-search="true" multiple required>
                            @foreach (App\Models\Country::where('status',1)->get() as $country)
                            @php
                            $count=DB::table('shipping_and_discounts')->whereJsonContains('country',strval($country->id))->count();
                            @endphp
                            @if($count==0)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Amount</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="free_shipping_amount" name="country_shipping_amount" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">%</span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit country Shipping Modal -->
<div class="modal fade" id="edit_country_shipping" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Free Shipping</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('update.country.shipping.charge')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="country_shipping_id" id="country_shipping_id" value="">
                    <div class="form-group">
                        <label>Country</label>
                        <select class="form-control" name="country" id="edit_shipping_charge_country" required>
                            @foreach (App\Models\Country::where('status',1)->where('id','!=',105)->get() as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Amount</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="country_shipping_amount" name="country_shipping_amount" required>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupPrepend">%</span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Customer Type -->
<div class="modal fade" id="add_customer_type" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Customer Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('add.customer.type')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="customer_type_name" name="customer_type_name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Customer Type -->
<div class="modal fade" id="edit_customer_type" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Customer Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('update.customer.type')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="customer_type_id" id="customer_type_id" value="">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="edit_customer_type_name" name="edit_customer_type_name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Customer Type Discount -->
<div class="modal fade" id="add_customer_type_discount" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Author</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('add.author')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="author" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Customer Type Discount -->
<div class="modal fade" id="edit_customer_discount" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Customer Type Discount</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('update.popup.content')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="id" id="popup_id" value="">
                    <div class="form-group">
                        <label for="name">Content</label>
                        <input type="text" class="form-control" id="popup_content" name="content" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function (){
$('.shipping_edit_modal').click(function(){
$('#free_shipping_id').val($(this).data('id'));
$('#free_shipping_amount').val($(this).data('amount'));
});
});
</script>
<script>
$(document).ready(function (){
$('.country_shipping_edit_modal').click(function(){
$('#country_shipping_id').val($(this).data('id'));
$('#country_shipping_amount').val($(this).data('amount'));
var country=$(this).data('country');
$('#edit_shipping_charge_country > option[value="'+ country +'"]').attr('selected',true);
});
});
</script>
<script>
$(document).ready(function (){
$('.customer_type_edit_modal').click(function(){
$('#customer_type_id').val($(this).data('id'));
$('#edit_customer_type_name').val($(this).data('name'));
});
});
</script>
<script>
$(document).ready(function (){
$('.customer_type_edit_discount_modal').click(function(){
$('#popup_id').val($(this).data('id'));
$('#popup_content').val($(this).data('content'));
});
});
</script>
<script>
function update_free_shipping_status(el){
if(el.checked){
var status = 1;
}
else{
var status = 0;
}
$.post('{{ route('free_shipping.published') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
if(data == 1){
AIZ.plugins.notify('success', '{{ translate('Status updated successfully') }}');
}
else{
AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
}
});
}
</script>
</script>
<script>
function update_customer_type_status(el){
if(el.checked){
var status = 1;
}
else{
var status = 0;
}
$.post('{{ route('update.customer_type.status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
if(data == 1){
AIZ.plugins.notify('success', '{{ translate('Status updated successfully') }}');
}
else{
AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
}
});
}
</script>
<script>
function update_popup_status(el){
if(el.checked){
var status = 1;
}
else{
var status = 0;
}
$.post('{{ route('update.popup.status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
if(data == 1){
AIZ.plugins.notify('success', '{{ translate('Status updated successfully') }}');
}
else{
AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
}
});
}
</script>
@endsection