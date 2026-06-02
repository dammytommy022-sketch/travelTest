@extends('layouts.header')
@section('content')
  <section class=" m-5 d-flex justify-content-center align-items-center vh-10"> 
    <style>
      body {
        background-color: #f8f9fa;
      }
      .card {
        border-radius: 15px;
        overflow: hidden;
      }
      .main-color {
        color: rgba(13, 24, 131, 1);
      }
      .btn-main {
        background-color: rgba(13, 24, 131, 1);
        color: white;
        border: none;
        transition: 0.3s ease;
      }
      .btn-main:hover {
        background-color: rgba(9, 18, 100, 1);
        color: #fff;
      }
    </style>

    <div class="card shadow-lg text-center p-5" style="max-width: 500px;">
      <div class="mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="green" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 10.03a.75.75 0 0 0 1.08-.02l3.992-4.99a.75.75 0 1 0-1.14-.976L7.477 8.417 5.383 6.323a.75.75 0 0 0-1.06 1.06l2.647 2.647z"/>
        </svg>
      </div>

      <h3 class="main-color fw-bold">Successful!</h3>
      <h6>
        @if (session('success'))
          <div class="alert alert-success text-center" id="alert-message">{{ session('success') }}</div>
        @endif
      </h6>
      <p class="mt-2">Thank you for your payment. Your request has been received successfully.</p>

      {{-- ✅ Display payment reference 
      <div class="alert alert-info mt-3" role="alert">
        <strong>Payment Reference:</strong> {{ $reference }}
      </div>--}}

      <div class="mt-3">
        <a href="{{ route('carhire.index') }}" class="btn btn-main px-4 py-2 rounded-pill">Return back toForm</a>
      </div>
    </div>
  </section>             
@endsection
     <!-- jQery -->

     <script type="text/javascript" src="assets/js/jquery-3.4.1.min.js"></script>
<!-- bootstrap js -->
<script type="text/javascript" src="assets/js/bootstrap.js"></script>