@extends('frontend.home.master')
@section('maincontent')
<main class="ps-page--my-account">
    <div class="ps-breadcrumb">
      <div class="container">
        <ul class="breadcrumb">
          <li><a href="index.html">Home</a></li>
          <li>Payment Issue</li>
        </ul>
      </div>
    </div>
    <section class="ps-section--account">
      <div class="container">
        <div class="ps-block--payment-success">

@if($message=='success')
          <h3>Payment Success !</h3>
          <p>Thanks for your payment. Please visit<a > here</a> to check your order status.</p>

    
@else

<h3>Payment fail</h3>
<p>Try again</p>

@endif



        </div>
      </div>
    </section>  
  </main>
@endsection