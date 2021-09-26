@extends('frontend.home.master')
@section('maincontent')
<main class="ps-page--my-account">
    <div class="ps-breadcrumb">
      <div class="container">
        <ul class="breadcrumb">
          <li><a href="index.html">Home</a></li>
          <li><a href="user-information.html">Account</a></li>
          <li>Payment</li>
        </ul>
      </div>
    </div>
    <section class="ps-section--account ps-checkout">
      <div class="container">
        <div class="ps-section__header">
          <h3>Payment</h3>
        </div>
        <div class="ps-section__content">
          <div class="ps-form--checkout" >
            <div class="ps-form__content">
              <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 ">
                              <div class="ps-block--shipping">
                               
                                <h4>Shipping method</h4>
                                <div class="ps-block__panel">
                                  <figure><small>Total Amount</small><strong>{{ $price }} {{ Auth::user()->currency }}</strong></figure>
                                </div>
                                <h4>Payment Methods</h4>
                                <div class="ps-block--payment-method" style="background-color: white">
                                  <ul class="ps-tab-list">
                                   
                                  </ul>
                                  <div class="ps-tabs">
                                    <div class="ps-tab active" id="visa">

                                      <form class="ps-form--visa" action="{{ route('paymentcomplete') }}" method="post">
                                       @csrf
                                        <div class="form-group">
                                         

                                          <input class="form-control" name="product_id" type="hidden" value="{{ $data->id }}" placeholder="">
                                          <input class="form-control"  name="form_name" type="hidden" value="{{ $form_name }}" placeholder="">
                                          <input class="form-control" name="qty" type="hidden" value="{{ $qty }}" placeholder="">

                                          <input class="form-control" name="status" type="hidden" value="{{$data->status }}" placeholder="">
                                          <input class="form-control" name="seller_id" type="hidden" value="{{$data->post_id }}" placeholder="">
                                          <input class="form-control" name="affiliate_id" type="hidden" value="{{$affilate}}" placeholder="">


                                          @if($form_name=='social_media')
                                          <input class="form-control" name="price" type="hidden" value="{{ $price }}" placeholder="">
                                          <input class="form-control" name="product_name" type="hidden" value="{{ $data->social_name }}" placeholder="">
                                          @elseif($form_name=='make_payment')

                                          <input class="form-control" name="price" type="hidden" value="{{ $price }}" placeholder="">

                                          <input class="form-control" name="product_name" type="hidden" value="{{ $data->send_wallet }}" placeholder="">

                                          @elseif($form_name=='influence_marketing')
                                          
                                          <input class="form-control" name="price" type="hidden" value="{{$price}}" placeholder="">
                                          <input class="form-control" name="product_name" type="hidden" value="{{ $data->social_name }}" placeholder="">
                                          @elseif($form_name=='gift_card')
                                          
                                          <input class="form-control" name="price" type="hidden" value="{{ $price }}" placeholder="">
                                          <input class="form-control" name="product_name" type="hidden" value="{{ $data->name }}" placeholder="">

                                          @elseif($form_name=='subscription')
                                          
                                          <input class="form-control" name="price" type="hidden" value="{{ $price }}" placeholder="">
                                          <input class="form-control" name="product_name" type="hidden" value="{{ $data->name }}" placeholder="">
                                          @elseif($form_name=='advertisement_account')
                                          
                                          <input class="form-control" name="price" type="hidden" value="{{ $price }}" placeholder="">
                                          <input class="form-control" name="product_name" type="hidden" value="{{ $data->account_name }}" placeholder="">
                                          
                                          @elseif($form_name=='digital_wallet')
                                          
                                          <input class="form-control" name="price" type="hidden" value="{{ $price}}" placeholder="">
                                          <input class="form-control" name="product_name" type="hidden" value="{{ $data->account_name }}" placeholder="">

                                          @elseif($form_name=='social_media_promotion')
                                          
                                          <input class="form-control" name="price" type="hidden" value="{{$price }}" placeholder="">
                                          <input class="form-control" name="product_name" type="hidden" value="{{ $data->product_name }}" placeholder="">
                                          @elseif($form_name=='top_up_apps')
                                          
                                          <input class="form-control" name="price" type="hidden" value="{{ $price}}" placeholder="">
                                          <input class="form-control" name="product_name" type="hidden" value="{{ $data->product_name }}" placeholder="">
                                          @elseif($form_name=='games_zone')
                                          
                                          <input class="form-control" name="price" type="hidden" value="{{ $price}}" placeholder="">
                                          <input class="form-control" name="product_name" type="hidden" value="{{ $data->product_name }}" placeholder="">

                                          
                                          
                                          @endif
                                        </div>
                                        
                                        <div class="row">
                                          
                                        </div>
                                          <div class="form-group submit ">
                                            <button class="ps-btn ps-btn--fullwidth" type="submit">Payment</button>
                                          </div>

                                    
                                        <img src="{{ asset('front_end/logo/shurjo.png') }}"  style="height:100%;width:50%;float:left" alt="sdsjd"> 
                                      
                                       
                                        <img src="{{ asset('front_end/logo/paypal.png') }}" style="height:100%;width:50%;float:left" alt="sdsjd">
                                  
                                       

                                    </div>
                                  
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ">
                              <div class="ps-block--checkout-order">
                                <div class="ps-block__content">
                                  <figure>
                                    <figcaption><strong>Product</strong><strong>Total</strong></figcaption>
                                  </figure>
              <figure>
  <figcaption><strong>Category</strong><strong style="color:orangered"> {{ $data->category_info->name  }}</strong></figcaption>
  </figure>
  <figure>
    <figcaption><strong>SubCategory</strong><strong style="color:rgb(145, 58, 226)">{{  $data->subcategory_info->name }}</strong></figcaption>
    </figure>               
     
