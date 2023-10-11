public function add_achievement(Request $request)
    {
        $athlete=Athlete::where('user_id',Auth::user()->id)->first();
        $form=array();
        for ($i=0; $i < count(array_unique(array_map("strtolower",$request->achievement))); $i++) {
               $item['name'] = $request->achievement[$i];  
               array_push($form, $item);
        }
        $athlete->achievements=json_encode($form);
        $athlete->achievements=json_encode($form);
        $athlete->save();
        $message=toastr_message()['added'];
        $notification=toastr_notification($message,'success');
        return Redirect()->back()->with($notification);
    }
    
    public function delete_achievement(Request $request,$name)
    {
       $athlete=Athlete::where('user_id',Auth::user()->id)->first();
       $athlete_achievements=json_decode($athlete->achievements);
       $form=array();
       if($athlete_achievements)
       {
        foreach($athlete_achievements as $key=>$row)
        {
              if($row->name==$name)
            {
                unset($athlete_achievements[$key]);
                $item['name']='';
                
            }
            else
            {
                $item['name']=$row->name;
            }
            if($item['name']!='')
            {
                array_push($form,$item);
            }
        }
        $athlete->achievements=json_encode($form);
        $athlete->save();
        $message=toastr_message()['deleted'];
        $notification=toastr_notification($message,'success');
        return Redirect()->back()->with($notification);
        }