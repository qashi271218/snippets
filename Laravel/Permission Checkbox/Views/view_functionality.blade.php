@extends('dashboard.app')
@section('style')
<style>
    input.form-control.q {
    background: #fff!important;
}
</style>
@endsection
@section('content')
            <div class="row">
             <table class="table table-bordered table-striped" id="user_table" style="margin-top:-12px;">
						<thead>
							<tr>
							</tr>
						</thead>
						<tbody>
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
						<td><input type="text" name="functionality[]" class="form-control q" value="{{$permission->feature}}" readonly/></td>
						<td><input type="text" name="description[]" class="form-control q" value="{{$permission->capability}}" readonly/>
						</tr>
						@endif
						@endif
						@endforeach
						@endif
						</tfoot>
				</table>
          </div>
@endsection