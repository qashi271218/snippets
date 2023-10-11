<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
class EventController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
          $data = Event::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title', 'start', 'end','venue','description','image']);
            return response()->json($data);  
        }
        return view('website.backend.admin.event.index');
    }
    
    public function event_store(Request $request)
    {
    		if($request->type == 'add')
    		{
    		    $event=new Event;
    		    $event->title=$request->title;
    		    $event->venue=$request->venue;
    		    $event->start=Carbon::parse($request->start_date_time);
    		    $event->end=Carbon::parse($request->end_date_time);
    		    $event->description=$request->description;
    		    if($file = $request->file('image')) {
                $name = time().hexdec(uniqid()).'.'.$file->getClientOriginalName();
                $file->move(public_path().'/website/backend/images/', $name);
                $event->image=$name;
                }
    		    $event->save();
    		    $message=toastr_message()['added'];
                $notification=toastr_notification($message,'success');
                return Redirect()->back()->with($notification);
    		}
    		elseif($request->type == 'custom-update')
    		{
    		    $event=Event::where('id',$request->event_id)->first();
    		    $event->title=$request->title;
    		    $event->venue=$request->venue;
    		    $event->start=Carbon::parse($request->start_date_time);
    		    $event->end=Carbon::parse($request->end_date_time);
    		    $event->description=$request->description;
    		    if($file = $request->file('image')) {
    		    if(isset($event->image))
                {
                unlink(public_path('website/backend/images/'). $event->image);
                }
                $name = time().hexdec(uniqid()).'.'.$file->getClientOriginalName();
                $file->move(public_path().'/website/backend/images/', $name);
                $event->image=$name;
                }
    		    $event->save();
    		    $message=toastr_message()['updated'];
                $notification=toastr_notification($message,'success');
                return Redirect()->back()->with($notification);
    		}
         elseif($request->ajax())
    	{
    		if($request->type == 'update')
    		{
    			$event = Event::find($request->id)->update([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'delete')
    		{
    		    $event = Event::find($request->id)->first();
    		    if(isset($event->image))
                {
                unlink(public_path('website/backend/images/'). $event->image);
                }
    			$event = Event::find($request->id)->delete();

    			return response()->json($event);
    		}
    	}
    }
}
