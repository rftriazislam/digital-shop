@extends('frontend.home.master')
@section('maincontent')

<section class="ps-section--account ps-checkout">
    <div class="container">
      <div class="ps-section__header">
        <h3>Checkout Information</h3>
      </div>
      <div class="ps-section__content">
        <form class="ps-form--checkout" action="{{ route('checkoutsave') }}" method="post">
          @csrf
          <div class="ps-form__billing-info">
            <h3 class="ps-form__heading">Contact Information</h3>
           
            <div class="form-group">
              <label>Full Name</label>
              <input class="form-control" type="text" name="user_name" required placeholder="">
           
          </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Email</label>
                  <input class="form-control"  required type="email" name="email" placeholder="">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Phone</label>
                  <input class="form-control" required type="text" name="phone" placeholder="">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Account Name</label>
                  <input class="form-control" required type="text" name="account_name" placeholder="">
                </div>
              </div>
              <div class="col-sm-6"> 
                <div class="form-group">
                  <label>Account No.</label>
                  <input class="form-control" required type="text" name="account_no" placeholder="">
                </div>
              </div>
            </div>

          
           
  
            <button class="ps-btn ps-btn--fullwidth"  style="width: 34%;float: right;color:white"type="submit">Payment</button>
          </div>
        </form>
      </div>
    </div>
  </section>
@endsection
