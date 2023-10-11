@extends('dashboard.app')
@section('content')
<form method="post" action="{{route('membership.update',$data->id)}}">
              {{csrf_field()}}
              <div class="row">
          <div class="col-md-6">
         <div class="form-group">
          <label class="font-medium">Membership Name</label>
          <input type="text" class="form-control" name="name" value="{{$data->name}}" required>
          </div>
          <div class="form-group">
          <label class="font-medium">Membership Price Per Month</label>
          <input type="text" class="form-control" name="price_per_month" value="{{$data->price_per_month}}" required>
          </div>
          <div class="form-group">
          <label class="font-medium">Tax in %</label>
          <input type="text" class="form-control" name="tax" value="{{$data->tax}}" required>
          </div>
          <div class="form-group">
          <label class="font-medium">Discount Price</label>
          <input type="text" class="form-control" name="discount_yearly_payment" value="{{$data->discount_yearly_payment}}" required>
          </div>
          <div class="form-group">
          <label class="font-medium">Membership Content</label>
          <input type="text" class="form-control" name="content" value="{{$data->content}}" required>
          </div>
          <div class="form-group">
          <label class="font-medium">Days</label>
          <input type="number" class="form-control" name="days" value="{{$data->days}}" required>
          </div>
          </div>
          <div class="col-md-6">
              <h4>Add Functionality</h4>
             <table class="table table-bordered table-striped" id="user_table" style="margin-top:-12px;">
						<thead>
							<tr>
							</tr>
						</thead>
						<tbody class="sub1">
						</tbody>
						<tfoot>
						@if($subContentData)
						@foreach($subContentData as $row)
						@if(isset($row->permissionId))
						@php
						$permission=DB::table('laravel_permission')->where('id',$row->permissionId)->first();
						@endphp
						@if($permission)
						<tr>
						<td><input type="checkbox" name="permission_id[]" value="{{$permission->id}}" checked></td>
						<td><input type="text" name="functionality[]" class="form-control" value="{{$permission->feature}}"></td>
						<td><input type="text" name="description[]" class="form-control" value="{{$permission->capability}}"/>
						</tr>
						@endif
						@endif
						@endforeach
						@endif
						@foreach($permissions as $permission)
							<tr>
						<td><input type="checkbox" name="permission_id[]" value="{{$permission->id}}"></td>
						<td><input type="text" name="functionality[]" class="form-control" value="{{$permission->feature}}"></td>
						<td><input type="text" name="description[]" class="form-control" value="{{$permission->capability}}"/>
						</tr>
						@endforeach
						</tfoot>
					</table>
          </div>
          </div>
         <div class="modal-footer">
         <button type="submit" class="btn btn-info">Update Membership</button>
      </div>
          </form>
@endsection
@section('script')
<script>
$(document).ready(function(){
var count = 1;
dynamic_field(count);
function dynamic_field(number)
{
html = '<tr>';
	html += '<td style="display:none;"><select name="" class="form-control"><option>Customers</option><option>Sales</option><option>Subscriptions</option><option>Expenses</option><option>Contracts</option><option>Projects</option><option>Tasks</option><option>Support</option><option>Leads</option><option>Estimate Request</option><option>Knowledge Base</option><option>Utilities</option><option>Reports</option><option>Setup</option></select></td>';
	html += '<td style="display:none;"><input type="text" name="" class="form-control" placeholder="add description"/></td>';
	if(number > 1)
	{
	html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
	$('.sub1').append(html);
	}
	else
	{
	html += '<td style="display:none;"><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
	$('.sub1').html(html);
	}
	}
	$(document).on('click', '#add', function(){
	count++;
	dynamic_field(count);
	});
	$(document).on('click', '.remove', function(){
	count--;
	$(this).closest("tr").remove();
	});
	});
	</script>
@endsection
