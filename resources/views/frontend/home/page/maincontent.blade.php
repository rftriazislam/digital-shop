@extends('frontend.home.master')
@section('title')
Unistag Digital|Home 
@endsection
@section('head_link') 
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
@endsection

@section('maincontent')

<div id="homepage-7" style="background:#f5f5f5">


	<div class="ps-home-banner" style="background:rgb(151 219 255 / 28%);">
		<div class="container" >
			<div class="ps-section__left">
				<div class="ps-carousel--nav-inside owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on" data-owl-animate-in="fadeIn" data-owl-animate-out="fadeOut">
					
					<a href="#"><img src="{{ asset('slider/slider2.jpg') }}" alt=""></a>
				
					<a href="#"><img src="{{ asset('slider/slider1.jpg') }}" alt=""></a>
					
					
					<a href="#"><img src="{{ asset('slider/slider3.jpg') }}" alt=""></a>
					
				</div>
			</div>
			<div class="ps-section__right">
				
				<a class="ps-collection" href="http://thirdhand.net/"><img src="{{ asset('banner/banner2.jpg') }}" alt=""></a>
				<a class="ps-collection" href="http://unistag.com/"><img src="{{ asset('banner/banner1.jpg') }}" alt=""></a>
			</div>
		</div>
	</div>
	


	<div class="ps-top-categories hide">
		<div class="container" >
			<h3 style="margin-bottom:0px;padding-bottom: 10px;">Categories</h3>
			<div class="row">
				@foreach ($category->take(4) as $v_category)
				
				
				<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 ">
					<div  data-mh="categories" style="background: white;height: 38px;border: 1px solid #bfbfbf;margin: 0px;transition: all 0.4s ease;text-align: center;border-radius: 69px;">
					
						{{-- <a href="{{ route('category',[$v_category->id,$v_category->form_name])}}"> 
							<div class="ps-block__thumbnail"><img class="img_s" src="{{ asset('back_end/category_images') }}/{{ $v_category->image }}" alt=""></div>
						</a> --}}


						{{-- <div class="ps-bloctk__xcontent" style="text-align: center;"> --}}

							<h4 style="text-align: center;margin: 13px auto;">
							
								<a href="{{ route('category',[$v_category->form_name])}}"> 
								{{ $v_category->name }}
								</a>
							
							</h4>
							
						{{-- </div>  --}}
						
					</div>
				</div>
				@endforeach     
			</div>
		</div>
	</div>


	



	
	<div class="ps-page--product reverse" style="padding-top:0px;">
		<div class="container" >
			<div class="ps-section--default ps-customer-bought" style="margin-bottom:0px;">
				<div class="ps-section__header" style="margin-bottom:0px;padding-bottom:0px;border-bottom: 0px solid #e3e3e3;">
				
					<h3 >  <b style="text-align:left" >Subcategory</b>   <b style="float:right"><a href="{{ route('subcategory') }}"> View all</a> </b> </h3>
				</div>
				<div class="ps-section__content">
					<div class="row">
						
						
						@foreach($subcategory as $v_item) 
						<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 " style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
							<div class="ps-product ps_product_hover">
								<div class="ps-product__thumbnail"><a href="{{ route('singlesubcategory',[$v_item->id,$v_item->category_info->form_name]) }}">
									<img src="{{ asset('back_end/subcategory_images')}}/{{ $v_item->image }}" alt=""></a>
								</div>
								
								<a>{{ $v_item->name }}</a>
								
							</div>
						</div>
	
						@endforeach
						
						
					</div>
				</div>
			</div>
		</div>
	</div>


	
	<div class="ps-page--product reverse" style="padding-top:0px;">
		<div class="container" >
			<div class="ps-section--default ps-customer-bought" style="margin-bottom:0px;">
				<div class="ps-section__header" style="margin-bottom:0px;padding-bottom:0px;border-bottom: 0px solid #e3e3e3;">
				
				
					<h3 >  <b style="text-align:left" >Social Media</b>   <b style="float:right"><a href="{{ route('category',['social_media'])}}"> View all</a> </b> </h3>

				</div>
				<div class="ps-section__content">
					<div class="row">
						
						
						@foreach($social_media as $v_social) 
						<div class="col-xl-33  col-sm-6  col-lg-2 col-md-4 col-sm-6 col-6" style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
							<div class="ps-product height_335 height_334 ps_product_hover">
								<div class="ps-product__thumbnail height "><a href="{{ route('addcart',[$v_social['id'],$v_social['form_name']]) }}">
									<img  src="{{ asset('back_end/subcategory_images')}}/{{ $v_social['image'] }}" alt=""></a>
								</div>
								
								{{-- <b><img src="http://127.0.0.1:8000/back_end/subcategory_images/1609132026.jpg" 
									height="18px" width="18px" style="border-radius: 50%;font-size:10px">{{ $v_social['user_name'] }}</b> --}}
									<img style="height: 18px;float: right;width: 31px;margin-top: 2px;" src="{{ asset('flags') }}/{{ $v_social['flag'] }}.png">
								<h5 style="font-size: 11px;margin-bottom:0px;">{{ $v_social['subcategory_name'] }}</h5>
								    <div class="card_new" >
									
								<div class="card-text sociall" >
										{{ substr($v_social['social_name'],0,25)}}@if(strlen($v_social['social_name'])>=25)...@else @endif

								</div>
									
							     

								Price :	<span class="s_prifce" id="influence_price" style="color:#ea4404fa;height:20px">{{ $v_social['price'] }}</span> 
									<span style="float:right;color: green;"> 

										<p class="alertMsg" style="background:#ea4404fa" id="l{{ $v_social["form_name"] }}{{ $v_social["id"] }}">Please login</p>
										<p class="alertMsg" style="background:#ea4404fa" id="{{ $v_social["form_name"] }}{{ $v_social["id"] }}">Already add</p>
										<p class="alertMsg" id="s{{ $v_social["form_name"] }}{{ $v_social["id"] }}">Successfully add</p>
										
										
										<b>
										 <a onclick='wishList("{{ $v_social["id"] }}","{{ $v_social["post_id"] }}","{{ $v_social["form_name"] }}");' >
											
											<i class="icon-heart"></i></a> </b> 	
										</span>
									<p>
										Friends: {{ $v_social['friends'] }}
									<br>
										Followers: {{ $v_social['followers'] }}
									
									</p>
								
								
								</div>
							 
	
	
								
							</div>
						</div>
	
						@endforeach
						
						
					</div>
				</div>
			</div>
		</div>
	</div>





