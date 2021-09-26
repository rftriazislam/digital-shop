@extends('customer.dashboard')
@section('title')
    Unistag Digital || Delivery Confirm
@endsection
@section('maincontent')

<section class="ps-dashboard ps-items-listing">

   

    <div class="ps-section__right " style="max-width: 100%;    max-width: 100%;
    border: 1px solid #80bc00;
    border-style: ridge;
    padding: 10px 10px;
    margin:5px 10px;">

   <section class="ps-card">
            <div class="ps-card__header">
                <h4>Checking </h4>
            </div>


            <div class=" col-sm-12 ">
            
            </div>

            <div class="ps-card__content">




               
                    <div class="row">
  
                        <div class="col-sm-12">
                            <div class="form-group">

                               <label><b> Product Name :</b>  {{ $sell_order->product_name }}</label>
                         
                            </div>
                        </div>


                        <div class="col-sm-12">
                            <div class="form-group">

                                <img class="col-4" style="float:left"src="{{ asset('back_end/document_images') }}/{{ $sell_order->document_image }}"> 
                                  @if($sell_order->image2)
                                <img class="col-4"style="float:left" src="{{ asset('back_end/document_images') }}/{{ $sell_order->image2 }}"> 
                                 @endif
                               @if($sell_order->image3)
                            <img class="col-4" src="{{ asset('back_end/document_images') }}/{{ $sell_order->image3 }}"> 
                                @endif
                            </div>
                        </div>



                        <div class="col-sm-12">
                            <div class="form-group">






<br>

@if($form_name=='social_media')

                                <label style="color:red">Please Check Your Mail </label>
                                <label>If you get all the information of product truly then comfirm others Report</label>
                               
@elseif($form_name=='make_payment')
<label>Please Check Your Balance </label>
<label>If you  get money in your account then comfirm others Report</label>

@elseif($form_name=='influence_marketing')
<label>Please Check Your Mail </label>

@else 
<label>Please Check Your Mail </label>

@endif
                            </div>
                        </div>
                       
                        
                    </div>
                      
                 </section>
  
                      <div class="btn-group">



                        <form action="{{ route('customer.buyer_comfirm') }}" method="post">
                            @csrf                                                                                                                                                                                   
                                                    <input type="hidden" name="form_name" value=" {{ $form_name }}"/>
                                                    <input  type="hidden" name="pdo" value=" {{$order_id }}" />
                                                    <input  type="hidden" name="message" value="true" />
                                                    
                                                     
                                                                                                 
                                <button type="submit"class="btn "  style="background: #673ab7;color:white;width:150px;font-size:15px">Comfirm</button>
                       
                        </form>

                        <form action="{{ route('customer.buyer_comfirm') }}" method="post">
                            @csrf                                                                                                                                                                                   
                                                    <input type="hidden" name="form_name" value=" {{ $form_name }}"/>
                                                    <input  type="hidden" name="pdo" value=" {{$order_id }}" />
                                                    <input  type="hidden" name="message" value="false" />
                                                    
                                                     
                                                                                                 
                                <button type="submit"class="btn "  style="background: #e70410;color:white;width:150px;font-size:15px">Report</button>
                       
                        </form>

                         
                             </strong>
                              
                              </div>
                         </div>
    </div>
    
</section>

@endsection