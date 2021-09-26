
@extends('frontend.home.master')
@section('maincontent')

<div class="ps-breadcrumb">
  <div class="container">
    <ul class="breadcrumb">
      <li><a href="{{ route('home') }}">Home</a></li>
      <li><a href="shop-default.html">cart</a></li>    
    </ul>
  </div>
</div>
<div class="ps-page--product">
  <div class="container">
    <div class="ps-page__container">
      
      
        <div class="ps-page__left">
        <div class="ps-product--detail ps-product--fullwidth">

        


          @if($form_name=='social_media')
          
          <div class="ps-product__header">
          
            <div class="ps-product__thumbnail" data-vertical="true">
              <figure>
                <div class="ps-wrapper">
                  <div class="ps-product__gallery" data-arrow="true">
                    <div class="item">
                      <a href="{{ ($data->image) ? asset('public/back_end/social_images') : asset('public/back_end/subcategory_images') }}/{{ ($data->image) ? $data->image : $data->subcategory_info->image }}">
                        <img class="add_to_cart_img" src="{{ ($data->image) ? asset('back_end/social_images') :asset('back_end/subcategory_images') }}/{{ ($data->image) ? $data->image : $data->subcategory_info->image }}" alt="picture">
                      </a></div>
                     
                  </div>
                </div>
              </figure>
              <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">
                 
              </div>
            
            </div>
              <div class="ps-product__info">
            

                <div class="ps-product__meta">
                  <h3 style="color:rgb(105, 7, 145)">{{ $data->subcategory_info->name }}</h3> 

                </div>
                <h4>{{ $data->social_name }}</h4>
                  <h4>Sell Price: {{ $price }}</h4>
                <div class="ps-product__desc">
                  <p><b>Link : </b><a style="word-wrap: break-word;" href="{{ $data->social_link}}"><strong>{{ $data->social_link}}</strong></a></p>
                  <p><b>Friend : </b><a ><strong>{{ $data->friends}}</strong></a></p>
                  <p><b>Follower : </b><a ><strong>{{ $data->followers}}</strong></a></p>
                  <ul class="ps-list--dot">
                    <li><b>data : </b><br>{{ $data->description }}</li>
            
                  </ul>
                  <h5>Quantity: 1</h5>
                </div>
                <div style="border: none;" class="ps-product__shopping">
               
                  <form action="{{ route('checkout')}}" method="post" enctype="multipart/form-data">
                   
                   <input name="product_id" value="{{$data->id}}" type="hidden">
                   <input name="form_name" value="{{$data->category_info->form_name}}" type="hidden">
                   <input name="qty" value="1" type="hidden">
                   <input class="form-control"  name="affiliate_id" value="{{ $affiliate_id }}"   type="hidden">  


                   
                   @csrf

                   @if(Auth::user()=='')
                   <a class="ps-btn" 
                   style="cursor: pointer;color:white" 
                   data-toggle="modal" 
                   data-target="#loginModal">Buy Now</a>
@else
<button type="submit" style="background-color:#6610f2" class="ps-btn">Ready To Buy</button>
    
@endif

                  </form>

                </div>


              </div>
             
          </div>
   @elseif($form_name=='make_payment')
   <div class="ps-product__header">
    <div class="ps-product__thumbnail" data-vertical="true">
      <figure>
        <div class="ps-wrapper">
          <div class="ps-product__gallery" data-arrow="true">
            <div class="item"><a href="img/products/detail/fullwidth/1.jpg"><img src="{{ asset('back_end/subcategory_images') }}/{{ $data->subcategory_info->image }}" alt=""></a></div>
          </div>
        </div>
      </figure>
      <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">
        
      </div>
    </div>

    <div class="ps-product__info">
        <h2></h2>

      <div class="ps-product__meta">
        <h3 style="color:rgb(105, 7, 145)">{{ $data->subcategory_info->name }}</h3>
      </div>
        <h4>Unit Price:  {{$price }}</h4>

        <h4>Send Price:  {{ $data->send_amount }} <b style="color:red"> {{ $data->send_currency }}</b></h4>

      <div class="ps-product__desc">
        <ul class="ps-list--dot">
          <li>data:<br>{{ $data->description }}</li>
        </ul>
        
      </div>
       <form action="{{ route('checkout')}}" method="post" enctype="multipart/form-data">
                   
        <input name="product_id" value="{{$data->id}}" type="hidden">
        <input name="form_name" value="{{$data->category_info->form_name}}" type="hidden">
        <h4>Amount
         <input class="form-control" style="width:50%" name="qty" value="1" min="1" max="{{ $data->send_amount }}" type="number"> 
         <input class="form-control"  name="affiliate_id" value="{{ $affiliate_id }}"   type="hidden">  

         <br>
        </h4>             
        @csrf
        @if(Auth::user()=='')
        <a class="ps-btn" 
        style="cursor: pointer;color:white" 
        data-toggle="modal" 
        data-target="#loginModal">Buy Now</a>
