@extends('frontend.home.master')
@section('maincontent')
<div class="ps-page--simple">
  <div class="ps-breadcrumb">
    <div class="container">
      <ul class="breadcrumb">
        <li><a href="index.html">Home</a></li>
        <li><a href="shop-default.html">Shop</a></li>
        <li>Whishlist</li>
      </ul>
    </div>
  </div>
  <div class="ps-section--shopping ps-shopping-cart">
    <div class="container">
      <div class="ps-section__header">
        <h1>Shopping Cart</h1>
      </div>
      <div class="ps-section__content">
        <div class="table-responsive" id="cartpage">
         
        </div>
        <div class="row" style="margin-bottom: 20px">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 "  >
          <div id="carttotal" class="ps-block--shopping-total " style="border: 0;background-color:white">


           
          </div>
         
        </div>
      </div>

      <div class="ps-section__cart-actions"><a class="ps-btn" href="{{ url('/') }}" style="background-color: #673AB7;"><i class="icon-arrow-left"></i> Back to Shopping</a><a class="ps-btn ps-btn--outline" href="{{ route('checkout')}}" style="color:white"><i class="icon-sync"></i> Proceed to checkout</a></div>
     
    </div>
      <div class="ps-section__footer" >
        <div class="row" style="margin-bottom: 20px">
                  
                     
        </div>
      </div>
    </div>
  </div>
</div>

<script>  

  $(document).ready(function(){

    load_cart_page();



function load_cart_page()
{
$.ajax({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
 url:"{{ route('jscartpage') }}",
 method:"POST",
 dataType:"json",
 success:function(data)
 {
  $('#cartpage').html(data.cartpage);

  $('#carttotal').html(data.carttotal);


  console.log(data.data);

 }
});
}
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

    console.log(data.total_item);

   }
  });
}


$(document).on('click', '.delete', function(){

  var product_id = $(this).attr("id");
   $.ajax({

    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },

    url:"{{ route('singleproductremove') }}",
    method:"POST",
    data:{product_id:product_id},
    success:function()
    {
     load_cart_data();
     load_cart_page();
     $('#cart-popover').popover('hide');
     
    }
   })

 });

 $(document).on('change', '.update', function(){


var product_quantity = $(this).val();


var product_id = $(this).attr('id');



 $.ajax({

  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },

  url:"{{ route('cartupdate') }}",
  method:"POST",
  data:{product_quantity:product_quantity,product_id:product_id},
  success:function()
  {
   load_cart_data();
   load_cart_page();
  //  $('#cart-popover').popover('hide');
   
  }
 })

});

  });
  
  </script>
@endsection

