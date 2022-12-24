@php
$filter_categories=App\Category::where('status','Active')->get();
$filter_subcategories=App\SubCatogory::where('status','Active')->get();
$filter_buy_now_price_auctions=App\Auction::select('buy_now_price')->distinct()->get();
$filter_status_auctions=App\Auction::select('auction_status')->distinct()->get();
@endphp

								<h3 class="font-size-15px font-weight-700 pb-10">CATEGORY</h3>
						    <form action="{{route('filter.auction')}}" method="GET">
								<ul>
								    @foreach($filter_categories as $row)
									<li>
										<div class="checkbox checkboxBold">
					
											<label class="less-left-0px">
												<input class="categoryType" type="checkbox" value="{{$row->id}}" name="category[]" id="category.{{$row->id}}" @if(in_array($row->id, $categoryId)) checked @endif> <span class="cr"><i class="cr-icon fa fa-check"></i></span> {{$row->category}}</label>
										</div>
									</li>
									@endforeach
								</ul>
								</form>
							</div>
							<div class="col-lg-3 col-sm-6 col-md-6 col-xs-6 ">
								<h3 class="font-size-15px font-weight-700 pb-10">SUBCATEGORY</h3>
								<form action="{{route('filter.auction')}}" method="GET">
								<ul>
								    @foreach($filter_subcategories as $row)
									<li>
										<div class="checkbox checkboxBold">
											<label class="less-left-0px">
												<input class="subcategoryType" type="checkbox" value="{{$row->id}}" name="subcategory[]" id="subcategory.{{$row->id}}" @if(in_array($row->id, $subcategoryId)) checked @endif> <span class="cr"><i class="cr-icon fa fa-check"></i></span> {{$row->sub_category}}</label>
										</div>
									</li>
									@endforeach
								</ul>
								</form>
							</div>
							<div class="col-lg-3 col-sm-6 col-md-6 col-xs-6 ">
								<h3 class="font-size-15px font-weight-700 pb-10">PRICE</h3>
								<form action="{{route('filter.auction')}}" method="GET">
								<ul>
								    @foreach($filter_buy_now_price_auctions as $row)
									<li>
										<div class="checkbox checkboxBold">
											<label class="less-left-0px">
											<input class="priceType" type="checkbox" value="{{$row->buy_now_price}}" name="price[]" id="price.{{$row->id}}" @if(in_array($row->buy_now_price, $priceId)) checked @endif> <span class="cr"><i class="cr-icon fa fa-check"></i></span> {{$row->buy_now_price}}</label>
										</div>
									</li>
									@endforeach
								</ul>
								</form>
							</div>
							<div class="col-lg-3 col-sm-6 col-md-6 col-xs-6 ">
								<h3 class="font-size-15px font-weight-700 pb-10">AUCTION STATUS</h3>
								<form action="{{route('filter.auction')}}" method="GET">
								<ul>
								    @foreach($filter_status_auctions as $row)
									<li>
										<div class="checkbox checkboxBold">
											<label class="less-left-0px">
										<input class="auctionType" type="checkbox" value="{{$row->auction_status}}" name="status[]" id="status.{{$row->id}}" @if(in_array($row->auction_status, $statusId)) checked @endif> <span class="cr"><i class="cr-icon fa fa-check"></i></span> {{$row->auction_status}}</label>
										</div>
									</li>
									@endforeach
								</ul>
								</form>
							</div>
						</div>
					</div>
				</form>