<div class="ps-page--product reverse" style="padding-top:0px;">
	<div class="container" >
		<div class="ps-section--default ps-customer-bought" style="margin-bottom:0px;">
			<div class="ps-section__header" style="margin-bottom:0px;padding-bottom:0px;border-bottom: 0px solid #e3e3e3;">
		
			
				<h3 >  <b style="text-align:left" >Influence Marketing</b>   <b style="float:right"><a href="{{ route('category',['influence_marketing'])}}"> View all</a> </b> </h3>

			</div>
			<div class="ps-section__content">
				<div class="row">
					
					
					@foreach($influence as $v_item) 
					<div class="col-xl-33  col-sm-6  col-lg-2 col-md-4 col-sm-6 col-6" style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
						<div class="ps-product height_335 ps_product_hover">
							<div class="ps-product__thumbnail height "><a href="{{ route('addcart',[$v_item['id'],$v_item['form_name']]) }}">
								<img  src="{{ asset('back_end/subcategory_images')}}/{{ $v_item['image'] }}" alt=""></a>
							</div>
							
							<img style="height: 18px;float: right;width: 31px;margin-top: 2px;" src="{{ asset('flags') }}/{{ $v_item['flag'] }}.png">

	                          <h5 style="font-size: 11px;">{{ $v_item['subcategory_name'] }}</h5>
								<div class="card_new" >
							
							<div class="card-text sociall" >
									{{ substr($v_item['social_name'],0,25)}}@if(strlen($v_item['social_name'])>=25)...@else @endif
								
							</div>
								
							  

							Price : <span class="s_prifce" id="influence_price" style="color:#ea4404fa;height:20px">{{ $v_item['price'] }}</span>
								<span style="float:right;color: green;">

									<p class="alertMsg" style="background:#ea4404fa" id="l{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Please login</p>
									<p class="alertMsg" style="background:#ea4404fa" id="{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Already add</p>
									<p class="alertMsg" id="s{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Successfully add</p>
									 <b>
									<a onclick='wishList("{{ $v_item["id"] }}","{{ $v_item["post_id"] }}","{{ $v_item["form_name"] }}");' >
									   
									   <i class="icon-heart"></i></a> </b> 	
								   </span>
								<p >
									Hiring Time: {{ $v_item['hiring_time'] }}
								<br>
									Last views	: {{ $v_item['last_eng'] }}
								
								</p>
							
							
							</div>
						 


							
						</div>
					</div>

					@endforeach
					
					
				</div>
			</div>
		</div>
	</div>
