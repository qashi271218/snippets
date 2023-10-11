$collection['categories']=json_encode($collection['categories']);

//   $ids=json_decode($athlete->sport_category);
    //   dd(SubSportCategory::whereIn('sport_category_id',$ids)->where('status',1)->get());
    
$json_data=json_decode($data->category_id);
        $cat_Name="";
            foreach($json_data as $json){
                $category=Category::where('category_id',$json)->first();
                $cat=$category->name;
                if(empty($cat_Name)){
                    $cat_Name = $cat;
                }else{
                    $cat_Name .= ",".$cat;
                }
            }

        $finalUrl = $cat_Name;
        return [
            'book_id'=>$this->book_id,
            'category_id' => $finalUrl,