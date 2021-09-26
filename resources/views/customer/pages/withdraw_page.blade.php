@extends('customer.dashboard')
@section('maincontent')

<section class="ps-new-item">
    @if($form_name =='mobile_banking')
    <form class="ps-form ps-form--new-product" action="{{ route('withdraw_compelete') }}" method="post"  enctype="multipart/form-data">
      @csrf
        <div class="ps-form__content">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <figure class="ps-block--form-box">
                        <figcaption>{{ $form_name }}</figcaption>
                        <div class="ps-block__content">
                            <div class="form-group row">
                    
                                <select   class="form-control col-8" required  name="payment_type" >
                                  <option >Nagad</option>
                                  <option >Bkash</option>
                                  <option >Rocket</option>
                                  <option >Gpay</option>
                                  <option >Payon</option>
        
                                </select>
                              </div>
                            
                              <div class="form-group">
                                <label>Account Name<sup>*</sup>
                                </label>
                                <input class="form-control" type="hidden" required name= "payment_method"  value="{{ $form_name }}"  />

                                <input class="form-control" type="text" required name="account_name" placeholder="Enter ..." />
                            </div>
                            <div class="form-group">
                                <label>Account <sup>*</sup>
                                </label>
                                <input class="form-control" type="text" required name="account" placeholder="Enter ..." />
                            </div>
                              <div class="form-group">
                                <label>Withdraw Amount<sup>{{ Auth::user()->currency }}</sup>
                                </label>
                                <input class="form-control"required name="amount" min="{{ $min_price }}" max="{{ Auth::user()->balance }}" type="number" placeholder="min amount {{ $min_price }} " />
                            </div>
                        </div>
                    </figure>
                </div>
              
            </div>
        </div>
        <div class="ps-form__bottodm" style="text-align:center;"><a class="ps-btn ps-btn--black" href="">Back</a>
            <button class="ps-btn ps-btn--gray" type="reset">Cancel</button>
            <button class="ps-btn">Submit</button>
        </div>
    </form>
    @elseif($form_name =='bank')
    <form class="ps-form ps-form--new-product" action="{{ route('withdraw_compelete') }}" method="post"  enctype="multipart/form-data">
        @csrf
          <div class="ps-form__content">
              <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                      <figure class="ps-block--form-box">
                          <figcaption>{{ $form_name }}</figcaption>
                          <div class="ps-block__content">
                              <div class="form-group row">
                      
                                  <select   class="form-control col-8" required  name="payment_type" >
                                    <option >Jamuna Bank Ltd</option>
                                    <option >Islami Bank</option>
                                    <option >Duch Bangla Bank</option>
                                    <option >Brack Bank</option>
                                    <option >Mutual Bangla Bank</option>
                                    <option >Eastern Bank</option>
                                    <option >Merkentile Bank</option>
                                  </select>
                                </div>
                              
                                <div class="form-group">
                                  <label>Account Name<sup>*</sup>
                                  </label>
                                  <input class="form-control" type="hidden" required name= "payment_method"  value="{{ $form_name }}"  />
  
                                  <input class="form-control" type="text" required name="account_name" placeholder="Enter ..." />
                              </div>
                              <div class="form-group">
                                  <label>Account <sup>*</sup>
                                  </label>
                                  <input class="form-control" type="text" required name="account" placeholder="Enter ..." />
                              </div>
                                <div class="form-group">
                                  <label>Withdraw Amount<sup>{{ Auth::user()->currency }}</sup>
                                  </label>
                                  <input class="form-control"required name="amount" min="{{ $min_price }}" max="{{ Auth::user()->balance }}" type="number" placeholder="min amount {{ $min_price }}" />
                              </div>
                          </div>
                      </figure>
                  </div>
                
              </div>
          </div>
          <div class="ps-form__bottodm" style="text-align:center;"><a class="ps-btn ps-btn--black" href="">Back</a>
              <button class="ps-btn ps-btn--gray" type="reset">Cancel</button>
              <button class="ps-btn">Submit</button>
          </div>
      </form>
    @elseif($form_name =='online_money_transfer')
    <form class="ps-form ps-form--new-product" action="{{ route('withdraw_compelete') }}" method="post"  enctype="multipart/form-data">
        @csrf
          <div class="ps-form__content">
              <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                      <figure class="ps-block--form-box">
                          <figcaption>{{ $form_name }}</figcaption>
                          <div class="ps-block__content">
                              <div class="form-group row">
                      
                                  <select   class="form-control col-8" required  name="payment_type" >
                                    <option >Paypal</option>
                                    <option >Skill</option>
                                    <option >Payoneer</option>
                                    <option >Neteller</option>
                                    <option >Webmoney</option>
          
                                  </select>
                                </div>
                              
                                <div class="form-group">
                                  <label>Account Name<sup>*</sup>
                                  </label>
                                  <input class="form-control" type="hidden" required name= "payment_method"  value="{{ $form_name }}"  />
  
                                  <input class="form-control" type="text" required name="account_name" placeholder="Enter ..." />
                              </div>
                              <div class="form-group">
                                  <label>Account <sup>*</sup>
                                  </label>
                                  <input class="form-control" type="text" required name="account" placeholder="Enter ..." />
                              </div>
                                <div class="form-group">
                                  <label>Withdraw Amount<sup>{{ Auth::user()->currency }}</sup>
                                  </label>
                                  <input class="form-control" required name="amount" type="number" min="{{ $min_price }}" max="{{ Auth::user()->balance }}" placeholder="min amount {{ $min_price }}" />
                              </div>
                          </div>
                      </figure>
                  </div>
                
              </div>
          </div>
          <div class="ps-form__bottodm" style="text-align:center;"><a class="ps-btn ps-btn--black" href="">Back</a>
              <button class="ps-btn ps-btn--gray" type="reset">Cancel</button>


              <button class="ps-btn">Submit</button>

          </div>
      </form>
    @endif

</section>




    @endsection