@else
<button type="submit" style="background-color:#6610f2" class="ps-btn">Ready To Buy</button>

@endif
       </form>
      <div class="ps-product__shopping">
        <figure>
        </figure>
     

        {{-- <a class="ps-btn" href="{{ route('checkout',[$data->id,$data->category_info->form_name,1])}}">Buy Now</a> --}}
      </div>
     
    </div>

  </div>

@elseif($form_name=='influence_marketing')


 
<div class="ps-product__header">
          
  <div class="ps-product__thumbnail" data-vertical="true">
    <figure>
      <div class="ps-wrapper">
        <div class="ps-product__gallery" data-arrow="true">
          <div class="item">
            <a href="{{ asset('back_end/subcategory_images') }}/{{ $data->subcategory_info->image }}">
              <img class="add_to_cart_img" src="{{ asset('back_end/subcategory_images') }}/{{$data->subcategory_info->image }}" alt="picture">
            </a></div>
        </div>
      </div>
    </figure>
    <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">
      
    </div>
  </div>
    <div class="ps-product__info">
        <h2>{{ $data->social_name }}</h2>

      <div class="ps-product__meta">
        <h3 style="color:rgb(105, 7, 145)">{{ $data->subcategory_info->name }}</h3>
      </div>
        <h4>Sell Price:  {{ $price }} </h4>
      <div class="ps-product__desc">
        <p><b>Link : </b><a style="word-wrap: break-word;" href="{{ $data->social_link}}"><strong>{{ $data->social_link}}</strong></a></p>
        <p><b>Last Engagement : </b><a ><strong>{{ $data->last_engagement	}}</strong></a></p>
        <p><b>Hire Time : </b><a ><strong>{{ $data->hiring_time}}</strong></a></p>
        <ul class="ps-list--dot">
          <li><b>data : </b><br>{{ $data->description }}</li>
  
        </ul>
        <h5>Quantity: 1</h5>
      </div>
      <div style="border: none;" class="ps-product__shopping">
        <figure>
        </figure>
        <form action="{{ route('checkout')}}" method="post" enctype="multipart/form-data">
         
         <input name="product_id" value="{{$data->id}}" type="hidden">
         <input name="form_name" value="{{$data->category_info->form_name}}" type="hidden">
         <input name="qty" value="1" type="hidden">
         <input class="form-control"  name="affiliate_id" value="{{ $affiliate_id }}"   type="hidden">  

         
         @csrf
         @if(Auth::user()=='')
         <a class="ps-btn" 
         style="cursor: pointer;color:white" 
         data-toggle="modal" 
         data-target="#loginModal">Buy Now</a>
@else
<button type="submit" style="background-color:#6610f2" class="ps-btn">Ready To Buy</button>

@endif
        </form>

      </div>
    </div>

</div>

