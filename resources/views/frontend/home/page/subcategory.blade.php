@extends('frontend.home.master')
@section('maincontent')

<div class="ps-page--product reverse" >
  <div class="container" >
    <div class="ps-section--default ps-customer-bought">
      <div class="ps-section__header">
        <h3>Subcategories</h3>
        
      </div>
      <div class="ps-section__content">
        <div class="row">
          
          
          @foreach($data as $v_item) 
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 " style="background:white;border: 5px solid rgba(0, 0, 0, .05) !important;">
            <div class="ps-product">
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
@endsection