</div>

<div class="ps-page--product reverse" style="padding-top:0px;">
	<div class="container" >
		<div class="ps-section--default ps-customer-bought" style="margin-bottom:0px;">
			<div class="ps-section__header" style="margin-bottom:0px;padding-bottom:0px;border-bottom: 0px solid #e3e3e3;">
			
				<h3 >  <b style="text-align:left" >GiftCards</b>   <b style="float:right"><a href="{{ route('category',['gift_card'])}}"> View all</a> </b> </h3>

			</div>
			<div class="ps-section__content">
				<div class="row">
					
					
					@foreach($giftcard as $v_item) 
					<div class="col-xl-33  col-sm-6  col-lg-2 col-md-4 col-sm-6 col-6" style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
						<div class="ps-product height_335 ps_product_hover">
							<div class="ps-product__thumbnail height "><a href="{{ route('addcart',[$v_item['id'],$v_item['form_name']]) }}">
								<img  src="{{ asset('back_end/subcategory_images')}}/{{ $v_item['image'] }}" alt=""></a>
							</div>
							

							<img style="height: 18px;float: right;width: 31px;margin-top: 2px;" src="{{ asset('flags') }}/{{ $v_item['flag'] }}.png">
							<h5 style="font-size: 11px;">{{ $v_item['subcategory_name'] }}</h5>
								<div class="card_new" >
								
							<div class="card-text " style="height: 54px;" >
								<h5>
									<p> 	{{ substr($v_item['name'],0,25)}}@if(strlen($v_item['name'])>=25)...@else @endif</p>	

								</h5>

							</div>
								
							  

							Unit Price :<span class="s_prifce" id="influence_price" style="color:#ea4404fa;height:20px">{{ $v_item['price'] }}</span>
								<span style="float:right;color: green;">
									
									<p class="alertMsg" style="background:#ea4404fa" id="l{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Please login</p>
									<p class="alertMsg" style="background:#ea4404fa" id="{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Already add</p>
									<p class="alertMsg"  id="s{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Successfully add</p><b>
									<a onclick='wishList("{{ $v_item["id"] }}","{{ $v_item["post_id"] }}","{{ $v_item["form_name"] }}");' >
									   
									   <i class="icon-heart"></i></a> </b> 	
								   </span>
								<p >
									Stock In: <b style="color:#ea4404fa"> {{ $v_item['qty'] }}</b>
								</p>
							
							
							</div>
						 
							<div class="ps-product__rating">
								<select class="ps-rating" data-read-only="true">
								  <option value="1">0</option>
								  <option value="1">2</option>
								  <option value="1">3</option>
								  <option value="1">4</option>
								  <option value="2">0</option>
								</select>
								<span>01</span>
				  </div>

							
						</div>
					</div>

				
					@endforeach
					
					
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ps-page--product reverse" style="padding-top:0px;">
	<div class="container" >
		<div class="ps-section--default ps-customer-bought" style="margin-bottom:0px;">
			<div class="ps-section__header" style="margin-bottom:0px;padding-bottom:0px;border-bottom: 0px solid #e3e3e3;">
		
			
				<h3 >  <b style="text-align:left" >Digital Wallet</b>   <b style="float:right"><a href="{{ route('category',['digital_wallet'])}}"> View all</a> </b> </h3>

			</div>
			<div class="ps-section__content">
				<div class="row">
					
					
					@foreach($digital_wallet as $v_item) 
					<div class="col-xl-33  col-sm-6  col-lg-2 col-md-4 col-sm-6 col-6" style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
						<div class="ps-product height_335 ps_product_hover">
							<div class="ps-product__thumbnail height "><a href="{{ route('addcart',[$v_item['id'],$v_item['form_name']]) }}">
								<img  src="{{ asset('back_end/subcategory_images')}}/{{ $v_item['image'] }}" alt=""></a>
								{{-- <div style="position: absolute;top: 3px; right:3px;background:white">  
									<img style="height: 18px;float: right;width: 31px;" src="{{ asset('flags') }}/{{ $v_item['flag'] }}.png">
								</div> --}}
							</div>
							
							<img style="height: 18px;float: right;width: 31px;margin-top: 2px;" src="{{ asset('flags') }}/{{ $v_item['flag'] }}.png">

							<h5 style="font-size: 11px;">{{ $v_item['subcategory_name'] }}</h5>

								<div class="card_new" >
								
									<div class="card-text social" >
										<h5>
										
											  {{-- <img style="height: 15px;float: right;width: 29px;" src="{{ asset('flags') }}/{{ $v_item['flag'] }}.png">	 --}}
											<p> 	{{ substr($v_item['name'],0,45)}}@if(strlen($v_item['name'])>=45)...@else @endif</p>	
		
										</h5>
									</div>
								
							  

							Price :	<span class="s_prifce" id="influence_price" style="color:#ea4404fa;height:20px">{{ $v_item['price'] }}</span>
								<span style="float:right;color: green;">
									
									<p class="alertMsg" style="background:#ea4404fa" id="l{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Please login</p>
									<p class="alertMsg" style="background:#ea4404fa" id="{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Already add</p>
									<p class="alertMsg" id="s{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Successfully add</p>
									
									
									<b>
									<a onclick='wishList("{{ $v_item["id"] }}","{{ $v_item["post_id"] }}","{{ $v_item["form_name"] }}");' >
									   
									   <i class="icon-heart"></i></a> </b> 	
								   </span>
								<p >
									Stock:<b> {{ $v_item["balance"] }}</b> <b style="color:#ea4404fa">{{ $v_item["currency"] }} </b> 
								</p>
							
							
							</div>
						 
					
							
						</div>
					</div>


					@endforeach
					
					
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ps-page--product reverse" style="padding-top:0px;">
	<div class="container" >
		<div class="ps-section--default ps-customer-bought" style="margin-bottom:0px;">
			<div class="ps-section__header" style="margin-bottom:0px;padding-bottom:0px;border-bottom: 0px solid #e3e3e3;">
		
			
				<h3 >  <b style="text-align:left" >Social Media Promotion</b>   <b style="float:right"><a href="{{ route('category',['social_media_promotion'])}}"> View all</a> </b> </h3>

			</div>
			<div class="ps-section__content">
				<div class="row">
					
					
					@foreach($promotion as $v_item) 
					<div class="col-xl-33  col-lg-2 col-md-4 col-sm-6 col-6" style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
						<div class="ps-product height_335 ps_product_hover">
							<div class="ps-product__thumbnail height "><a href="{{ route('addcart',[$v_item['id'],$v_item['form_name']]) }}">
								<img  src="{{ asset('back_end/subcategory_images')}}/{{ $v_item['image'] }}" alt=""></a>
							</div>
							

							<img style="height: 18px;float: right;width: 31px;margin-top: 2px;" src="{{ asset('flags') }}/{{ $v_item['flag'] }}.png">

							<h5 style="font-size: 11px;">{{ $v_item['subcategory_name'] }}</h5>
								<div class="card_new" >
								
									<div class="card-text social" >
										<h5>
											{{-- {{ $v_item['subcategory_name'] }}	 --}}
											<p> 	{{ substr($v_item['name'],0,45)}}@if(strlen($v_item['name'])>=45)...@else @endif</p>	
		
										</h5>
									</div>
								
							  

							Price :	<span class="s_prifce" id="influence_price" style="color:#ea4404fa;height:20px">{{ $v_item['price'] }}</span>
								<span style="float:right;color: green;">
									
									<p class="alertMsg" style="background:#ea4404fa" id="l{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Please login</p>
									<p class="alertMsg" style="background:#ea4404fa" id="{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Already add</p>
									<p class="alertMsg" id="s{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Successfully add</p>
									
									
									<b>
									<a onclick='wishList("{{ $v_item["id"] }}","{{ $v_item["post_id"] }}","{{ $v_item["form_name"] }}");' >
									   
									   <i class="icon-heart"></i></a> </b> 	
								   </span>
								<p>
									Package: <b> {{ $v_item["subscriber"] }} </b><br>
								
								</p>
								
								
							
							</div>
						 
							<div class="ps-product__rating">
								<select class="ps-rating" data-read-only="true">
								  <option value="1">0</option>
								  <option value="1">2</option>
								  <option value="1">3</option>
								  <option value="1">4</option>
								  <option value="2">0</option>
								</select>
								<span>01</span>
				  </div>

							
						</div>
					</div>


					@endforeach
					
					
				</div>
			</div>
		</div>
	</div>
