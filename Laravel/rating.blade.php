<div class="form-group">
	<label for="email">Please Give rating</label><br>
	<div class="star-rating">
		<span class="fa fa-star-o" data-rating="1"></span>
		<span class="fa fa-star-o" data-rating="2"></span>
		<span class="fa fa-star-o" data-rating="3"></span>
		<span class="fa fa-star-o" data-rating="4"></span>
		<span class="fa fa-star-o" data-rating="5"></span>
		<input type="hidden" name="whatever1" class="rating-value" value="1">
	</div>
</div>
<div class="aa-product-rating">
	@php
	$total=5;
	$rating=$row->rating;
	$result=$total - $rating;
	@endphp
	@for($i=0;$i < $rating ;$i++)
	<span class="fa fa-star"></span>
	@endfor
	@if($result > 0)
	@for($i=0;$i < $result;$i++)
	<span class="fa fa-star-o"></span>
	@endfor
	@endif
</div>
<script>
var $star_rating = $('.star-rating .fa');
var SetRatingStar = function() {
return $star_rating.each(function() {
if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
return $(this).removeClass('fa-star-o').addClass('fa-star');
} else {
return $(this).removeClass('fa-star').addClass('fa-star-o');
}
});
};
$star_rating.on('click', function() {
$star_rating.siblings('input.rating-value').val($(this).data('rating'));
return SetRatingStar();
});
SetRatingStar();
$(document).ready(function() {
});
</script>