public function homepage(Request $request)
    {
        if($request->type=='homepage_banner')
        {
        $homepage_banner=WebsiteSetting::where('type','homepage_banner')->first();
        $form=array();
        $form2=array();
        for ($i=0; $i < count($request->banner); $i++) {
              if(isset($request->file('banner')[$i]))
         {
                $name = time().hexdec(uniqid()).'.'.$request->file('banner')[$i]->getClientOriginalName();
                $request->file('banner')[$i]->move(public_path().'/website/backend/images/', $name); 
                $item['banner'] = $name;  
                $item['link'] = $request->link[$i];
                array_push($form, $item);
         }
        }
         if(isset($request->old_banner))
         {
             for ($i=0; $i < count($request->old_banner); $i++) {
           $old_item['old_banner'] = $request->old_banner[$i];  
              $old_item['old_link'] = $request->old_link[$i]; 
              array_push($form2, $old_item);
             }
        }
        $homepage_banner->value = json_encode($form);
        $homepage_banner->old_value = json_encode($form2);
        $homepage_banner->save();
        }
        elseif($request->type=='homepage_services')
        {
         $homepage_services=WebsiteSetting::where('type','homepage_services')->first();
        $form = array();
        $form2=array();
        for ($i=0; $i < count($request->service_text); $i++) {
            if(isset($request->file('service_banner')[$i]))
         {
                $name = time().hexdec(uniqid()).'.'.$request->file('service_banner')[$i]->getClientOriginalName();
                $request->file('service_banner')[$i]->move(public_path().'/website/backend/images/', $name); 
               $item['service_banner'] = $name;  
               $item['service_text'] = $request->service_text[$i];
               array_push($form, $item);
         }
        }
        if(is_countable($request->exist_text)) {
        for ($j=0; $j < count($request->exist_text); $j++) {
         if(isset($request->exist_service_banner[$j]))
         {
        $item['old_service_banner'] = $request->exist_service_banner[$j];  
        $item['old_service_text'] = $request->exist_text[$j];
        array_push($form2, $item);
         }
        }
        }
        $homepage_services->value = json_encode($form);
        $homepage_services->old_value = json_encode($form2);
        $homepage_services->save();   
        }
        
        elseif($request->type=='homepage_latest_news')
        {
         $homepage_latest_news=WebsiteSetting::where('type','homepage_latest_news')->first();
        $form = array();
        $form2=array();
        for ($i=0; $i < count($request->latest_news_text); $i++) {
            if(isset($request->file('latest_news_image')[$i]))
         {
                $name = time().hexdec(uniqid()).'.'.$request->file('latest_news_image')[$i]->getClientOriginalName();
                $request->file('latest_news_image')[$i]->move(public_path().'/website/backend/images/', $name); 
               $item['latest_news_image'] = $name;  
               $item['latest_news_text'] = $request->latest_news_text[$i];
               array_push($form, $item);
         }
        }
        if(is_countable($request->exist_latest_news_text)) {
        for ($j=0; $j < count($request->exist_latest_news_text); $j++) {
         if(isset($request->exist_latest_news_image[$j]))
         {
        $item['old_latest_news_image'] = $request->exist_latest_news_image[$j];  
        $item['old_latest_news_text'] = $request->exist_latest_news_text[$j];
        array_push($form2, $item);
         }
        }
        }
        $homepage_latest_news->value = json_encode($form);
        $homepage_latest_news->old_value = json_encode($form2);
        $homepage_latest_news->save();   
        }
        $message=toastr_message()['updated'];
        $notification=toastr_notification($message,'success');
        return Redirect()->back()->with($notification);
    }
    
    public function homepage_functionality_delete(Request $request,$name)
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
              if($row->banner==$name)
            {
                unlink(public_path('website/backend/images/'). $name);
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
              if($row->old_banner==$name)
            {
                unlink(public_path('website/backend/images/'). $name);
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
        $message=toastr_message()['deleted'];
        $notification=toastr_notification($message,'success');
        return Redirect()->back()->with($notification);
    }