</div>
<div class="ps-page--product reverse" style="padding-top:0px;">
	<div class="container" >
		<div class="ps-section--default ps-customer-bought" style="margin-bottom:0px;">
			<div class="ps-section__header" style="margin-bottom:0px;padding-bottom:0px;border-bottom: 0px solid #e3e3e3;">

				<h3 >  <b style="text-align:left" >Subscription</b>   <b style="float:right"><a href="{{ route('category',['subscription'])}}"> View all</a> </b> </h3>

			</div>
			<div class="ps-section__content">
				<div class="row">
					
					
					@foreach($subscription as $v_item) 
					<div class="col-xl-33  col-sm-6  col-lg-2 col-md-4 col-sm-6 col-6" style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
						<div class="ps-product height_335 ps_product_hover">
							<div class="ps-product__thumbnail height "><a href="{{ route('addcart',[$v_item['id'],$v_item['form_name']]) }}">
								<img  src="{{ asset('back_end/subcategory_images')}}/{{ $v_item['image'] }}" alt=""></a>
							</div>
							<img style="height: 18px;float: right;width: 31px;margin-top: 2px;" src="{{ asset('flags') }}/{{ $v_item['flag'] }}.png">

							<h5 style="font-size: 11px;">{{ $v_item['subcategory_name'] }}</h5>


								<div class="card_new" >
								
							<div class="card-text social" >
								<h5>
									{{-- {{ $v_item['subcategory_name'] }}	 --}}
									<p> 	{{ substr($v_item['name'],0,45)}}@if(strlen($v_item['name'])>=45)...@else @endif</p>	

								</h5>
							</div>
								
							  

							Unit Price :<span class="s_prifce" id="influence_price" style="color:#ea4404fa;height:20px">{{ $v_item['price'] }}</span>
								<span style="float:right;color: green;"> 
									
									<p class="alertMsg" style="background:#ea4404fa" id="l{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Please login</p>
									<p class="alertMsg" style="background:#ea4404fa" id="{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Already add</p>
									<p class="alertMsg" id="s{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Successfully add</p>
									
									
									<b>
									<a onclick='wishList("{{ $v_item["id"] }}","{{ $v_item["post_id"] }}","{{ $v_item["form_name"] }}");' >
									   
									   <i class="icon-heart"></i></a> </b> 	
								   </span>
								<p >
									Stock In: <b style="color:#ea4404fa"> {{ $v_item['qty'] }}</b>
								</p>
							
							
							</div>
						 
							<div class="ps-product__rating">
								<select class="ps-rating" data-read-only="true">
								  <option value="1">0</option>
								  <option value="1">2</option>
								  <option value="1">3</option>
								  <option value="1">4</option>
								  <option value="2">0</option>
								</select>
								<span>01</span>
				  </div>

							
						</div>
					</div>


					@endforeach
					
					
				</div>
			</div>
		</div>
	</div>