@if($form_name=='social_media')



<figure>
  <figcaption><strong>{{ $data->social_name }}</strong><strong style="color:red">{{ $price  }} {{ Auth::user()->currency }}</strong></figcaption>
  </figure>
  <figure>
    <figcaption><strong>Quantity </strong><strong style="color:red">{{ $qty  }}</strong></figcaption>
    </figure>
<figure class="ps-block__total">
<h3>Total<strong> {{ $price }} {{ Auth::user()->currency }}</strong></h3>
</figure>

@elseif($form_name=='make_payment')

  <figure>
    <figcaption><strong>Get Amount</strong><strong> {{ $data->get_wallet }}</strong></figcaption>
    </figure>
    <figure>
      <figcaption><strong>send Amount</strong><strong> {{ $data->send_wallet }}</strong></figcaption>
      </figure>
      <figure>
        <figcaption><strong>Total send Amount</strong><strong> {{ $qty  }} {{ $data->send_currency }}</strong></figcaption>
        </figure>
  <figure class="ps-block__total">
  <h3>Total<strong>{{ $price  }} {{ Auth::user()->currency }}</strong></h3>
  </figure>

@elseif($form_name=='influence_marketing')




<figure>
  <figcaption><strong>{{ $data->social_name }}</strong><strong style="color:red">{{ $price  }} {{ Auth::user()->currency }}</strong></figcaption>
  </figure>
  <figure>
    <figcaption><strong>Quantity </strong><strong style="color:red">{{ $qty  }}</strong></figcaption>
    </figure>
<figure class="ps-block__total">
<h3>Total<strong> {{ $price }} {{ Auth::user()->currency }}</strong></h3>
</figure>
  @elseif($form_name=='gift_card')

  <figure>
    <figcaption><strong> {{ $data->name }}</strong></figcaption>
  </figure>


 
  <figure>
    <figcaption><strong>Quantity </strong><strong style="color:red">{{ $qty  }}</strong></figcaption>
    </figure>

  <figure class="ps-block__total">
    <h3>Total<strong> {{ $price }} {{ Auth::user()->currency }}</strong></h3>
    </figure>

  @elseif($form_name=='subscription')

  <figure>
    <figcaption><strong> {{ $data->name }}</strong></figcaption>
  </figure>

  <figure>
    <figcaption><strong>Quantity </strong><strong style="color:red">{{ $qty  }}</strong></figcaption>
    </figure>

  <figure class="ps-block__total">
    <h3>Total<strong> {{ $price }} {{ Auth::user()->currency }}</strong></h3>
    </figure>

  @elseif($form_name=='advertisement_account')

  <figure>
    <figcaption><strong>Account Name </strong><strong> {{ $data->account_name }}</strong></figcaption>
  </figure>
  
  
  <figure>
    <figcaption><strong>Quantity </strong><strong style="color:red">{{ $qty  }}</strong></figcaption>
    </figure>

  <figure class="ps-block__total">
    <h3>Total<strong> {{ $price }} {{ Auth::user()->currency }}</strong></h3>
    </figure>

  @elseif($form_name=='digital_wallet')

  <figure>
    <figcaption><strong>Account Name </strong><strong> {{ $data->account_name }}</strong></figcaption>
  </figure>
  
  <figure>
    <figcaption><strong>Quantity </strong><strong style="color:red">{{ $qty  }}</strong></figcaption>
    </figure>

  <figure class="ps-block__total">
    <h3>Total<strong> {{ $price }} {{ Auth::user()->currency }}</strong></h3>
    </figure>

  @elseif($form_name=='social_media_promotion')

  <figure>
    <figcaption><strong> {{ $data->product_name }}</strong></figcaption>
  </figure>
  
   
  <figure>
    <figcaption><strong>1 Package </strong><strong style="color:red">{{ $data->follower_subscriber  }} pice</strong></figcaption>
  </figure>

  <figure>
    <figcaption><strong>Quantity </strong><strong style="color:red">{{ $qty  }} package</strong></figcaption>
  </figure>

  <figure class="ps-block__total">
    <h3>Total<strong> {{ $price }} {{ Auth::user()->currency }}</strong></h3>
    </figure>


  @elseif($form_name=='games_zone')

  <figure>
    <figcaption><strong> {{ $data->product_name }}</strong></figcaption>
  </figure>
  
  <figure>
    <figcaption><strong>1 Package </strong><strong style="color:red">{{ $data->diamonds  }} pice</strong></figcaption>
  </figure>

  <figure>
    <figcaption><strong>Quantity </strong><strong style="color:red">{{ $qty  }} package</strong></figcaption>
  </figure>

  <figure class="ps-block__total">
    <h3>Total<strong> {{ $price }} {{ Auth::user()->currency }}</strong></h3>
    </figure>


  @elseif($form_name=='top_up_apps')

  <figure>
    <figcaption><strong> {{ $data->product_name }}</strong></figcaption>
  </figure>

  <figure>
    <figcaption><strong>1 Package </strong><strong style="color:red">{{ $data->top_up  }} pice</strong></figcaption>
  </figure>

  <figure>
    <figcaption><strong>Quantity </strong><strong style="color:red">{{ $qty  }} package</strong></figcaption>
  </figure>

  <figure class="ps-block__total">
    <h3>Total<strong> {{ $price }} {{ Auth::user()->currency }}</strong></h3>
    </figure>





@endif
                                </div>
                              </div>
                            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  
  </main>

@endsection