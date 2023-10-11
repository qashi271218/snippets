<meta name="csrf-token" content="{{ csrf_token() }}" />
@extends('website.backend.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
    @component('website.backend.components.box',['title'=>'Events'])
    <div id="result"></div>

    <div id="calendar"></div>
@endcomponent
</div>
</div>

@component('website.backend.components.modal',['id'=>'addEvent','title'=>'Add Event'])
<form method="post" action="{{route('association.add.event')}}" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" name="type" value="add">
    <div class="form-group">
    <label>Image</label>
    <input type="file" class="form-control" name="image" required>
</div>
<div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="title" required>
</div>
<div class="form-group">
    <label>Venue</label>
    <input type="text" class="form-control" name="venue" required>
</div>
<div class="form-group">
    <label>Start Date & Time</label>
    <input type="datetime-local" class="form-control" name="start_date_time" required>
</div>
<div class="form-group">
    <label>End Date & Time</label>
    <input type="datetime-local" class="form-control" name="end_date_time" required>
</div>
<div class="form-group">
    <label>Description</label>
    <textarea name="description" class="form-control" required></textarea>
</div>
<button type="submit" class="btn btn-primary btn-block" id="add-event">Submit</button>
</form>
@endcomponent

@endsection
@section('script')
<script>

$(document).ready(function () {

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    var calendar = $('#calendar').fullCalendar({
        editable:true,
        header:{
            left:'prev,next today',
            center:'title',
            //right:'month,agendaWeek,agendaDay'
        },
    timeFormat: 'H(:mm)',
    displayEventTime: true,
        events:'{{route('association.events')}}',
        selectable:true,
        selectHelper: true,
        select:function(start, end, allDay)
        {
            $('#addEvent').modal('show');
        },
        editable:true,
        eventClick:function(event,delta)
        {
                var id=event.id;
                $.ajax({
                    url:"{{route('association.add.event')}}",
                    type:"POST",
                    data:{
                        id:id,
                        type:"edit"
                    },
                    success:function(response)
                    {
                        $('#result').html(response);
                        $('#update-event').modal('show');
                        calendar.fullCalendar('refetchEvents');
                    }
                });
        }
    });

});
</script>
@endsection