</div>

<div class="ps-page--product reverse" style="padding-top:0px;">
	<div class="container" >
		<div class="ps-section--default ps-customer-bought" style="margin-bottom:0px;">
			<div class="ps-section__header" style="margin-bottom:0px;padding-bottom:0px;border-bottom: 0px solid #e3e3e3;">
		
			
				<h3 >  <b style="text-align:left" ></b>Top Up Apps <b style="float:right"><a href="{{ route('category',['top_up_apps'])}}"> View all</a> </b> </h3>

			</div>
			<div class="ps-section__content">
				<div class="row">
					
					
					
					@foreach($topupapps as $v_item) 
					<div class="col-xl-33  col-sm-6  col-lg-2 col-md-4 col-sm-6 col-6" style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
						<div class="ps-product height_335 ps_product_hover">
							<div class="ps-product__thumbnail height "><a href="{{ route('addcart',[$v_item['id'],$v_item['form_name']]) }}">
								<img  src="{{ asset('back_end/subcategory_images')}}/{{ $v_item['image'] }}" alt=""></a>
							</div>
							
							<img style="height: 18px;float: right;width: 31px;margin-top: 2px;" src="{{ asset('flags') }}/{{ $v_item['flag'] }}.png">

							<h5 style="font-size: 11px;">{{ $v_item['subcategory_name'] }}</h5>

								<div class="card_new" >
								
									<div class="card-text social" >
										<h5>
											{{-- {{ $v_item['subcategory_name'] }}	 --}}
											<p> 	{{ substr($v_item['name'],0,45)}}@if(strlen($v_item['name'])>=45)...@else @endif</p>	
		
										</h5>
									</div>
								
							  

							Price :	<span class="s_prifce" id="influence_price" style="color:#ea4404fa;height:20px">{{ $v_item['price'] }}</span>
								<span style="float:right;color: green;">
									
									<p class="alertMsg" style="background:#ea4404fa" id="l{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Please login</p>
									<p class="alertMsg" style="background:#ea4404fa" id="{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Already add</p>
									<p class="alertMsg" id="s{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Successfully add</p>
									
									
									<b>
									<a onclick='wishList("{{ $v_item["id"] }}","{{ $v_item["post_id"] }}","{{ $v_item["form_name"] }}");' >
									   
									   <i class="icon-heart"></i></a> </b> 	
								   </span>
							
								<p>
									Package: <b> {{ $v_item["top_up"] }} </b><br>
								
								</p>
							
							
							</div>
						 
							<div class="ps-product__rating">
								<select class="ps-rating" data-read-only="true">
								  <option value="1">0</option>
								  <option value="1">2</option>
								  <option value="1">3</option>
								  <option value="1">4</option>
								  <option value="2">0</option>
								</select>
								<span>01</span>
				  </div>

							
						</div>
					</div>


					@endforeach
					
					
				</div>
			</div>
		</div>
	</div>
