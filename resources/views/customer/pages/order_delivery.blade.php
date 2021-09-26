@extends('customer.dashboard')
@section('title')
    Unistag Digital || Delivery Confirm
@endsection
@section('maincontent')

<section class="ps-dashboard ps-items-listing">

    <div class="ps-section__left" style="max-width: 100%;    max-width: 100%;
    border: 1px solid #80bc00;
    border-style: ridge;
    padding: 40px 0px;
    margin:5px 10px">
    <section class="ps-card">

        <div class="ps-sidebar__center ">
            <img style="width: 150px;height: 150px; margin-bottom:20px;"
            class="center img-fluid" src="{{asset('back_end/img/user/admin.jpg')}}"
        alt="">
        </div>
            <div class="row">
                <div class="col-12">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class=" form-group">
                                    <span class="profile_text" ><b>Buyer Name : </b>{{ $buyer_info->name }}</span>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
    
                    <div class="col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b> Buyer Email : </b>{{ $buyer_info->email }}</span>
                        </div>
                    </div>
    
                    <div class=" col-sm-12">
                        <div class=" form-group">
                            <span class="profile_text" ><b> Buyer Phone : </b>{{ $buyer_info->phone }}</span>
                        </div>
                    </div>
    
                  
                </div>
               
                <div class="col-12">
                    
                    @if($form_name=='social_media')

                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Category name : </b>{{ $product_info->category_info->name }}</span>
                        </div>
                    </div>
    
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>SubCategory name :</b>{{ $product_info->subcategory_info->name }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product name :</b>{{ $sell_order->product_name }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product Qty :</b>{{ $sell_order->quantity }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product Price :</b>{{ $price }} {{ Auth::user()->currency }}</span>
                        </div>
                    </div>
                    @elseif($form_name=='make_payment')

                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Category name : </b>{{ $product_info->category_info->name }}</span>
                        </div>
                    </div>
    
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>SubCategory name :</b>{{ $product_info->subcategory_info->name }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product name :</b>{{ $sell_order->product_name }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product Qty :</b>{{ $sell_order->quantity }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product Price :</b>{{ $price }} {{ Auth::user()->currency }}</span>
                        </div>
                    </div>

                    @elseif($form_name=='influence_marketing')

                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Category name : </b>{{ $product_info->category_info->name }}</span>
                        </div>
                    </div>
    
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>SubCategory name :</b>{{ $product_info->subcategory_info->name }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product name :</b>{{ $sell_order->product_name }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product Qty :</b>{{ $sell_order->quantity }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product Price :</b>{{ $price }} {{ Auth::user()->currency }}</span>
                        </div>
                    </div>
                    @elseif($form_name=='gift_card')
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Category name : </b>{{ $product_info->category_info->name }}</span>
                        </div>
                    </div>
    
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>SubCategory name :</b>{{ $product_info->subcategory_info->name }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product name :</b>{{ $sell_order->product_name }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product Qty :</b>{{ $sell_order->quantity }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product Price :</b>{{ $price }} {{ Auth::user()->currency }}</span>
                        </div>
                    </div>
                    @elseif($form_name=='subscription')
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Category name : </b>{{ $product_info->category_info->name }}</span>
                        </div>
                    </div>
    
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>SubCategory name :</b>{{ $product_info->subcategory_info->name }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product name :</b>{{ $sell_order->product_name }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product Qty :</b>{{ $sell_order->quantity }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product Price :</b>{{ $price }} {{ Auth::user()->currency }}</span>
                        </div>
                    </div>
                    @elseif($form_name=='digital_wallet')
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Category name : </b>{{ $product_info->category_info->name }}</span>
                        </div>
                    </div>
    
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>SubCategory name :</b>{{ $product_info->subcategory_info->name }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product name :</b>{{ $sell_order->product_name }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product Qty :</b>{{ $sell_order->quantity }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product Price :</b>{{ $price }} {{ Auth::user()->currency }}</span>
                        </div>
                    </div>
                    @elseif($form_name=='advertisement_account')
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Category name : </b>{{ $product_info->category_info->name }}</span>
                        </div>
                    </div>
    
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>SubCategory name :</b>{{ $product_info->subcategory_info->name }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product name :</b>{{ $sell_order->product_name }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product Qty :</b>{{ $sell_order->quantity }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product Price :</b>{{ $price }} {{ Auth::user()->currency }}</span>
                        </div>
                    </div>
                    @elseif($form_name=='social_media_promotion')
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Category name : </b>{{ $product_info->category_info->name }}</span>
                        </div>
                    </div>
    
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>SubCategory name :</b>{{ $product_info->subcategory_info->name }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product name :</b>{{ $sell_order->product_name }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product Qty :</b>{{ $sell_order->quantity }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Total Follower/Subscriber Views :</b>{{ $product_info->follower_subscriber }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product Price :</b>{{ $price }} {{ Auth::user()->currency }}</span>
                        </div>
                    </div>
                    @elseif($form_name=='top_up_apps')
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Category name : </b>{{ $product_info->category_info->name }}</span>
                        </div>
                    </div>
    
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>SubCategory name :</b>{{ $product_info->subcategory_info->name }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product name :</b>{{ $sell_order->product_name }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product Qty :</b>{{ $sell_order->quantity }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Total Top Up :</b>{{ $product_info->top_up }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product Price :</b>{{ $price }} {{ Auth::user()->currency }}</span>
                        </div>
                    </div>
                    @elseif($form_name=='games_zone')


                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Category name : </b>{{ $product_info->category_info->name }}</span>
                        </div>
                    </div>
    
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>SubCategory name :</b>{{ $product_info->subcategory_info->name }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product name :</b>{{ $sell_order->product_name }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product Qty :</b>{{ $sell_order->quantity }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Total Diamonds :</b>{{ $product_info->diamonds }}</span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" ><b>Product Price :</b>{{ $price }} {{ Auth::user()->currency }}</span>
                        </div>
                    </div>
                    @endif



                </div>
              
                

            </div>
            </<section>

    </div>

    <div class="ps-section__right " style="max-width: 100%;    max-width: 100%;
    border: 1px solid #80bc00;
    border-style: ridge;
    padding: 68px 10px;
    margin:5px 10px;">

   <section class="ps-card">
            <div class="ps-card__header">
                <h4>Document Send</h4>
            </div>


            <div class=" col-sm-12 ">
             <h6> Note :
                @if($form_name=='social_media')
               Please send all the information of product to  buyer email and insert an image on the bellow image field.

                @elseif($form_name=='make_payment')
                Please send Money  to  buyer account and insert an image on the bellow image field.
                @elseif($form_name=='influence_marketing')

                Please send all the information of product to  buyer email and insert an image on the bellow image field.
                @else
                Please send all the information of product to  buyer email and insert an image on the bellow image field.
                @endif

             </h6>
            </div>

            <div class="ps-card__content">




                <form class="ps-form--account-settings" action="{{ route('customer.delivery_confirm') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Send Poper Document  Image :</label><br>
                                <input name="document_image" required type="file" placeholder="" />
                                <input name="order_id"  type="hidden" value="{{ $order_id }}" placeholder="" />

                            </div>
                            <div class="form-group">
                                <label>Image 1 :</label><sup style="color:red">Optional</sup>
                                <input name="image2"  type="file" placeholder="" />

                            </div>
                            <div class="form-group">
                                <label>Image 2 :</label><sup style="color:red">Optional</sup>
                                <input name="image3"  type="file" placeholder="" />

                            </div>
                        </div>
                       

                    </div>
                  <p>* If you cancel you have penalty charge . </p>
                    <div class="ps-form__submit text-center">
                        <button class="ps-btn ps-btn--gray mr-3" type="reset">Cancel</button>
                        <button class="ps-btn success" type="submit">Comfirm</button>
                    </div>

                </form>
            </div>
        </section>


    </div>
</section>

@endsection