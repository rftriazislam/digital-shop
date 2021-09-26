@extends('frontend.home.master')

@section('maincontent')

<div class="ps-page--my-account">
    <div class="ps-breadcrumb">
      <div class="container">
        <ul class="breadcrumb">
          <li><a href="index.html">Home</a></li>
          <li>My account</li>
        </ul>
      </div>
    </div>
    <div class="ps-my-account-2">
      <div class="container">
        <div class="ps-section__wrapper">
          <div class="ps-section__left">
            <div class="ps-form--account ps-tab-rsoot" >
              <div class="ps-tab-list">


               
                <div style="width:100%;max-width:100%;margin-right:0;padding:20px 15px;"><a href="" style="font-size:24px;line-height:1em;color:#666;font-weight:600;">Make you Password</a></div>
            

              </div>
         
            
              <div class="ps-tabs">
          

              
                <form method="POST" action="{{ route('updatepassword') }}">
                    @csrf


                
                  <div class="ps-form__content">
                    <h5>Register An Account</h5>
                   
               
                   
                
                    <div class="form-group">
                      <input id="email" class="form-control @error('email') is-invalid @enderror" name="email" value=""  autocomplete="email" required  type="hidden" placeholder="Email">
                     
                      <input id="token" class="form-control @error('token') is-invalid @enderror" name="token" value="{{ $token}}" required   type="hidden" >
                    
                      @error('token')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                 
                
                  
                    <div class="form-group">
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                   
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                    </div>
                    <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="confirm Password">
                      </div>
                   
                    <div class="form-group submit">
                      <button class="ps-btn ps-btn--fullwidth">Change</button>
                    </div>
                  </div>
                </form>
               
                <script language="javascript">

                
                </script>
              </div>
            </div>
          </div>
          <div class="ps-section__right">
            <figure class="ps-section__desc">
              <figcaption>Sign up today and you will be able to:</figcaption>
              <p>MartFury Buyer Protection has you covered from click to delivery. Sign up or sign in and you will be able to:</p>
              <ul class="ps-list">
                <li><i class="icon-credit-card"></i><span>SPEED YOUR WAY THROUGH CHECKOUT</span></li>
                <li><i class="icon-clipboard-check"></i><span>TRACK YOUR ORDERS EASILY</span></li>
                <li><i class="icon-bag2"></i><span>KEEP A RECORD OF ALL YOUR PURCHASES</span></li>
              </ul>
            </figure>
            <div class="ps-section__coupon"><span>$25</span>
              <aside>
                <h5>A small gift for your first purchase</h5>
                <p>Martfury give $25 as a small gift for your first purchase. Welcome to Martfury!</p>
              </aside>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ps-newsletter">
    <div class="container">
      <form class="ps-form--newsletter" action="do_action" method="post">
        <div class="row">
                      <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <div class="ps-form__left">
                          <h3>Newsletter</h3>
                          <p>Subcribe to get information about products and coupons</p>
                        </div>
                      </div>
                      <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <div class="ps-form__right">
                          <div class="form-group--nest">
                            <input class="form-control" type="email" placeholder="Email address">
                            <button class="ps-btn">Subscribe</button>
                          </div>
                        </div>
                      </div>
        </div>
      </form>
    </div>
  </div>
@endsection