</div>

<div class="ps-page--product reverse" style="padding-top:0px;">
	<div class="container" >
		<div class="ps-section--default ps-customer-bought" style="margin-bottom:0px;">
			<div class="ps-section__header" style="margin-bottom:0px;padding-bottom:0px;border-bottom: 0px solid #e3e3e3;">
		
			
				<h3 >  <b style="text-align:left" ></b>Game Zone <b style="float:right"><a href="{{ route('category',['games_zone'])}}"> View all</a> </b> </h3>

			</div>
			<div class="ps-section__content">
				<div class="row">
					
					
					@foreach($gamezone as $v_item) 
					<div class="col-xl-33   col-lg-2 col-md-4 col-sm-6 col-6" style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
						<div class="ps-product height_335 ps_product_hover">
							<div class="ps-product__thumbnail height "><a href="{{ route('addcart',[$v_item['id'],$v_item['form_name']]) }}">
								<img  src="{{ asset('back_end/subcategory_images')}}/{{ $v_item['image'] }}" alt=""></a>
							</div>
							<img style="height: 18px;float: right;width: 31px;margin-top: 2px;" src="{{ asset('flags') }}/{{ $v_item['flag'] }}.png">

							<h5 style="font-size: 11px;">{{ $v_item['subcategory_name'] }}</h5>


								<div class="card_new" >
								
									<div class="card-text social" >
										<h5>
											{{-- {{ $v_item['subcategory_name'] }}	 --}}
											<p> 	{{ substr($v_item['name'],0,45)}}@if(strlen($v_item['name'])>=45)...@else @endif</p>	
		
										</h5>
									</div>
								
							  

							Price :	<span class="s_prifce" id="influence_price" style="color:#ea4404fa;height:20px">{{ $v_item['price'] }}</span>
								<span style="float:right;color: green;">
									
									<p class="alertMsg" style="background:#ea4404fa" id="l{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Please login</p>
									<p class="alertMsg" style="background:#ea4404fa" id="{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Already add</p>
									<p class="alertMsg" id="s{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Successfully add</p>
									
									
									<b>
									<a onclick='wishList("{{ $v_item["id"] }}","{{ $v_item["post_id"] }}","{{ $v_item["form_name"] }}");' >
									   
									   <i class="icon-heart"></i></a> </b> 	
								   </span>
								<p >

									Package: <b>{{ $v_item["diamonds"] }} </b>
								</p>
							
							
							</div>
						 
							<div class="ps-product__rating">
								<select class="ps-rating" data-read-only="true">
								  <option value="1">0</option>
								  <option value="1">2</option>
								  <option value="1">3</option>
								  <option value="1">4</option>
								  <option value="2">0</option>
								</select>
								<span>01</span>
				  </div>

							
						</div>
					</div>


					@endforeach
					
					
				</div>
			</div>
		</div>
	</div>
</div>