@elseif($form_name=='gift_card')
<div class="ps-product__header">
 <div class="ps-product__thumbnail" data-vertical="true">
   <figure>
     <div class="ps-wrapper">
       <div class="ps-product__gallery" data-arrow="true">
         <div class="item"><a href="{{ asset('back_end/subcategory_images') }}/{{ $data->subcategory_info->image }}"><img src="{{ asset('back_end/subcategory_images') }}/{{ $data->subcategory_info->image }}" alt=""></a></div>
       </div>
     </div>
   </figure>
   <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">
     
   </div>
 </div>

 <div class="ps-product__info">
     <h2></h2>

   <div class="ps-product__meta">
     <h3 style="color:rgb(105, 7, 145)">{{ $data->subcategory_info->name }}</h3>
   </div>
     <h4>Sell Unit Price: {{ $price }}</h4>
   <div class="ps-product__desc" style="border-bottom: 1px solid #e1e1e1;" >
    

     <ul class="ps-list--dot">
       <li>data:<br>{{ $data->description }}</li>
     </ul>
     
   </div>
    <form action="{{ route('checkout')}}" method="post" enctype="multipart/form-data">
                
     <input name="product_id" value="{{$data->id}}" type="hidden">
     <input name="form_name" value="{{$data->category_info->form_name}}" type="hidden">
     <h4>Quantity: 
      <input class="form-control" style="width:50%" name="qty" value="1" min="1" max="{{ $data->qty }}" type="number">  
      <input class="form-control"  name="affiliate_id" value="{{ $affiliate_id }}"   type="hidden">  

      <br>
     </h4>             
     @csrf
     @if(Auth::user()=='')
     <a class="ps-btn" 
     style="cursor: pointer;color:white" 
     data-toggle="modal" 
     data-target="#loginModal">Buy Now</a>
@else
<button type="submit" style="background-color:#6610f2" class="ps-btn">Ready To Buy</button>

@endif
    </form>
   <div class="ps-product__shopping">
     <figure>
     </figure>
  

     {{-- <a class="ps-btn" href="{{ route('checkout',[$data->id,$data->category_info->form_name,1])}}">Buy Now</a> --}}
   </div>
  
 </div>

</div>
@elseif($form_name=='subscription')
<div class="ps-product__header">
 <div class="ps-product__thumbnail" data-vertical="true">
   <figure>
     <div class="ps-wrapper">
       <div class="ps-product__gallery" data-arrow="true">
         <div class="item"><a href="{{ asset('back_end/subcategory_images') }}/{{ $data->subcategory_info->image }}"><img src="{{ asset('back_end/subcategory_images') }}/{{ $data->subcategory_info->image }}" alt=""></a></div>
       </div>
     </div>
   </figure>
   <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">
     
   </div>
 </div>

 <div class="ps-product__info">
     <h2></h2>

   <div class="ps-product__meta">
     <h3 style="color:rgb(105, 7, 145)">{{ $data->subcategory_info->name }}</h3>
   </div>
     <h4>Sell Unit Price: {{ $price }}</h4>
   <div class="ps-product__desc">
    

     <ul class="ps-list--dot">
       <li>data:<br>{{ $data->description }}</li>
     </ul>
     
   </div>
    <form action="{{ route('checkout')}}" method="post" enctype="multipart/form-data">
                
     <input name="product_id" value="{{$data->id}}" type="hidden">
     <input name="form_name" value="{{$data->category_info->form_name}}" type="hidden">
     <h4>Quantity: 
      <input class="form-control" style="width:50%" name="qty" value="1" min="1" max="{{ $data->qty }}" type="number">  
      <input class="form-control"  name="affiliate_id" value="{{ $affiliate_id }}"   type="hidden">  

      <br>
     </h4>             
     @csrf
     @if(Auth::user()=='')
     <a class="ps-btn" 
     style="cursor: pointer;color:white" 
     data-toggle="modal" 
     data-target="#loginModal">Buy Now</a>
@else
<button type="submit" style="background-color:#6610f2" class="ps-btn">Ready To Buy</button>

@endif
    </form>
   <div class="ps-product__shopping">
     <figure>
     </figure>
  

     {{-- <a class="ps-btn" href="{{ route('checkout',[$data->id,$data->category_info->form_name,1])}}">Buy Now</a> --}}
   </div>
  
 </div>

</div>
@elseif($form_name=='digital_wallet')

