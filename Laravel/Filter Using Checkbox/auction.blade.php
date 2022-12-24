<section class="auction-area">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="ourHolder">
						<div class="item allitems"> 
						@if(count($filter_records) > 0)
						<div class="row"> @foreach ($filter_records as $key=>$auction) @if(isset($auction->live_auction_start_time)) @php $time = explode(":", $auction->live_auction_start_time); @endphp @endif @component('components.bidding_item',['image'=>getAuctionImage($auction->image,'auction'),'id'=>$auction->id,'hour'=>$time[0],'minute'=>$time[1],'second'=>$time[2],'currency'=>$currency_code,'price'=>$auction->reserve_price,'bidcount'=>$auction->getAuctionBiddersCount(),'title'=>$auction->title,'description'=>$auction->description,'slug'=>$auction->slug]) @endcomponent @endforeach 
						@elseif(!Request::is('/') && count($filter_records) < 1)
						<h3>No Result Found</h3>
						@else
						<div class="row"> @foreach ($all_records as $key=>$auction) @if(isset($auction->live_auction_start_time)) @php $time = explode(":", $auction->live_auction_start_time); @endphp @endif @component('components.bidding_item',['image'=>getAuctionImage($auction->image,'auction'),'id'=>$auction->id,'hour'=>$time[0],'minute'=>$time[1],'second'=>$time[2],'currency'=>$currency_code,'price'=>$auction->reserve_price,'bidcount'=>$auction->getAuctionBiddersCount(),'title'=>$auction->title,'description'=>$auction->description,'slug'=>$auction->slug]) @endcomponent @endforeach 
						@endif 
						</div>
						</div>
						<div class="item bestoffer" style="display:none;"> @if (count($buynow_records))
							<div class="row"> @foreach ($buynow_records as $auction) @if(isset($auction->live_auction_start_time)) @php $time = explode(":", $auction->live_auction_start_time); @endphp @endif @component('components.bidding_item',['image'=>getAuctionImage($auction->image,'auction'),'id'=>$auction->id,'hour'=>$time[0],'minute'=>$time[1],'second'=>$time[2],'currency'=>$currency_code,'price'=>$auction->reserve_price,'bidcount'=>$auction->getAuctionBiddersCount(),'title'=>$auction->title,'description'=>$auction->description,'slug'=>$auction->slug]) @endcomponent @endforeach </div> @endif </div>
						<div class="item comingsoon" style="display:none;"> @if (count($new_records))
							<div class="row"> @foreach ($new_records as $auction) @if(isset($auction->live_auction_start_time)) @php $time = explode(":", $auction->live_auction_start_time); @endphp @endif @component('components.bidding_item',['image'=>getAuctionImage($auction->image,'auction'),'id'=>$auction->id,'hour'=>$time[0],'minute'=>$time[1],'second'=>$time[2],'currency'=>$currency_code,'price'=>$auction->reserve_price,'bidcount'=>$auction->getAuctionBiddersCount(),'title'=>$auction->title,'description'=>$auction->description,'slug'=>$auction->slug]) @endcomponent @endforeach </div> @endif </div>
						<div class="item sold" style="display:none;"> @if (count($past_records))
							<div class="row"> @foreach ($past_records as $auction) @if(isset($auction->live_auction_start_time)) @php $time = explode(":", $auction->live_auction_start_time); @endphp @endif @component('components.bidding_item',['image'=>getAuctionImage($auction->image,'auction'),'id'=>$auction->id,'hour'=>$time[0],'minute'=>$time[1],'second'=>$time[2],'currency'=>$currency_code,'price'=>$auction->reserve_price,'bidcount'=>$auction->getAuctionBiddersCount(),'title'=>$auction->title,'description'=>$auction->description,'slug'=>$auction->slug]) @endcomponent @endforeach </div>@endif </div>
						<div class="item buynow" style="display:none;"> @if (count($featured_records))
							<div class="row"> @foreach ($featured_records as $auction) @if(isset($auction->live_auction_start_time)) @php $time = explode(":", $auction->live_auction_start_time); @endphp @endif @component('components.bidding_item',['image'=>getAuctionImage($auction->image,'auction'),'id'=>$auction->id,'hour'=>$time[0],'minute'=>$time[1],'second'=>$time[2],'currency'=>$currency_code,'price'=>$auction->reserve_price,'bidcount'=>$auction->getAuctionBiddersCount(),'title'=>$auction->title,'description'=>$auction->description,'slug'=>$auction->slug]) @endcomponent @endforeach </div> @endif </div>
					</div>
				</div>
			</div>
		</div>
	</section>