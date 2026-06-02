@extends('layouts.header')
@section('content')
<h3>Complete Your Booking</h3>

<p><strong>Car Type:</strong> {{ request('type') }}</p>
<p><strong>Category:</strong> {{ request('category') }}</p>
<p><strong>Price:</strong> ₦{{ number_format(request('price')) }}</p>

<form method="POST" action="{{ route('booking.store') }}">
    @csrf

    <input type="hidden" name="type" value="{{ request('type') }}">
    <input type="hidden" name="category" value="{{ request('category') }}">
    <input type="hidden" name="price" value="{{ request('price') }}">

    <input type="text" name="full_name" class="form-control mb-2" placeholder="Full Name">
    <input type="text" name="pickup" class="form-control mb-2" placeholder="Pickup Location">
    <input type="text" name="dropoff" class="form-control mb-2" placeholder="Dropoff Location">

    <button class="btn btn-main">Confirm Booking</button>
</form>             
@endsection
     <!-- jQery -->

     <script type="text/javascript" src="assets/js/jquery-3.4.1.min.js"></script>
<!-- bootstrap js -->
<script type="text/javascript" src="assets/js/bootstrap.js"></script>