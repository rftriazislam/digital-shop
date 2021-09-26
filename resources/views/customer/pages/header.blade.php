@php($category=\App\Category::where('status',1)->get())

<header class="header--mobile">
    <div class="header__left">
        <button class="ps-drawer-toggle"><i class="icon icon-menu"></i></button><img src="" alt="">
    </div>
    <div class="header__center"><a class="ps-logo" href="{{ route('home') }}"><img src="{{ asset('front_end/logo/D2.png') }}" alt=""></a></div>
    <div class="header__right"><a class="header__site-link" href="#"><i class="icon-exit-right"></i></a></div>
</header>
<aside class="ps-drawer--mobile">
    <div class="ps-drawer__header">
        <h4> Menu</h4>
        <button class="ps-drawer__close"><i class="icon icon-cross"></i></button>
    </div>
    <div class="ps-drawer__content">
        <ul class="menu mainmenu">
            <li><a class="active" href="{{route('customer')}}"><i class="icon-home"></i>Dashboard</a></li>
     




        <li>                         
            <label for="products"><i class="icon-database"></i>Product Add</label>                   
            <input type="checkbox" id="products">
             <ul class="submenu">
                 <li><a href="{{ route('customer.product','demo') }}">Sell Digital Products</a></li>
                @foreach ($category as $item) 
                <li><a href="{{ route('customer.product',$item->form_name) }}">{{ $item->name }}</a></li>
                @endforeach

             </ul>    
        </li>
   



        <li><a href="{{ route('customer.referral_link') }}"><i class="icon-percent-circle"></i>Referral Link</a></li>
        
            <li><a href="{{ route('customer.sell_orders') }}"><i class="icon-bag2"></i>Sell Orders</a></li>
            <li><a href="{{ route('customer.buy_orders') }}"><i class="icon-bag2"></i>Buy Orders</a></li>

            <li><a href="{{ route('balance_withdraw') }}"><i class="icon-database"></i>Balance/Withdraw</a></li>
     
            <li><a href="{{ route('customer.myprofile') }}"><i class="icon-users2"></i>Profile Setting</a></li>
           
            <li><a href="customers.html"><i class="icon-users2"></i>Promotional materials</a></li>
         
            <li><a href="{{ route('tutorial') }}"><i class="icon-database"></i>Unistag Tutorial</a></li>
                        
            <li><a href="{{ route('apps') }}"><i class="icon-database"></i>Apps</a></li>
        </ul>
    </div>
</aside>
<div class="ps-site-overlay"></div>
<main class="ps-main">
    <div class="ps-main__sidebar">
        <div class="ps-sidebar">
            <div class="ps-sidebar__top">
                <div class="ps-block--user-wellcome">
                    <div class="ps-block__left"><img src="{{asset('back_end/img/user/admin.jpg')}}" alt="" /></div>
                    <div class="ps-block__right">
                        <p>Hello,<a href="{{ route('customer.myprofile') }}">{{Auth::user()->name}}</a></p>
                    </div>
                    <div class="ps-block__action"><a href="#"><i class="icon-exit"></i></a></div>
                </div>
                <div class="ps-block--earning-count"><small>Balance</small>
                    <h4 id="total_balance"></h4>
                    <small>Panding Balance</small>
                    <h4 id="pending_balance"></h4>

                </div>
                
            </div>
            <div class="ps-sidebar__content">
                <div class="ps-sidebar__center">
                    <ul class="menu " >
                        <li><a class="active" href="{{route('customer')}}"><i class="icon-home"></i>Dashboard</a></li>
                 

                        

                        <li><a href="{{ route('customer.product','demo') }}"><i class="icon-database"></i>Sell Digital Products</a></li>

                        @foreach ($category as $item) 
                        <li><a href="{{ route('customer.product',$item->form_name) }}"><i class="icon-users2"></i>{{ $item->name }}</a></li>
                        @endforeach

                     

                    <li><a href="{{ route('customer.referral_link') }}"><i class="icon-percent-circle"></i>Referral Link</a></li>
                        <li><a href="{{ route('customer.sell_orders') }}"><i class="icon-bag2"></i>Sell Orders</a></li>
                        <li><a href="{{ route('customer.buy_orders') }}"><i class="icon-bag2"></i>Buy Orders</a></li>
                        <li><a href="customers.html"><i class="icon-users2"></i>Promotional materials</a></li>
                        
                        <li><a href="{{ route('balance_withdraw') }}"><i class="icon-database"></i>Balance/Withdraw</a></li>

                        <li><a href="{{ route('tutorial') }}"><i class="icon-database"></i>Unistag Tutorial</a></li>

                        <li><a href="{{ route('apps') }}"><i class="icon-database"></i>Apps</a></li>
                     
                     
                    </ul>

 
   
  
                </div>

                <div class="ps-sidebar__footer">
                    <div class="ps-copyright"><img src="img/logo.png" alt="">
                        <p>&copy;2020 <a href="www.codewin.com"><b>Codewin</b></a>. <br/> All rights reversed.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>  
        $(document).ready(function(){
balance();
function balance()
{
  $.ajax({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
   url:"{{ route('total_balance') }}",
   method:"POST",
   dataType:"json",
   success:function(data)
   {
    // $('#cart_details').html(data.cart_details);
    $('#total_balance').html(data.total);

  $('#pending_balance').html(data.pending);

  

    // console.log(data.pending)
   }
  });
}

             });




</script>

