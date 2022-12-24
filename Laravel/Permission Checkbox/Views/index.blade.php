@extends('dashboard.app')
@section('content')
@if(superadmin())
<a href="{{route('membership.create')}}" class="btn btn-primary mbot10">Add Membership Plan</a>
@endif
<!--<button type="button" class="btn btn-primary mbot10" data-toggle="modal" data-target="#membership_popup">Add Membership Plan</button>-->
<!-- Button trigger modal -->
<table id="myTable">
  <thead>
    <tr>
      <th>Id</th>
      <th>Membership Name</th>
      <th>Membership Price</th>
      <th>Discount</th>
      <th>Tax</th>
      <th>Total</th>
      <th>Duration</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
      @foreach($data as $key=>$row)
      <tr>
          <td>{{$key+1}}</td>
          <td>{{$row->name}}</td>
          <td>{{currency()}}{{currencyConversion($row->price_per_month)}}</td>
          <td>{{currency()}}{{currencyConversion($row->discount_yearly_payment)}}</td>
          @php
          $tax=($row->price_per_month - $row->discount_yearly_payment) * $row->tax / 100
          @endphp
          <td>{{currency()}}{{currencyConversion($tax)}}</td>
          <td>{{currency()}}{{currencyConversion(($row->price_per_month - $row->discount_yearly_payment) + $tax)}}</td>
          <td>{{$row->days}} days</td>
          @if(superadmin())
          <td><a href="{{route('membership.edit',[$row->id])}}" class="btn btn-success">Edit</a>|<a onclick="return confirm('Are you sure?')" href="{{route('membership.delete',[$row->id])}}" class="btn btn-danger">Delete</a></td>
          @endif
          @if(isSubscription() && today_date() < user_membership_plan() && Auth::user()->subscription==$row->id)
          <td><a href="#" class="btn btn-success">Already Subscribed</a> | <a href="{{route('view.functionality',[$row->id])}}" class="btn btn-primary">View Details</a></td>
         @elseif(!superadmin())
        <td><a href="{{route('stripe',[$row->id])}}" class="btn btn-info">Subscribe</a> | <a href="{{route('view.functionality',[$row->id])}}" class="btn btn-primary">View Details</a></td>
          @endif
      </tr>
      @endforeach
  </tbody>
  <tfoot>
  </tfoot>
</table>
@endsection