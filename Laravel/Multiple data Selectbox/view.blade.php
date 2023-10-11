<select class="selectpicker" multiple name="categories">
    <option>Mustard</option>
    <option>Ketchup</option>
    <option>Relish</option>
</select>

<div class="col-md-8">

    <select class="selectpicker form-control" name="categories[]" data-live-search="true" multiple required>

	@foreach ($categories as $category)

	@php

	$json_data=json_decode($product->categories);

	@endphp

	<option value="{{ $category->id }}" @if(isset($product->categories)) @foreach($json_data as $json) @if($json==$category->id)selected @endif @endforeach @endif> {{ $category->getTranslation('name') }}</option>
	 @endforeach

	</select>

	<select class="form-control select2" multiple="multiple" style="width: 100%;" name="sub_category[]">
        <option value="" disabled>Select Sub Sports Category</option>
        @php
        $ids=json_decode($athlete->sub_sport_category,true);
        $categories=json_decode($athlete->sport_category);
        @endphp
        @foreach(App\Models\SubSportCategory::whereIn('sport_category_id',$categories)->where('status',1)->get() as $key=>$cat)
        <option value="{{$cat->id}}" @if(isset($athlete->sub_sport_category)) @foreach($ids as $json) @if($json==$cat->id)selected @endif @endforeach @endif>{{$cat->name}}</option>
        @endforeach
    </select>

</div>



@php
$cat_id=json_decode($detailedProduct->categories,true);
@endphp
@foreach (\App\Models\Product::whereJsonContains('categories',$cat_id)->where('id', '!=', $detailedProduct->id)->where('published',1)->orderBy('id','desc')->get() as $key => $related_product)
@endforeach


@foreach (\App\Models\Product::whereJsonContains('categories',$category_id)->orderBy('id','desc')->get() as $key => $product)
@endforeach