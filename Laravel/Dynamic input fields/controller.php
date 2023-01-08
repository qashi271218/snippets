public function page_update($slug)
    {
        $homepage_banner=WebsiteSetting::where('type','Homepage_banner')->first();
        if($slug=='homepage')
        {
        return view('website.backend.admin.website_setup.pages.homepage',compact('homepage_banner'));
        }
    }
    

public function homepage_banner(Request $request)
    {
        $homepage_banner=WebsiteSetting::where('type','Homepage_banner')->first();
        $form = array();
        $form2=array();
        for ($i=0; $i < count($request->link); $i++) {
            if(isset($request->file('banner')[$i]))
         {
                $name = time().hexdec(uniqid()).'.'.$request->file('banner')[$i]->getClientOriginalName();
                $request->file('banner')[$i]->move(public_path().'/website/backend/images/', $name); 
               $item['banner'] = $name;  
               $item['link'] = $request->link[$i];
               array_push($form, $item);
         }
        }
        if(is_countable($request->exist_link)) {
        for ($j=0; $j < count($request->exist_link); $j++) {
         if(isset($request->exist_banner[$i]))
         {
          $item['old_banner'] = $request->exist_banner[$j];  
          $item['old_link'] = $request->exist_link[$j];
         }
            array_push($form2, $item);
        }
        }
        $homepage_banner->value = json_encode($form);
        $homepage_banner->old_value = json_encode($form2);
        $homepage_banner->save();
        $message=toastr_message()['updated'];
        $notification=toastr_notification($message,'success');
        return Redirect()->back()->with($notification);
    }


    public function homepage_banner_delete(Request $request)
    {
        $homepage_banner=WebsiteSetting::where('type','homepage_banner')->first();
       $new_banners=json_decode($homepage_banner->value);
       $old_banners=json_decode($homepage_banner->old_value);
       $form=array();
       $form2=array();
       if($new_banners)
       {
        foreach($new_banners as $key=>$row)
        {
              if($row->banner==$request->value)
            {
                unlink(public_path('website/backend/images/'). $request->value);
                unset($new_banners[$key]);
                $item['banner']='';
                
            }
            else
            {
                $item['banner']=$row->banner;
                $item['link']=$row->link;
            }
            if($item['banner']!='' && $item['link']!='')
            {
                array_push($form,$item);
            }
        }
        $homepage_banner->value=json_encode($form);
       }
       if($old_banners)
       {
        foreach($old_banners as $key=>$row)
        {
              if($row->old_banner==$request->value)
            {
                unlink(public_path('website/backend/images/'). $request->value);
                unset($old_banners[$key]);
                $old_item['old_banner']='';
                
            }
            else
            {
                $old_item['old_banner']=$row->old_banner;
                $old_item['old_link']=$row->old_link;
            }
            if($old_item['old_banner']!='' && $old_item['old_link']!='')
            {
                array_push($form2,$old_item);
            }
        }
        $homepage_banner->old_value=json_encode($form2);
       }
       $homepage_banner->save();
    }