<div class="ps-page--product reverse" style="padding-top:0px;">
	<div class="container" >
		<div class="ps-section--default ps-customer-bought" style="margin-bottom:0px;">
			<div class="ps-section__header" style="margin-bottom:0px;padding-bottom:0px;border-bottom: 0px solid #e3e3e3;">
			
				<h3 >  <b style="text-align:left" >Payment</b>   <b style="float:right"><a href="{{ route('category',['make_payment'])}}"> View all</a> </b> </h3>

			</div>
			<div class="ps-section__content">
				<div class="row">
					
					
					@foreach($make_payment as $v_item) 
					<div class="col-xl-33  col-sm-6  col-lg-2 col-md-4 col-sm-6 col-6" style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
						<div class="ps-product height_335 ps_product_hover">
							<div class="ps-product__thumbnail height "><a href="{{ route('addcart',[$v_item['id'],$v_item['form_name']]) }}">
								<img  src="{{ asset('back_end/subcategory_images')}}/{{ $v_item['image'] }}" alt=""></a>
							</div>
							
							<img style="height: 18px;float: right;width: 31px;margin-top: 2px;" src="{{ asset('flags') }}/{{ $v_item['flag'] }}.png">

							<h5 style="font-size: 11px;">{{ $v_item['subcategory_name'] }}</h5>

								<div class="card_new" >
								
							<div class="card-text social" >
								<h5>
									{{-- {{ $v_item['subcategory_name'] }} --}}
									<p>	{{ $v_item['send_wallet']}} </p>
								
								</h5>
								


							</div>
								
							  

								<span class="s_prifce" id="influence_price" style="color:#ea4404fa;height:20px">

									<b style="color:black">Unit Price: </b> {{ $v_item['price']}}
								
								</span>
								<span style="float:right;color: green;"> 
									
									<p class="alertMsg" style="background:#ea4404fa" id="l{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Please login</p>
									<p class="alertMsg" style="background:#ea4404fa" id="{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Already add</p>
									<p class="alertMsg" id="s{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Successfully add</p>
									
									
									<b>
										<a onclick='wishList("{{ $v_item["id"] }}","{{ $v_item["post_id"] }}","{{ $v_item["form_name"] }}");' >
									   
											<i class="icon-heart"></i></a> </b> 	
								   </span>


								<p >
								<b > 	Stock: </b> <b style="color:rgb(77, 36, 17)"> {{ $v_item['send_amount']}}</b> <b style="color:red">{{$v_item['send_currency']}}</b>
								</p>
							
							
							</div>
						 
							<div class="ps-product__rating">
								<select class="ps-rating" data-read-only="true">
								  <option value="1">0</option>
								  <option value="1">2</option>
								  <option value="1">3</option>
								  <option value="1">4</option>
								  <option value="2">0</option>
								</select>
								<span>01</span>
				  </div>

							
						</div>
					</div>

					@endforeach
					
					
				</div>
			</div>
		</div>
	</div>
</div>


<div class="ps-page--product reverse" style="padding-top:0px;">
	<div class="container" >
		<div class="ps-section--default ps-customer-bought" style="margin-bottom:0px;">
			<div class="ps-section__header" style="margin-bottom:0px;padding-bottom:0px;border-bottom: 0px solid #e3e3e3;">
		
			
				<h3 >  <b style="text-align:left" >Advertisement Account</b>   <b style="float:right"><a href="{{ route('category',['advertisement_account'])}}"> View all</a> </b> </h3>

			</div>
			<div class="ps-section__content">
				<div class="row">
					
					
					@foreach($advertisment_account as $v_item) 
					<div class="col-xl-33  col-sm-6  col-lg-2 col-md-4 col-sm-6 col-6" style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
						<div class="ps-product height_335 ps_product_hover">
							<div class="ps-product__thumbnail height ">

								<a href="{{ route('addcart',[$v_item['id'],$v_item['form_name']]) }}">
								<img  src="{{ asset('back_end/subcategory_images')}}/{{ $v_item['image'] }}" alt="">

							</a>
								
							</div>
							
							<img style="height: 18px;float: right;width: 31px;margin-top: 2px;" src="{{ asset('flags') }}/{{ $v_item['flag'] }}.png">

							<h5 style="font-size: 11px;">{{ $v_item['subcategory_name'] }}</h5>

								<div class="card_new" >
								
									<div class="card-text social" >
										<h5>
											{{-- {{ $v_item['subcategory_name'] }}	 --}}
											<p> 	{{ substr($v_item['name'],0,45)}}@if(strlen($v_item['name'])>=45)...@else @endif</p>	
		
										</h5>
									</div>
								
							  

							Price :	<span class="s_prifce" id="influence_price" style="color:#ea4404fa;height:20px">{{ $v_item['price'] }}</span>
								<span style="float:right;color: green;"> 
									
									<p class="alertMsg" style="background:#ea4404fa" id="l{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Please login</p>
									<p class="alertMsg" style="background:#ea4404fa" id="{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Already add</p>
									<p class="alertMsg" id="s{{ $v_item["form_name"] }}{{ $v_item["id"] }}">Successfully add</p>
									
									
									<b>
									<a onclick='wishList("{{ $v_item["id"] }}","{{ $v_item["post_id"] }}","{{ $v_item["form_name"] }}");' >
									   
									   <i class="icon-heart"></i></a> </b> 	
								   </span>
								<p >
									Stock:<b>{{ $v_item["balance"] }} </b> <b style="color:#ea4404fa" >{{ $v_item["currency"] }} </b>
								</p>
							
							
							</div>
						
							
						</div>
					</div>


					@endforeach
					
					
				</div>
			</div>
		</div>
	</div>