<div class="ps-product__header">
          
  <div class="ps-product__thumbnail" data-vertical="true">
    <figure>
      <div class="ps-wrapper">
        <div class="ps-product__gallery" data-arrow="true">
          <div class="item">
            <a href="{{ asset('back_end/subcategory_images') }}/{{ $data->subcategory_info->image }}">
              <img class="add_to_cart_img" src="{{ asset('back_end/subcategory_images') }}/{{$data->subcategory_info->image }}" alt="picture">
            </a></div>
        </div>
      </div>
    </figure>
    <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">
      
    </div>
  </div>
    <div class="ps-product__info">
        <h2>{{ $data->account_name }}</h2>

      <div class="ps-product__meta">
        <h3 style="color:rgb(105, 7, 145)">{{ $data->subcategory_info->name }}</h3>
      </div>
        <h4>Sell Price:  {{ $price }} </h4>
      <div class="ps-product__desc">
        <p><b>Stock Balance : </b><a style="word-wrap: break-word;" href="{{ $data->balance}}"><strong>{{ $data->account_currency}}</strong></a></p>
   
        <p><b>Opening Year: </b><a ><strong>{{ $data->opening_year}}</strong></a></p>
        <ul class="ps-list--dot">
          <li><b>data : </b><br>{{ $data->description }}</li>
  
        </ul>
        <h5>Quantity: 1</h5>
      </div>
      <div style="border: none;" class="ps-product__shopping">
        <figure>
        </figure>
        <form action="{{ route('checkout')}}" method="post" enctype="multipart/form-data">
         
         <input name="product_id" value="{{$data->id}}" type="hidden">
         <input name="form_name" value="{{$data->category_info->form_name}}" type="hidden">
         <input name="qty" value="1" type="hidden">
         <input class="form-control"  name="affiliate_id" value="{{ $affiliate_id }}"   type="hidden">  

         
         @csrf
         @if(Auth::user()=='')
         <a class="ps-btn" 
         style="cursor: pointer;color:white" 
         data-toggle="modal" 
         data-target="#loginModal">Buy Now</a>
@else
<button type="submit" style="background-color:#6610f2" class="ps-btn">Ready To Buy</button>

@endif
        </form>

      </div>
    </div>

</div>
@elseif($form_name=='advertisement_account')


 
<div class="ps-product__header">
          
  <div class="ps-product__thumbnail" data-vertical="true">
    <figure>
      <div class="ps-wrapper">
        <div class="ps-product__gallery" data-arrow="true">
          <div class="item">
            <a href="{{ asset('back_end/subcategory_images') }}/{{ $data->subcategory_info->image }}">
              <img class="add_to_cart_img" src="{{ asset('back_end/subcategory_images') }}/{{$data->subcategory_info->image }}" alt="picture">
            </a></div>
        </div>
      </div>
    </figure>
    <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">
      
    </div>
  </div>
    <div class="ps-product__info">
        <h2>{{ $data->account_name }}</h2>

      <div class="ps-product__meta">
        <h3 style="color:rgb(105, 7, 145)">{{ $data->subcategory_info->name }}</h3>
      </div>
        <h4>Sell Price:  {{ $price }} </h4>
      <div class="ps-product__desc">
        <p><b>Stock Balance : </b><a style="word-wrap: break-word;" href="{{ $data->balance}}"><strong>{{ $data->account_currency}}</strong></a></p>
   
        <p><b>Opening Year: </b><a ><strong>{{ $data->opening_year}}</strong></a></p>

        <p><b>Account: </b><a ><b>@if($data->is_verified==1)Verified @else Not Verified @endif</b></a></p>
        <ul class="ps-list--dot">
          <li><b>data : </b><br>{{ $data->description }}</li>
  
        </ul>
        <h5>Quantity: 1</h5>
      </div>
      <div style="border: none;" class="ps-product__shopping">
        <figure>
        </figure>
        <form action="{{ route('checkout')}}" method="post" enctype="multipart/form-data">
         
         <input name="product_id" value="{{$data->id}}" type="hidden">
         <input name="form_name" value="{{$data->category_info->form_name}}" type="hidden">
         <input name="qty" value="1" type="hidden">
         <input class="form-control"  name="affiliate_id" value="{{ $affiliate_id }}"   type="hidden">  

         
         @csrf
         @if(Auth::user()=='')
         <a class="ps-btn" 
         style="cursor: pointer;color:white" 
         data-toggle="modal" 
         data-target="#loginModal">Buy Now</a>
@else
<button type="submit" style="background-color:#6610f2" class="ps-btn">Ready To Buy</button>

@endif
        </form>

      </div>
    </div>

