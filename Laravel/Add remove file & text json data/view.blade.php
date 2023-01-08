@extends('website.backend.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-4">
        @component('website.backend.components.box',['title'=>'Homepage Banner'])
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addbanner">Add New Banner</button>
        @php
        $banners=json_decode($homepage_banner->value);
        $old_banners=json_decode($homepage_banner->old_value);
        @endphp
        @if($banners)
        @foreach($banners as $key=>$row)
        <div class="form-group" style="display: flex;align-items: center;margin-top:14px;">
            <label></label><br>
        <img src="{{asset('public/website/backend/images/'.$row->banner)}}" class="img-responsive img-bordered margin img-md">
        <form action="{{route('admin.homepage.functionality.delete',[$row->banner])}}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="type" value="homepage_banner">
        <input type="hidden" name="banner" value="{{$row->banner}}">
        <button type="submit"><i class="fa fa-trash text-danger"></i></button>
        </form>
        </div>
        @endforeach
        @endif
        @if($old_banners)
        @foreach($old_banners as $key=>$row)
        <div class="form-group" style="display: flex;align-items: center;margin-top:14px;">
            <label></label><br>
        <img src="{{asset('public/website/backend/images/'.$row->old_banner)}}" class="img-responsive img-bordered margin img-md">
        <form action="{{route('admin.homepage.functionality.delete',[$row->old_banner])}}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="type" value="homepage_banner">
        <input type="hidden" name="banner" value="{{$row->old_banner}}">
        <button type="submit"><i class="fa fa-trash text-danger"></i></button>
        </form>
        </div>
        @endforeach
        @endif
        @endcomponent
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addbanner" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Achievement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="post" action="{{route('admin.homepage.store')}}" enctype="multipart/form-data">
              {{csrf_field()}}
        <input type="hidden" name="type" value="homepage_banner">
        @php
        $banners=json_decode($homepage_banner->value);
        $old_banners=json_decode($homepage_banner->old_value);
        @endphp
        @if($banners)
        @foreach($banners as $key=>$row)
        <input type="hidden" class="form-control" name="old_banner[]" value="{{$row->banner}}" readonly>
        <input type="hidden" class="form-control" name="old_link[]" value="{{$row->link}}" readonly>
        @endforeach
        @endif
        
        @if($old_banners)
        @foreach($old_banners as $key=>$row)
        <input type="hidden" class="form-control" name="old_banner[]" value="{{$row->old_banner}}" readonly>
        <input type="hidden" class="form-control" name="old_link[]" value="{{$row->old_link}}" readonly>
        @endforeach
        @endif
        <div class="form-group">
            <label>Banner</label>
        <input type="file" class="form-control" name="banner[]" required>
        </div>
        <div class="form-group">
            <label>Link</label>
        <input type="text" class="form-control" name="link[]" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection