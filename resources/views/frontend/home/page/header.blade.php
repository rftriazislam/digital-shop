@php( $category = \App\Category::with('subcategory')->where('status',1)->get() )


<header class="header header--standard header--electronic" data-sticky="true">
    <div class="header__top">
      <div class="container" >
        <div class="header__left">
          <p>Welcome to Digital Online Store !</p>
         
        </div>
        <div class="header__right">
          <ul class="header__top-links">
            <li><a href="#">Store Location</a></li>
            <li><a href="#">Track Your Order</a></li>
           
            <li>
              <div class="ps-dropdown language"><a ><img src="{{ asset('flags/bd.png') }}" alt=""> Bangladesh</a>
            
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="header__content">
      <div class="container">
        <div class="header__content-left"><a class="ps-logo" href="{{ url('/') }}"><img src="{{ asset('front_end/logo/D-1.png') }}" alt="Unistag Digital"></a>
          <div class="menu--product-categories">
            <div class="menu__toggle"><i class="icon-menu"></i><span>Unistag Digital</span></div>
            <div class="menu__content">
                          <ul class="menu--dropdown">
                            @foreach ($category as $v_category)
                                
                            
                            <li class="menu-item-has-children has-mega-menu"><a href="#"><i class="icon-star"></i>{{ $v_category->name }}</a>
                              <div class="mega-menu">
                               
                                <div class="mega-menu__column">
                          
                                  <h4>{{ $v_category->name }}<span class="sub-toggle"></span>
                                  
                                  </h4>
                                              <ul class="mega-menu__list">
                                                @foreach ($v_category->subcategory as $v_subcategory)
                                                <li><a href="{{ route('singlesubcategory',[$v_subcategory->id,$v_subcategory->category_info->form_name]) }}">{{ $v_subcategory->name }}</a>
                                                </li>
                                               @endforeach
                                              </ul>

                                   

                                </div>
                             
                              </div>
                            </li>
                              @endforeach
                           
                            {{-- <li><a href="#"><i class="icon-car-siren"></i>Wishlist</a>
                            </li>
                            <li><a href="#"><i class="icon-wrench"></i>Card</a>
                            </li>
                            <li><a href="#"><i class="icon-tag"></i>Services</a>
                            </li> --}}
                          </ul>
            </div>
          </div>
        </div>
        <div class="header__content-center">
          <form class="ps-form--quick-search" action="{{ route('search_product') }}" method="post">
         @csrf
            <input id="search" class="form-control" type="text" name="key" placeholder="I'm shopping for...">
            <button>Search</button>
            <br>
             <ul  id="suggestiontext" style="    position: absolute;
             z-index: 3;
             width: 100%;
             margin-top: 40px;background:white">
           
         
            
            </ul>
          </form>
       
         
         
        


          
        </div>

     
        <div class="header__content-right">
          <div class="header__actions"><a class="header__extra" href="#"><i class="icon-heart"></i>
            

              @if(Auth::user()=='')
            
                @else
                <span>
                 <i id="totalwish">0</i>
                </span>
                 @endif
          
          </a>
           
            <div class="ps-block--user-header">
              <div class="ps-block__left"><i class="icon-user"></i></div>
             <div class="ps-block__right">
              @if(Auth::user()=='')
              <a href="{{route('login')}}" >Login</a>

              @elseif(Auth::user()->role=='admin')
              <a href="{{route('admin')}}">Dashboard</a>
              @elseif(Auth::user()->role=='customer')
              <a href="{{route('customer')}}" >Dashboard</a>
              @else
              <a href="" >My Profile</a>
              @endif
            