</div>
@elseif($form_name=='social_media_promotion')


 
<div class="ps-product__header">
          
  <div class="ps-product__thumbnail" data-vertical="true">
    <figure>
      <div class="ps-wrapper">
        <div class="ps-product__gallery" data-arrow="true">
          <div class="item">
            <a href="{{ asset('back_end/subcategory_images') }}/{{ $data->subcategory_info->image }}">
              <img class="add_to_cart_img" src="{{ asset('back_end/subcategory_images') }}/{{$data->subcategory_info->image }}" alt="picture">
            </a></div>
        </div>
      </div>
    </figure>
    <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">
      
    </div>
  </div>
    <div class="ps-product__info">
        <h2>{{ $data->product_name }}</h2>

      <div class="ps-product__meta">
        <h3 style="color:rgb(105, 7, 145)">{{ $data->subcategory_info->name }}</h3>
      </div>
        <h4>Sell Price:  {{ $price }} Per {{ $data->follower_subscriber}}</h4>
      <div class="ps-product__desc">
       
   
      
        <ul class="ps-list--dot">
          <li><b>data : </b><br>{{ $data->description }}</li>
  
        </ul>
      <h5>Quantity : 1</h5>
      </div>
   
        <form action="{{ route('checkout')}}" method="post" enctype="multipart/form-data">
         
         <input name="product_id" value="{{$data->id}}" type="hidden">
         <input name="form_name" value="{{$data->category_info->form_name}}" type="hidden">
       
         <input class="form-control"  name="qty" value="1"   type="hidden">  
         <input class="form-control"  name="affiliate_id" value="{{ $affiliate_id }}"   type="hidden">  

         
         @csrf
         @if(Auth::user()=='')
         <a class="ps-btn" 
         style="cursor: pointer;color:white" 
         data-toggle="modal" 
         data-target="#loginModal">Buy Now</a>
@else
<button type="submit" style="background-color:#6610f2" class="ps-btn">Ready To Buy</button>

@endif
        </form>

    </div>

</div>
@elseif($form_name=='top_up_apps')


 
<div class="ps-product__header">
          
  <div class="ps-product__thumbnail" data-vertical="true">
    <figure>
      <div class="ps-wrapper">
        <div class="ps-product__gallery" data-arrow="true">
          <div class="item">
            <a href="{{ asset('back_end/subcategory_images') }}/{{ $data->subcategory_info->image }}">
              <img class="add_to_cart_img" src="{{ asset('back_end/subcategory_images') }}/{{$data->subcategory_info->image }}" alt="picture">
            </a></div>
        </div>
      </div>
    </figure>
    <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">
      
    </div>
  </div>
    <div class="ps-product__info">
        <h2>{{ $data->product_name }}</h2>

      <div class="ps-product__meta">
        <h3 style="color:rgb(105, 7, 145)">{{ $data->subcategory_info->name }}</h3>
      </div>
        <h4>Sell Price:  {{ $price }} Per {{ $data->top_up}} </h4>
      <div class="ps-product__desc">
     
   
       
        <ul class="ps-list--dot">
          <li><b>data : </b><br>{{ $data->description }}</li>
  
        </ul>
           <h5>Quantity : 1</h5>
      </div>
    
     
        <form action="{{ route('checkout')}}" method="post" enctype="multipart/form-data">
         
         <input name="product_id" value="{{$data->id}}" type="hidden">
         <input name="form_name" value="{{$data->category_info->form_name}}" type="hidden">
     
         <input class="form-control"  name="qty" value="1"   type="hidden">  
         <input class="form-control"  name="affiliate_id" value="{{ $affiliate_id }}"   type="hidden">  

         
         @csrf
         @if(Auth::user()=='')
         <a class="ps-btn" 
         style="cursor: pointer;color:white" 
         data-toggle="modal" 
         data-target="#loginModal">Buy Now</a>
@else
<button type="submit" style="background-color:#6610f2" class="ps-btn">Ready To Buy</button>

@endif
        </form>

     
    </div>

