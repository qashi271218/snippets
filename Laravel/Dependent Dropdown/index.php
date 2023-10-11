@extends('frontend.layouts.app')
@section('content')
<section class="details_page">
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-md-6">        
        <div class="shadow-lg p-5 mb-5 bg-white rounded">
          <h3 class="font-weight-700">ADD PAYMENT CARD</h3>
          <p class="font-size-15px mb-30">The address you provide must match that of the card.</p>

           <form method="post" action="{{route('user.card')}}">
           {{csrf_field()}}
           <div class="form-group">
              <label for="email1">Credit or Debit Card</label>
              <div class="relative"><input type="number" name="card_number" class="form-control card-control" required>
              </div>                    
            </div>

            <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                <label for="email1">Expiry Year</label>
                <input type="number" class="form-control" name="year" required>        
              </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
              <label for="email1">Expiry Month</label>
              <input type="number" class="form-control" name="month" required>        
            </div>
              </div>
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
              <label for="email1">CVV</label>
              <input type="number" class="form-control" name="cvv" required>        
            </div>
              </div>
            </div>
            <div class="form-group">
              <label for="email1">Phone Number</label>
              <input type="number" class="form-control" name="phone_number" required>        
            </div>

           <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                <label for="email1">Billing Address 1</label>
                <input type="text" class="form-control" name="billing_address" required>        
              </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
              <label for="email1">Address 2</label>
              <input type="text" class="form-control" name="address2">        
            </div>
              </div>
            </div>
             @php
             $countries=\App\Country::where('status',1)->get();
             $states=\App\State::where('country_id',231)->get();
             $cities=DB::table('cities')->where('country_id',231)->get();
             @endphp
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                <label for="email1">Country</label>
                <div class="custom-select2">
                <select id="styledSelect1" name="country" required>
                    <option value="" selected disabled>Select Country</option>
                    @foreach($countries as $country)
                  <option value="{{$country->id}}" data-states="{{json_encode($country->getStates)}}" data-cities="{{json_encode($country->getCities)}}">{{$country->title}}</option> 
                  @endforeach
                </select>
                </div>
              </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                <label for="email1">State</label>
                <div class="custom-select2">
                <select name="state" required>
                </select>
                </div>
              </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                <label for="email1">Postcode/Zipcode</label>
                <input type="number" class="form-control" name="zip_code" required>        
              </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                <label for="email1">City</label>
                <div class="custom-select2">
                <select name="city" required>
                </select>
                </div>
              </div>
              </div>
            </div>

            <p class="font-size-15px mt-10">I authorise The Boat Auction Group to send instructions to the financial institution that issued my card to take payments from my card account in accordance with the <a href="{{url('terms-conditions')}}"> Terms and Conditions</a>.</p>

              <button type="submit" class="btn mainBtn2 mt-10 text-uppercase font-weight-700">ADD CARD</button>


          </form>

       

        </div>
    </div>
    <div class="space30"></div>
   
  </div>
</div>
</section>
@endsection
@section('script')
<script>
    $(document).ready(function(){
      $('select[name=country]').on('change',function() {
        $('select[name=state]').html('<option value="" selected="" disabled="">@lang('Select One')</option>');
        var states = $('select[name=country] :selected').data('states');
        var html = '';
        states.forEach(function myFunction(item, index) {
            html += `<option value="${item.id}">${item.state}</option>`
        });
        $('select[name=state]').append(html);
        $('select[name=city]').html('<option value="" selected="" disabled="">@lang('Select One')</option>');
        var cities = $('select[name=country] :selected').data('cities');
        var html = '';
        cities.forEach(function myFunction(item, index) {
            html += `<option value="${item.id}">${item.city}</option>`
        });
        $('select[name=city]').append(html);
    });  
    });
</script>
@endsection