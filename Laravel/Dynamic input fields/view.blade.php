@extends('website.backend.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Homepage</h3>
            </div>
          </div>
                  <div class="box">
            <div class="box-header with-border">
              <form method="post" action="{{route('admin.homepage.banner.store')}}" enctype="multipart/form-data">
              {{csrf_field()}}
                 <table class="table table-bordered table-striped" id="user_table">
               <thead>
                <tr>
                    <th width="35%">Banner</th>
                    <th width="35%">Link</th>
                    <th width="30%">Action</th>
                </tr>
               </thead>
               <tbody>
                   
               </tbody>
               <tfoot>
                @php
                $data=json_decode($homepage_banner->old_value);
                $data2=json_decode($homepage_banner->value);
                @endphp
                @if($data2)
                @foreach($data2 as $key=>$row)
                <tr>
                    <td><input type="file" name="banner[]" class="form-control"/><img src="{{asset('public/website/backend/images/'.$row->banner)}}" class="img-responsive img-bordered margin img-md"></td>
                    <input type="hidden" name="exist_banner[]" value="{{$row->banner}}">
                    <td><input type="text" name="exist_link[]" class="form-control" value="{{$row->link}}"></td>
                    <td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td>
                </tr>
                @endforeach
                <tr>
                @endif
                
                @if($data)
                @foreach($data as $key=>$row)
                <tr>
                    <td><input type="file" name="banner[]" class="form-control"/><img src="{{asset('public/website/backend/images/'.$row->old_banner)}}" class="img-responsive img-bordered margin img-md"></td>
                    <input type="hidden" name="exist_banner[]" value="{{$row->old_banner}}">
                    <td><input type="text" name="exist_link[]" class="form-control" value="{{$row->old_link}}"></td>
                    <td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td>
                </tr>
                @endforeach
                <tr>
                @endif
                <td colspan="2" align="right">&nbsp;</td>
                <td>
                  <input type="submit" name="save" id="save" class="btn btn-primary" value="Save" />
                 </td>
                </tr>
               </tfoot>
           </table>
                </form>
            </div>
          </div>

    </div>
@endsection
@section('script')
<script>
$(document).ready(function(){

 var count = 1;

 dynamic_field(count);

 function dynamic_field(number)
 {
  html = '<tr>';
        html += '<td><input type="file" name="banner[]" class="form-control"/></td>';
        html += '<td><input type="text" name="link[]" class="form-control" value="#" /></td>';
        if(number > 1)
        {
            html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
            $('tbody').append(html);
        }
        else
        {   
            html += '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
            $('tbody').html(html);
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
<script>
    $('.delete-banner').click(function() {
        var value = $(this).data('value');
                $.ajax({
                    type:'get',
                    url: '{{route('admin.homepage.banner.delete')}}',
                    data:{value:value},
                    success:function(data) {
                        console.log('item removed')
                        }
                });
    });
</script>