</div>


            </div>
          </div>
        </div>
      </div>
    </div>
    
    {{-- <nav class="navigation">
      <div class="container">
                    <ul class="menu menu--electronic">
                      <li><a href="{{route('category')}}"><i class="icon-star"></i>Category</a>
                      </li>
                      <li><a href="{{route('subcategory')}}"><i class="icon-surveillance"></i>Subcategory</a>
                      </li>
                      <li><a href="{{route('product')}}"><i class="icon-laundry"></i> Product</a>
                      </li>
                     
                     
                    </ul>
      </div>
    </nav> --}}
  </header>
  <header class="header header--mobile electronic" data-sticky="true">
    <div class="header__top">
      <div class="header__left">
        <p>Welcome to Martfury Online Shopping Store !</p>
      </div>
      <div class="header__right">
        <ul class="navigation__extra">
          <li><a href="#">Sell on Martfury</a></li>
          <li><a href="#">Tract your order</a></li>
          <li>
            <div class="ps-dropdown"><a href="#">US Dollar</a>
              <ul class="ps-dropdown-menu">
                <li><a href="#">Us Dollar</a></li>
                <li><a href="#">Euro</a></li>
              </ul>
            </div>
          </li>
          <li>
            <div class="ps-dropdown language"><a href="#"><img src="{{ asset('front_end/img/flag/en.png') }}" alt="">English</a>
              <ul class="ps-dropdown-menu">
                <li><a href="#"><img src="{{ asset('front_end/img/flag/germany.png') }}" alt=""> Germany</a></li>
                <li><a href="#"><img src="{{ asset('front_end/img/flag/fr.png') }}" alt=""> France</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>

    <div class="navigation--mobile">
      <div class="navigation__left"><a class="ps-logo" href="{{ url('/') }}"><img style="width:152px;height:44px;" src="{{ asset('front_end/logo/D-1.png') }}" alt=""></a></div>
      <div class="navigation__right">
        <div class="header__actions">
          <div class="ps-cart--mini"><a class="header__extra" href="#"><i class="icon-heart"></i>
            
            @if(Auth::user()=='')
            
            @else
            <span>
                   <i id="totalwishm">0</i>
                  </span>
            @endif
            
          
          
          </a>
           
          </div>
          <div class="ps-block--user-header">
            @if(Auth::user()=='')

            <div class="ps-block__left"><a href="{{route('login')}}"><i class="icon-user-plus"></i></a></div>
            @else
            <div class="ps-block__left"><a href="{{route('logout')}}" ><i class="icon-user-minus"></i></a></div>

            @endif

          </div>
        </div>
      </div>
    </div>
    {{-- <div class="ps-search--mobile">
      <form class="ps-form--search-mobile" action="index.html" method="get">
        <div class="form-group--nest">
          <input class="form-control" type="text" placeholder="Search something...">
          <button><i class="icon-magnifier"></i></button>
        </div>
      </form>
    </div> --}}
  </header>

  <div class="ps-panel--sidebar" id="cart-mobile">
    <div class="ps-panel__header">
        <h3>Order History</h3>
    </div>
    <div class="navigation__content">
        <div class="ps-cart--mobile">
            <div class="ps-cart__content">
              @if(Auth::user()=='')

       
    
@else
@php( $order = \App\SellOrder::where('buyer_id',Auth::user()->id)->orwhere('seller_id',Auth::user()->id)->get() )

@forelse($order as $item)
<div class="ps-product--cart-mobile">
    <div class="ps-product__thumbnail"><a href="#"><img src="" alt=""></a></div>
    <div class="ps-product__content"><a class="ps-product__remove" href="#"><i class="icon-cross"></i></a>
      <a href="product-default.html">{{ $item->product_name }}</a>
        <p><strong>Sold by:</strong> YOUNG SHOP</p><small>1 x $59.99</small>
    </div>
</div>
@empty
<div class="ps-product--cart-mobile">
<h4 style="text-align: center;color:red">No Order Yet </h4>
  
</div>

@endforelse

@endif



            </div>

            {{-- <div class="ps-cart__footer">
                <h3>Sub Total:<strong>$59.99</strong></h3>
                <figure><a class="ps-btn" href="shopping-cart.html">View Cart</a><a class="ps-btn" href="checkout.html">Checkout</a></figure>
            </div> --}}
            
        </div>
    </div>
</div>

<div class="ps-panel--sidebar" id="navigation-mobile">
    <div class="ps-panel__header">
        <h3>Categories</h3>
    </div>
    <div class="ps-panel__content">
        <ul class="menu--mobile">
          @foreach ($category as $v_category)
            <li class="current-menu-item menu-item-has-children has-mega-menu"><a href="#">{{ $v_category->name }}</a><span class="sub-toggle"></span>
                <div class="mega-menu">
                    <div class="mega-menu__column">
                      @foreach ($v_category->subcategory as $v_subcategory)
                      <h4><a href="{{ route('singlesubcategory',[$v_subcategory->id,$v_subcategory->category_info->form_name]) }}">{{ $v_subcategory->name }} </a></h4>  
                    
                     @endforeach
                              
                    </div>
                </div>
            </li>
          
            @endforeach

        
        </ul>
    </div>
