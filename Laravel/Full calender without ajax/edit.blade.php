@component('website.backend.components.modal',['id'=>'update-event','title'=>'Event Details'])
<form method="post" action="{{route('association.add.event')}}" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" name="type" value="custom-update">
    <input type="hidden" name="event_id" value="{{$event->id}}">
    <div class="form-group">
    <label>Image</label>
    <input type="file" class="form-control" name="image">
    <img src="{{asset('public/website/backend/images/'.$event->image)}}" class="img-md img-responsive img-bordered margin">
</div>
<div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="title" value="{{$event->title}}" required>
</div>
<div class="form-group">
    <label>Venue</label>
    <input type="text" class="form-control" name="venue" value="{{$event->venue}}" required>
</div>
<div class="form-group">
    <label>Start Date & Time</label>
    <input type="datetime-local" class="form-control" name="start_date_time" value="{{$event->start}}" required>
</div>
<div class="form-group">
    <label>End Date & Time</label>
    <input type="datetime-local" class="form-control" name="end_date_time" value="{{$event->end}}" required>
</div>
<div class="form-group">
    <label>Description</label>
    <textarea name="description" class="form-control" required>{{$event->description}}</textarea>
</div>
<button type="submit" class="btn btn-primary btn-block" id="add-event">Submit</button>
<a onclick="return confirm('Are you sure?')" href="{{route('association.delete.event',[$event->id])}}" class="btn btn-danger btn-block delete-event">Delete</a>
</form>
@endcomponent