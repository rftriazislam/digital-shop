@extends('frontend.home.master')
@section('maincontent')


<div class="ps-page--product reverse">
	<div class="container">
		<div class="ps-section--default ps-customer-bought">
			<div class="ps-section__header">
				<h3>Products</h3>
			</div>
			<div class="ps-section__content">
				<div class="row">	
	@if($form_name == 'social_media')

				@foreach($data as $v_social)
					<div class="col-xl-33  col-sm-6  col-lg-2 col-md-4 col-sm-6 col-6" style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
							<div class="ps-product height_335 ps_product_hover">
								<div class="ps-product__thumbnail height "><a href="{{ route('addcart',[$v_social['id'],$v_social['form_name']]) }}">
									<img  src="{{ asset('back_end/subcategory_images')}}/{{ $v_social['image'] }}" alt=""></a>
								</div>
								
								{{-- <b><img src="http://127.0.0.1:8000/back_end/subcategory_images/1609132026.jpg" 
									height="18px" width="18px" style="border-radius: 50%;font-size:10px">{{ $v_social['user_name'] }}</b> --}}
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


    @elseif($form_name == 'make_payment')
	@foreach($data as $v_item) 
	<div class="col-xl-33  col-sm-6  col-lg-2 col-md-4 col-sm-6 col-6" style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
		<div class="ps-product height_335 ps_product_hover">
			<div class="ps-product__thumbnail height "><a href="{{ route('addcart',[$v_item['id'],$v_item['form_name']]) }}">
				<img  src="{{ asset('back_end/subcategory_images')}}/{{ $v_item['image'] }}" alt=""></a>
			</div>
			


				<div class="card_new" >
				
			<div class="card-text social" >
				<h5>
					{{ $v_item['subcategory_name'] }}
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
           
	@elseif($form_name == 'influence_marketing')
    	@foreach($data as $v_item) 
	<div class="col-xl-33  col-sm-6  col-lg-2 col-md-4 col-sm-6 col-6" style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
		<div class="ps-product height_335 ps_product_hover">
			<div class="ps-product__thumbnail height "><a href="{{ route('addcart',[$v_item['id'],$v_item['form_name']]) }}">
				<img  src="{{ asset('back_end/subcategory_images')}}/{{ $v_item['image'] }}" alt=""></a>
			</div>
			

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

	@elseif($form_name == 'gift_card')
				
	@foreach($data as $v_item) 
	<div class="col-xl-33  col-sm-6  col-lg-2 col-md-4 col-sm-6 col-6" style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
		<div class="ps-product height_335 ps_product_hover">
			<div class="ps-product__thumbnail height "><a href="{{ route('addcart',[$v_item['id'],$v_item['form_name']]) }}">
				<img  src="{{ asset('back_end/subcategory_images')}}/{{ $v_item['image'] }}" alt=""></a>
			</div>
			


				<div class="card_new" >
				
			<div class="card-text " style="height: 54px;" >
				<h5>
					{{ $v_item['subcategory_name'] }}	
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

    @elseif($form_name == 'subscription')
	@foreach($data as $v_item) 
	<div class="col-xl-33  col-sm-6  col-lg-2 col-md-4 col-sm-6 col-6" style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
		<div class="ps-product height_335 ps_product_hover">
			<div class="ps-product__thumbnail height "><a href="{{ route('addcart',[$v_item['id'],$v_item['form_name']]) }}">
				<img  src="{{ asset('back_end/subcategory_images')}}/{{ $v_item['image'] }}" alt=""></a>
			</div>
			


				<div class="card_new" >
				
			<div class="card-text social" >
				<h5>
					{{ $v_item['subcategory_name'] }}	
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
	@elseif($form_name == 'digital_wallet')
				
	@foreach($data as $v_item) 
	<div class="col-xl-33  col-sm-6  col-lg-2 col-md-4 col-sm-6 col-6" style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
		<div class="ps-product height_335 ps_product_hover">
			<div class="ps-product__thumbnail height "><a href="{{ route('addcart',[$v_item['id'],$v_item['form_name']]) }}">
				<img  src="{{ asset('back_end/subcategory_images')}}/{{ $v_item['image'] }}" alt=""></a>
			</div>
			


				<div class="card_new" >
				
					<div class="card-text social" >
						<h5>
							{{ $v_item['subcategory_name'] }}	
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
	@elseif($form_name == 'advertisement_account')

			
	@foreach($data as $v_item) 
	<div class="col-xl-33  col-sm-6  col-lg-2 col-md-4 col-sm-6 col-6" style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
		<div class="ps-product height_335 ps_product_hover">
			<div class="ps-product__thumbnail height ">

				<a href="{{ route('addcart',[$v_item['id'],$v_item['form_name']]) }}">
				<img  src="{{ asset('back_end/subcategory_images')}}/{{ $v_item['image'] }}" alt="">

			</a>
				
			</div>
			


				<div class="card_new" >
				
					<div class="card-text social" >
						<h5>
							{{ $v_item['subcategory_name'] }}	
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
	@elseif($form_name == 'social_media_promotion')
	@foreach($data as $v_item) 
	<div class="col-xl-33  col-lg-2 col-md-4 col-sm-6 col-6" style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
		<div class="ps-product height_335 ps_product_hover">
			<div class="ps-product__thumbnail height "><a href="{{ route('addcart',[$v_item['id'],$v_item['form_name']]) }}">
				<img  src="{{ asset('back_end/subcategory_images')}}/{{ $v_item['image'] }}" alt=""></a>
			</div>
			


				<div class="card_new" >
				
					<div class="card-text social" >
						<h5>
							{{ $v_item['subcategory_name'] }}	
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
	@elseif($form_name == 'games_zone')
	@foreach($data as $v_item) 
	<div class="col-xl-33   col-lg-2 col-md-4 col-sm-6 col-6" style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
		<div class="ps-product height_335 ps_product_hover">
			<div class="ps-product__thumbnail height "><a href="{{ route('addcart',[$v_item['id'],$v_item['form_name']]) }}">
				<img  src="{{ asset('back_end/subcategory_images')}}/{{ $v_item['image'] }}" alt=""></a>
			</div>
			


				<div class="card_new" >
				
					<div class="card-text social" >
						<h5>
							{{ $v_item['subcategory_name'] }}	
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
	
	@elseif($form_name == 'top_up_apps')
	@foreach($data as $v_item) 
					<div class="col-xl-33  col-sm-6  col-lg-2 col-md-4 col-sm-6 col-6" style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
						<div class="ps-product height_335 ps_product_hover">
							<div class="ps-product__thumbnail height "><a href="{{ route('addcart',[$v_item['id'],$v_item['form_name']]) }}">
								<img  src="{{ asset('back_end/subcategory_images')}}/{{ $v_item['image'] }}" alt=""></a>
							</div>
							


								<div class="card_new" >
								
									<div class="card-text social" >
										<h5>
											{{ $v_item['subcategory_name'] }}	
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

        @endif
				</div>
        
				
			</div>
		</div>
	</div>
</div>           
     
@endsection