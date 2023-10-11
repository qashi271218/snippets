@extends('website.backend.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
    @component('website.backend.components.box',['title'=>'Events'])
    <div id="calendar"></div>
@endcomponent
</div>
</div>

@component('website.backend.components.modal',['id'=>'addEvent','title'=>'Add Event'])
<form method="post" action="{{route('admin.add.event')}}" enctype="multipart/form-data">
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

@component('website.backend.components.modal',['id'=>'showEvent','title'=>'Show Event'])
<form method="post" action="{{route('admin.add.event')}}" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" name="event_id" id="event_id" value="">
    <input type="hidden" name="type" value="custom-update">
    <div class="form-group">
    <label>Image</label>
    <input type="file" class="form-control" name="image" id="image">
    <img src="" class="img-responsive img-bordered img-md margin image">
</div>
<div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name="title" id="title" required>
</div>
<div class="form-group">
    <label>Venue</label>
    <input type="text" class="form-control" name="venue" id="venue" required>
</div>
<div class="form-group">
    <label>Start Date & Time</label>
    <input type="datetime-local" class="form-control" name="start_date_time" id="start_date_time" required>
</div>
<div class="form-group">
    <label>End Date & Time</label>
    <input type="datetime-local" class="form-control" name="end_date_time" id="end_date_time" required>
</div>
<div class="form-group">
    <label>Description</label>
    <textarea name="description" id="description" class="form-control" required></textarea>
</div>
<button type="submit" class="btn btn-primary btn-block" id="add-event">Update</button>

<a href="#" class="btn btn-danger btn-block" id="delete-event">Delete Event</a>
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
        events:'{{route('admin.events')}}',
        selectable:true,
        selectHelper: true,
        select:function(start, end, allDay)
        {
            $('#addEvent').modal('show');
            //var title = prompt('Event Title:');

            // if(title)
            // {
            //     var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');

            //     var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

            //     $.ajax({
            //         url:"{{route('admin.add.event')}}",
            //         type:"POST",
            //         data:{
            //             title: title,
            //             start: start,
            //             end: end,
            //             type: 'add'
            //         },
            //         success:function(data)
            //         {
            //             calendar.fullCalendar('refetchEvents');
            //             toastr.success("Event Created Successfully");
            //         }
            //     })
            // }
        },
        editable:true,
        eventResize: function(event, delta)
        {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var title = event.title;
            var id = event.id;
            $.ajax({
                url:"{{route('admin.add.event')}}",
                type:"POST",
                data:{
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                    type: 'update'
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    toastr.success("Event Updated Successfully");
                }
            })
        },
        eventDrop: function(event, delta)
        {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var title = event.title;
            var id = event.id;
            $.ajax({
                url:"{{route('admin.add.event')}}",
                type:"POST",
                data:{
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                    type: 'update'
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    toastr.success("Event Updated Successfully");
                }
            })
        },
        eventClick:function(event)
        {
            $('#showEvent').modal('show');
            $('#start_date_time').val($.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss'));
            $('#end_date_time').val($.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss'));
            $('#title').val(event.title);
            $('#description').val(event.description);
            $('#venue').val(event.venue);
            $('#event_id').val(event.id);
            img_url = 'https://athlete.hwinfotech.in/public/website/backend/images/';
             $('.image').prop('src', img_url+event.image);
        
         $('#delete-event').click(function() {
            if(confirm("Do you want to remove this event from calender?"))
            {
            var id = event.id;
                $.ajax({
                    url:"{{route('admin.add.event')}}",
                    type:"POST",
                    data:{
                        id:id,
                        type:"delete"
                    },
                    success:function(response)
                    {
                        calendar.fullCalendar('refetchEvents');
                        $('#ShowEvent').modal('hide');
                        toastr.success("Event Deleted Successfully");
                        location.reload();
                    }
                })
            }
            });
        }
    });

});
  
</script>
@endsection