</div>


	
	
</div>

<div class="ps-page--product reverse" style="background:#f5f5f5">
	<div class="container" >
		<div class="ps-section--default ps-customer-bought">
			<div class="ps-section__header" style="margin-bottom:0px;padding-bottom:0px;border-bottom: 0px solid #e3e3e3;">
			
				<h3 >  <b style="text-align:left" >Products</b></h3>

			</div>
			<div class="ps-section__content">
				<div id="post_data" class="row">	
              	 @csrf
       
				</div>
               <div id="load_m">
        
               </div>
				
			</div>
		</div>
	</div>
</div>

</div>



<script type="text/javascript">

	// console.log('ssss');
	load_cart_data();

	function add(param,cate_id){
		var category_id = cate_id ;
// var form_name=form_name;
// console.log(category_id);



var product_id = param;

var url = "{{ url('/add-to-cart') }}/"+product_id+"/"+category_id;

$.ajax({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	},
	type: "POST",
	url: "{{ url('/add-to-cart') }}",
	data: { product_id: product_id ,category_id: category_id },
	
	success: function (data) {

		load_cart_data();
		// console.log('cart item',data);
		
		$.each(data.data, function(i,index){
			$('#ss').append(               
				'<p>' +index.id+'</p>'      
				);
		});

	},
	error: function (data) {

		console.log('Error:', data);
	}
});
};
function load_cart_data()
{
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url:"{{ route('load_data') }}",
		method:"POST",
		dataType:"json",
		success:function(data)
		{

			$('#cart_details').html(data.cart_details);
			$('.total_item').text(data.total_item);

			// console.log(data.total_item);

		}
	});
}

$(document).ready(function(){
	
	var _token = $('input[name="_token"]').val();

	load_data('', _token);

	function load_data(id="", _token)
	{
		$.ajax({
  
			url:"{{ route('load_data') }}",
			method:"POST",
               data:{id:id, _token:_token},
               dataType: "json",
			success:function(data)
			{
				$('#load_more_button').remove();
                $('#post_data').append(data.item);
				$('#load_m').append(data.load);

				// console.log(data.currency);
        
			}
		})
	}

	$(document).on('click', '#load_more_button', function(){
		var id = $(this).data('id');

		// console.log(id);


		$('#load_more_button').html('<b>Loading...</b>');
		load_data(id, _token);
	});


});



function wishList(ID,userID,form_name)
{
		$.ajax({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
			url:"{{ route('wishlist') }}",
			method:"POST",
               data:{product_id:ID, user_id:userID,form_name:form_name},
               dataType: "json",
			success:function(data)
			{
				
				totalwish();
                
				$('#totalwish').text(data.total);
            if(data.message =='already add'){

	$("#"+data.form_name).fadeIn('slow', function () {
                      $(this).delay(700).fadeOut('slow');
                       });

               }else if(data.message=='login'){

     	$("#l"+data.form_name).fadeIn('slow', function () {
                      $(this).delay(700).fadeOut('slow');
                       });

          }
	
            else{

	          $("#s"+data.form_name).fadeIn('slow', function () {
                       $(this).delay(700).fadeOut('slow');
                       });

}	

				// console.log(data);
        
			}
		})
	


}
function totalwish(){
	$.ajax({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
			url:"{{ route('totalwishlist') }}",
			method:"GET",
              
               dataType: "json",
			success:function(data)
			{
				$('#totalwishm').text(data.total);   
						$('#totalwish').text(data.total);
			
				// console.log(data.total);	
			
			
				
        
			}
		})
	
}



</script>
@endsection

@section('script')

@endsection