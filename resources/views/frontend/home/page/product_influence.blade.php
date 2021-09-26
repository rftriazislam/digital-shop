
@php($influence=\App\InfluenceMarketing::all())



<div class="ps-page--product reverse" style="padding-top:0px;">
	<div class="container" >
		<div class="ps-section--default ps-customer-bought" style="margin-bottom:0px;">
			<div class="ps-section__header" style="margin-bottom:0px;padding-bottom:0px;border-bottom: 0px solid #e3e3e3;">
				<h3>Influence Products</h3>
				<h3 style="text-align:right">View all</h3>
			</div>
			<div class="ps-section__content">
				<div class="row" id="influence">
					
					
					@foreach($influence as $v_item) 
					<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 " style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
						<div class="ps-product">
							<div class="ps-product__thumbnail"><a href="{{ route('addcart',[$v_item->id,$v_item->category_info->form_name]) }}">
								<img src="{{ asset('back_end/subcategory_images')}}/{{ $v_item->subcategory_info->image}}" alt=""></a>
							</div>
							


							<div class="card-block" style="height: 79px;">
								
								<span class="s_prifce" id="influence_price">${{ $v_item->price}}</span>
								
								
								<div class="card-text">
									{{ $v_item->social_name}}
									<br>
								</div>
							</div>
							<div class="card-footer">
								<div class="row text-center">
									
									<div class="col-12" >
										<button class="cart_btn_padding btn">
											<a href="{{ route('addcart',[$v_item->id,$v_item->category_info->form_name]) }}"> <b><i class=" fas fa-cart-plus"></i> Buy Now</b> </a> 
										</button>
										

									</div>

								</div>
							</div>


							
						</div>
					</div>

					@endforeach
					
					
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function(){



  $.getJSON('https://api.ipify.org/', function(data) {
    
      alert('s');
            });




var ip=10;


	function load_data()
	{
		$.ajax({
  
			url:"{{ route('home') }}",
			method:"POST",
               data:{ip:ip},
               dataType: "json",
			success:function(data)
			{
				
                $('#post_data').append(data.item);
				
			}
		})
	}










});


</script>