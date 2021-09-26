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
          


     
				@foreach($data as $v_item)
				<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 " style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
					<div class="ps-product ps_product_hover">
						<div class="ps-product__thumbnail"><a href=""><img 
							src="{{asset('back_end/subcategory_images')}}/" alt=""></a>
							
						</div>
						<div class="ps-product__container">
							<div class=""><a class="ps-product__title" href=""></a>
								<div class="ps-product__rating">
									<select class="ps-rating" data-read-only="true">
										<option value="1">1</option>
										<option value="1">2</option>
										<option value="1">3</option>
										<option value="1">4</option>
										<option value="2">5</option>
									</select>
								</div>
								<p class="ps-product__price sale"></p>
							</div>
							<br/>
							<button class="btn products_btn">
								
								<a href=""> <b><i class=" fas fa-cart-plus"></i> Buy Now</b> </a> 

							</button>
							

						</div>
					</div>
				</div>
				@endforeach



 
				</div>
               
				
			</div>
		</div>
	</div>
</div>         

@endsection