</div>

<div class="navigation--list">
    <div class="navigation__content">
      <a class="navigation__item ps-toggle--sidebar" href="#menu-mobile"><i class="icon-menu"></i><span> Menu</span></a>
      <a class="navigation__item ps-toggle--sidebar" href="#navigation-mobile"><i class="icon-list4"></i><span> Categories</span></a>
      <a class="navigation__item ps-toggle--sidebar" href="#search-sidebar"><i class="icon-magnifier"></i><span> Search</span></a> 
      @if(Auth::user()=='')
  
     <a class="navigation__item ps-togglex--sidebar" href="{{route('login')}}"><i class="icon-history"></i><span> History</span></a>
     @else
     <a class="navigation__item ps-toggle--sidebar" href="#cart-mobile"><i class="icon-history"></i><span> History</span></a>

      @endif
    
    
    </div>
</div>

<div class="ps-panel--sidebar" id="search-sidebar">
    <div class="ps-panel__header">
      <form class="ps-form--quick-search" action="{{ route('search_product') }}" method="post">
        @csrf
            <div class="form-group--nest">
                <input id="search_mobile" class="form-control" type="text" placeholder="Search something...">
                <button><i class="icon-magnifier"></i></button>

                <br>
               

            </div>
        </form>
    </div>
    <div class="navigation__content" id="suggestiontext_mobile">

     
    </div>
</div>

<div class="ps-panel--sidebar" id="menu-mobile">
    <div class="ps-panel__header">
        <h3>Menu</h3>
    </div>
    <div class="ps-panel__content">
        <ul class="menu--mobile">
         
            <li class="menu-item-has-children has-mega-menu"><a href="#">Home</a><span class="sub-toggle"></span>
                <div class="mega-menu">
                    <div class="mega-menu__column">
                        <h4>Contact<span class="sub-toggle"></span></h4>
                        <ul class="mega-menu__list">
                            <li class="current-menu-item "><a href="about-us.html">About Us</a>
                            </li>
                            <li class="current-menu-item "><a href="contact-us.html">Contact</a>
                            </li>
                            <li class="current-menu-item "><a href="faqs.html">Faqs</a>
                            </li>
                            <li class="current-menu-item "><a href="{{ route('terms_conditions') }}">Terms & condition</a>
                            </li>
                            <li class="current-menu-item "><a href="{{ route('privacy_policy') }}">Privacy Policy</a>
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </li>
            <li class="menu-item-has-children has-mega-menu">
              
            
              @if(Auth::user()=='')
              <a href="{{route('login')}}" >Login</a>

              @elseif(Auth::user()->role=='admin')
              <a href="{{route('admin')}}">Dashboard</a>
              @elseif(Auth::user()->role=='customer')
              <a href="{{route('customer')}}" ><b>Dashboard</b></a>
              @else
              <a href="" >My Profile</a>
              @endif
            </li>
        </ul>
    </div>
</div>

     <script>  

 $(document).ready(function(){





 load_cart_data();
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



  $("#search").keyup(function(){
  //  console.log($(this).val())
var key=$(this).val();
  

		$.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
		type: "POST",
		url: "{{ route('searchsuggetion') }}",
    data:'key='+$(this).val(),
    dataType:"json",
		success: function(data){
      console.log(data.message)

      if(data.message =='true'){
        $("#suggestiontext").show();
        $("#suggestiontext").html(data.key);
      }else{
        $("#suggestiontext").hide();
      }
      

      //  $("#suggestiontext").remove();
		}
    });
 
 

	});
  
  $("#search_mobile").keyup(function(){
//  console.log($(this).val())
 
var key=$(this).val()

$.ajax({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
type: "POST",
url: "{{ route('searchsuggetion') }}",
data:'key='+$(this).val(),
dataType:"json",
success: function(data){
  console.log(data.message)

  if(data.message =='true'){

    $("#suggestiontext_mobile").show();
    $("#suggestiontext_mobile").html(data.key);

  }else{

    $("#suggestiontext_mobile").hide();

  }
  

  //  $("#suggestiontext").remove();
}
});


  });


totalwish();
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
				
				$('#totalwish').text(data.total);     
        $('#totalwishm').text(data.total);   
			}
		})
	
}






});






    


    
    </script>