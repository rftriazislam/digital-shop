@php( $category = \App\Category:: where('status',1)->get() )
<footer class="ps-footer" style="background: white;">
    <div class="contasiner">
      <div class="ps-footer__links" style="background: #f1f1f1">
        <div class="container"> 
      
        @foreach ($category as $v_category)
            
  
        <p >
          <strong style="color:#f26437">{{ $v_category->name }} </strong> 
               @foreach ($v_category->subcategory as $v_subcategory)
              <a href="{{ route('singlesubcategory',[$v_subcategory->id,$v_subcategory->category_info->form_name]) }}" style="color:rgb(0, 0, 0)">
                {{ $v_subcategory->name }}</a>
               @endforeach
        </p>
        
       
         @endforeach
      </div>    
        </div>
         <div class="container"> 
      <div class="ps-footer__widgets">
       
        <aside class="widget widget_footer ">
          <h4 class="widget-title" style="color:white">Contact us</h4>
          <div class="widget_content">
            <p>Call us 24/7</p>
            <h3 style="color:#f26437">+8801716967050</h3>
            <p >Head Office & Marketing Office: House # 49,<br> Road # 12, Sector # 11 Uttara - 1230, Dhaka, Bangladesh<br><a href="mailto:info@unistag.com">info@unistag.com</a></p>
            <ul class="ps-list--social">
              <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a class="google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
              <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
            </ul>
          </div>
        </aside>
        <aside class="widget widget_footer widget_contact-us">
          
         
          <div class="widget_content">
            <a  href="https://play.google.com/store/apps/details?id=com.codewin.unistag_digital"> 
         <img src="{{ asset('front_end/logo/paystore.png') }}" style="width:134px "> 
            </a>
            <ul class="ps-list--social">
              <li> <img src="{{ asset('front_end/logo/paypal1.png') }}" style="width:134px "></li>
              <li> <img src="{{ asset('front_end/logo/shurjopay.jpg') }}" style="width:134px "></li>

              
            </ul>
          </div>
        </aside>
        <aside class="widget widget_footer">
          
          <h4 class="widget-title" >Quick links</h4>
          <ul class="ps-list--link">
            <li><a href="{{ route('privacy_policy') }}" >Privacy Policy</a></li>
            <li><a href="{{ route('terms_conditions') }}" >Term & Condition</a></li>
            <li><a href="#" >Shipping</a></li>
            <li><a href="#" >Return</a></li>
            <li><a href="faqs.html" >FAQs</a></li>
          </ul>
        </aside>
        <aside class="widget widget_footer">
          <h4 class="widget-title">Company</h4>
          <ul class="ps-list--link">
            <li><a href="about-us.html">About Us</a></li>
            <li><a href="#">Affilate</a></li>
            <li><a href="#">Career</a></li>
            <li><a href="contact-us.html">Contact</a></li>
          </ul>
        </aside>
     
      </div>
    </div>
    <div style="background: #0b415e"> 


            <div class="container">
      <div class="ps-footer__copyright">

        <p style="color:white">© 2020 <a href="www.codewin.xyz" ><b style="color:white">Codewin</b></a>. All Rights Reserved</p>
        <p>Developed by<a href="www.codewin.xyz"><b>Md Riazul Islam </b></a></p>
        {{-- <p><span>We Using Safe Payment For:</span>
            <a href="#"><img src="{{ asset('payment/paypel.png') }}" alt="" style="height:80px;width:80px"></a>
            <a href="#"><img src="{{ asset('payment/visa1_.jpg') }}" alt=""style="height:80px;width:80px"></a>
            <a href="#"><img src="{{ asset('payment/paypel.png') }}" alt=""style="height:80px;width:80px"></a>
            <a href="#"><img src="{{ asset('payment/visa2.jpg') }}" alt=""style="height:80px;width:80px"></a>
            <a href="#"><img src="{{ asset('payment/paypel.png') }}" alt=""style="height:80px;width:80px"></a>
        </p> --}}
      </div>
    </div> 
      </div>
  </div>
  </footer>