</div>
@elseif($form_name=='games_zone')


 
<div class="ps-product__header">
          
  <div class="ps-product__thumbnail" data-vertical="true">
    <figure>
      <div class="ps-wrapper">
        <div class="ps-product__gallery" data-arrow="true">
          <div class="item">
            <a href="{{ asset('back_end/subcategory_images') }}/{{ $data->subcategory_info->image }}">
              <img class="add_to_cart_img" src="{{ asset('back_end/subcategory_images') }}/{{$data->subcategory_info->image }}" alt="picture">
            </a></div>
        </div>
      </div>
    </figure>
    <div class="ps-product__variants" data-item="4" data-md="4" data-sm="4" data-arrow="false">
      
    </div>
  </div>
    <div class="ps-product__info">
        <h2>{{ $data->product_name }}</h2>

      <div class="ps-product__meta">
        <h3 style="color:rgb(105, 7, 145)">{{ $data->subcategory_info->name }}</h3>
      </div>
        <h4>Sell Price:  {{ $price }} Per  {{ $data->total_diamonds}}</h4>
      <div class="ps-product__desc">
      
   
       
        <ul class="ps-list--dot">
          <li><b>data : </b><br>{{ $data->description }}</li>
  
        </ul>
       <h5>Quantity : 1</h5>
      </div>
     
        <form action="{{ route('checkout')}}" method="post" enctype="multipart/form-data">
         
         <input name="product_id" value="{{$data->id}}" type="hidden">
         <input name="form_name" value="{{$data->category_info->form_name}}" type="hidden">
       
          <input class="form-control"  name="qty" value="1"   type="hidden">  
      
          <input class="form-control"  name="affiliate_id" value="{{ $affiliate_id }}"   type="hidden">  
        
         
         @csrf
         @if(Auth::user()=='')
         <a class="ps-btn" 
         style="cursor: pointer;color:white" 
         data-toggle="modal" 
         data-target="#loginModal">Buy Now</a>
@else
<button type="submit" style="background-color:#6610f2" class="ps-btn">Ready To Buy</button>

@endif
        </form>

      
    </div>

</div>
@endif

<div class="row">
   <div class="col-12">
    <h3>Affiliate Link :</h3>
<div class="form-group form-group--select">

@if(Auth::user()=='')
<a class="ps-btn" 
style="cursor: pointer;color:white" 
data-toggle="modal" 
data-target="#loginModal">Affiliate Link</a>
@else

<button class="ps-btn"style="float: left; height: 50px;" onclick="myFunction()">Copy</button>
<input class="form-control col-6" type="text" style="float:none;" value="{{ $affiliate_link }}" id="myInput">

    
@endif

</div>


  </div>
  <div class="col-md-6">
    
    <h3></h3>
    <img class="img-fluid" src="{{asset('front_end/img/payment/bkash.jpg')}}" alt="picture">
    <img class="img-fluid" src="{{asset('/front_end/img/payment/mastercard.jpg')}}" alt="picture">
    <img class="img-fluid" src="{{asset('/front_end/img/payment/visa.jpg')}}" alt="picture">

  </div>
 
  <div  class="col-md-6 text-center">
    <div class="row">
        <div class="col-md-6">
          <a href="#" ><img class="img-fluid" style="padding:5px 0px;" src="{{asset('/front_end/img/payment/google_play_store.jpg')}}" alt="picture"> </a>
        </div>
        <div class="col-md-6">   
          <a href="#" ><img class="img-fluid" style="padding:5px 0px;" src="{{asset('/front_end/img/payment/app_store.jpg')}}" alt="picture"></a>
          
        </div>
        
    </div>
    <span style="text-align: center;"><i class="phone_number fas fa-phone-volume"></i></span>
     &nbsp <span style="text-shadow: 1px 2px 3px #666;" class="phone_number">+8801716967050</span>
     <br>


     <ul class="ps-list--social">
      <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
      <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
      <li><a class="google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
      <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
    </ul>

  </div>
 
</div>
        </div>
         </div>

     
    </div>
   
   
  </div>
</div>


@include('frontend.home.page.popuplogin')

      @if(session('errors'))
      <script>
      $(function() {
          $('#loginModal').modal({
              show: true,
              
          });
      });
      </script>
      @endif


<script>
  function myFunction() {
    var copyText = document.getElementById("myInput");
    copyText.select();
    copyText.setSelectionRange(0, 99999)
    document.execCommand("copy");
  // $('#s').append('dddd')
  }
  </script>
@endsection