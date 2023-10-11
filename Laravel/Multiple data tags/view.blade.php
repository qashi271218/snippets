<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js"></script>

<style>
     .label-info {
      background:#3c8dbc!important;
  }
  .bootstrap-tagsinput {
  width: 100% !important;
}
</style>

<div class="form-group">
   <label>Faciliies</label><br>
   @php
   $data=json_decode($venue_owner->facilities)
   @endphp
   @if($data)
    <input type="text" class="form-control" name="facilities[]" placeholder="Enter facilities" value="@foreach($data as $row) {{$row}} @endforeach" id="tags-input" data-role="tagsinput" required> 
   @endif
</div>

@section('script')
<script>
   $('#tags-input').tagsinput({
  allowDuplicates: false,
  cancelConfirmKeysOnEmpty: false,
});
</script>