@extends('admin.dashboard')
@section('maincontent')
<section class="ps-dashboard ps-items-listing">

    <div class="ps-section__left " style="max-width: 100%;    max-width: 100%;
    border: 1px solid #80bc00;
    border-style: ridge;
    padding: 8px 10px;
    margin:5px 10px;">

   <section class="ps-card">
            <div class="ps-card__header">
                <h4 style="text-align: center">Product Details</h4>
            </div>
            <div class="ps-card__content" >
                <form class="ps-form--account-settings"  >
                    @csrf


@if($form_name=='social_media')
   <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label style="margin-right:10px"><b> Category Name :</b> {{ $data->category_info->name }}</label>  
                               
                                <label style="margin-right:10px"><b> Subcategory Name :</b> {{ $data->subcategory_info->name }}</label>   
                                <label ><b> Price :</b> {{ $data->price }} {{ $data->user_info->currency }}</label>                 
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label style="margin-right:10px"><b> Friends :</b> {{ $data->friends }}</label>  
                               
                                <label style="margin-right:10px"><b> Followers :</b> {{$data->followers }}</label>   
                                              
                            </div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="form-group">
                                <label ><b> Product Name :</b> {{ $data->social_name }}</label>  <br>
                                <label><b>Social Link : </b> <a href="{{ $data->social_link }}">Go to Link</a></label>
                                <input class="form-control" name="phone" value="{{ $data->social_link }}" type="text" placeholder="" />

                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label><b>Details:</b> </label>
                                <textarea class="form-control" required rows="6" name="description">{{ $data->description }} </textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">

                                <img class="col-6" style="float:left"src="{{ asset('back_end/social_images') }}/{{ $data->image }}"> 
                                <img class="col-6" src="{{ asset('back_end/subcategory_images') }}/{{ $data->subcategory_info->image }}"> 
                            </div>
                        </div>

                    </div>

@elseif($form_name=='influence_marketing')
   <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label style="margin-right:10px"><b> Category Name :</b> {{ $data->category_info->name }}</label>  
                               
                                <label style="margin-right:10px"><b> Subcategory Name :</b> {{ $data->subcategory_info->name }}</label>   
                                <label ><b> Price :</b> {{ $data->price }} {{ $data->user_info->currency }}</label>                 
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label style="margin-right:10px"><b> Hiring Time :</b> {{ $data->hiring_time }}</label>  
                               
                                <label style="margin-right:10px"><b> Last Engagement :</b> {{$data->last_engagement }}</label>   
                                <label style="margin-right:10px"><b> Social Type :</b> {{$data->social_type }}</label>   
                                <label ><b> Country:</b> {{$data->country }}</label>   
                                              
                            </div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="form-group">
                                <label ><b> Product Name :</b> {{ $data->social_name }}</label>  <br>
                                <label><b>Social Link : </b> <a href="{{ $data->social_link }}">Go to Link</a></label>
                                <input class="form-control" name="phone" value="{{ $data->social_link }}" type="text" placeholder="" />

                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label><b>Details:</b> </label>
                                <textarea class="form-control" required rows="6" name="description">{{ $data->description }} </textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">

                            
                                <img class="col-7" src="{{ asset('back_end/subcategory_images') }}/{{ $data->subcategory_info->image }}"> 
                            </div>
                        </div>

                    </div>
      @elseif($form_name=='make_payment')
                     <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label style="margin-right:10px"><b> Category Name :</b> {{ $data->category_info->name }}</label>  
                               
                                <label style="margin-right:10px"><b> Subcategory Name :</b> {{ $data->subcategory_info->name }}</label>   
                                <label ><b> Per Unit Price :</b> {{ $data->unit_price }} {{ $data->user_info->currency }}</label>                 
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label style="margin-right:10px"><b> Send Currency :</b> {{ $data->send_currency }}</label>  
                               
                                <label style="margin-right:10px"><b> Send Amount :</b> {{$data->send_amount }} {{ $data->send_currency }}</label>   
                                <label style="margin-right:10px"><b> Send Wallet :</b> {{$data->send_wallet }}</label>   
                                <br>             
                                <label style="margin-right:10px"><b> Send Account :</b> {{$data->send_account }}</label>                
                          
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label style="margin-right:10px"><b> Get Currency :</b> {{ $data->get_currency }}</label>  
                               
                                <label style="margin-right:10px"><b> Get Amount :</b> {{$data->get_amount }}</label>   
                                <label style="margin-right:10px"><b> Get Wallet :</b> {{$data->get_wallet }}</label>    
                                <br>            
                                <label style=""><b> Get Account :</b> {{$data->get_account }}</label>                
                          
                            </div>
                        </div>
                     
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label><b>Details:</b> </label>
                                <textarea class="form-control" required rows="6" name="description">{{ $data->description }} </textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">

                            
                                <img class="col-7" src="{{ asset('back_end/subcategory_images') }}/{{ $data->subcategory_info->image }}"> 
                            </div>
                        </div>

                    </div>
           @elseif($form_name=='digital_wallet')
                     <div class="row">

                       <div class="col-sm-12">
                           <div class="form-group">
                               <label style="margin-right:10px"><b> Category Name :</b> {{ $data->category_info->name }}</label>  
                              
                               <label style="margin-right:10px"><b> Subcategory Name :</b> {{ $data->subcategory_info->name }}</label>   
                               <label ><b> Sell Price :</b> {{ $data->price }} {{ $data->user_info->currency }}</label>                 
                           </div>
                       </div>
                       <div class="col-sm-12">
                           <div class="form-group">
                               <label style="margin-right:10px"><b> Account Name :</b> {{ $data->account_name }}</label>  
                              <br>
                               <label style="margin-right:10px"><b> Opening Year:</b> {{$data->send_amount }} {{ $data->opening_year }}</label>   
                               <label style="margin-right:10px"><b> Verified :</b> {{($data->is_verified=='1') ?'Verified':'Unverified'}}</label>   
                               <label style="margin-right:10px"><b> Stock Balance :</b> {{ $data->balance }} {{ $data->account_currency }}</label>  
                               
                           </div>
                       </div>
                      
                       <div class="col-sm-12">
                           <div class="form-group">
                               <label><b>Details:</b> </label>
                               <textarea class="form-control" required rows="6" name="description">{{ $data->description }} </textarea>
                           </div>
                       </div>
                       <div class="col-sm-12">
                           <div class="form-group">

                           
                               <img class="col-7" src="{{ asset('back_end/subcategory_images') }}/{{ $data->subcategory_info->image }}"> 
                           </div>
                       </div>

                   </div>
                   @elseif($form_name=='advertisement_account')
                   <div class="row">
                      <div class="col-sm-12">
                          <div class="form-group">
                              <label style="margin-right:10px"><b> Category Name :</b> {{ $data->category_info->name }}</label>  
                             
                              <label style="margin-right:10px"><b> Subcategory Name :</b> {{ $data->subcategory_info->name }}</label>   
                              <label ><b> Sell Price :</b> {{ $data->price }} {{ $data->user_info->currency }}</label>                 
                          </div>
                      </div>
                      <div class="col-sm-12">
                          <div class="form-group">
                              <label style="margin-right:10px"><b> Account Name :</b> {{ $data->account_name }}</label>  
                             <br>
                              <label style="margin-right:10px"><b> Opening Year:</b> {{$data->send_amount }} {{ $data->opening_year }}</label>   
                              <label style="margin-right:10px"><b> Verified :</b> {{($data->is_verified=='1') ?'Verified':'Unverified'}}</label>   
                              <label style="margin-right:10px"><b> Stock Balance :</b> {{ $data->balance }} {{ $data->account_currency }}</label>  
                              
                          </div>
                      </div>
                     
                      <div class="col-sm-12">
                          <div class="form-group">
                              <label><b>Details:</b> </label>
                              <textarea class="form-control" required rows="6" name="description">{{ $data->description }} </textarea>
                          </div>
                      </div>
                      <div class="col-sm-12">
                          <div class="form-group">

                          
                              <img class="col-7" src="{{ asset('back_end/subcategory_images') }}/{{ $data->subcategory_info->image }}"> 
                          </div>
                      </div>

                  </div>
                  @elseif($form_name=='gift_card')
                  <div class="row">
                     <div class="col-sm-12">
                         <div class="form-group">
                             <label style="margin-right:10px"><b> Category Name :</b> {{ $data->category_info->name }}</label>  
                            
                             <label style="margin-right:10px"><b> Subcategory Name :</b> {{ $data->subcategory_info->name }}</label>   
                                        
                         </div>
                     </div>
                     <div class="col-sm-12">
                         <div class="form-group">
                             <label style="margin-right:10px"><b>Card Name :</b> {{ $data->name }}</label>  
                            <br>
                            
                             <label style="margin-right:10px"><b> Stock Card :</b>  {{ $data->qty }}</label>  
                             <label ><b> Per Unit Price :</b> {{ $data->price }} {{ $data->user_info->currency }}</label>     
                         </div>
                     </div>
                    
                     <div class="col-sm-12">
                         <div class="form-group">
                             <label><b>Details:</b> </label>
                             <textarea class="form-control" required rows="6" name="description">{{ $data->description }} </textarea>
                         </div>
                     </div>
                     <div class="col-sm-12">
                         <div class="form-group">

                         
                             <img class="col-7" src="{{ asset('back_end/subcategory_images') }}/{{ $data->subcategory_info->image }}"> 
                         </div>
                     </div>

                 </div>
                 @elseif($form_name=='subscription')
                 <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label style="margin-right:10px"><b> Category Name :</b> {{ $data->category_info->name }}</label>  
                           
                            <label style="margin-right:10px"><b> Subcategory Name :</b> {{ $data->subcategory_info->name }}</label>   
                                       
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label style="margin-right:10px"><b>Subscription Name :</b> {{ $data->name }}</label>  
                           <br>
                           
                            <label style="margin-right:10px"><b> Stock In :</b> {{ $data->qty }}</label>  
                            <label ><b> Per Unit Price :</b> {{ $data->price }} {{ $data->user_info->currency }}</label>     
                        </div>
                    </div>
                   
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label><b>Details:</b> </label>
                            <textarea class="form-control" required rows="6" name="description">{{ $data->description }} </textarea>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">

                        
                            <img class="col-7" src="{{ asset('back_end/subcategory_images') }}/{{ $data->subcategory_info->image }}"> 
                        </div>
                    </div>

                </div>
                @elseif($form_name=='social_media_promotion')
                <div class="row">
                   <div class="col-sm-12">
                       <div class="form-group">
                           <label style="margin-right:10px"><b> Category Name :</b> {{ $data->category_info->name }}</label>  
                          
                           <label style="margin-right:10px"><b> Subcategory Name :</b> {{ $data->subcategory_info->name }}</label>   
                                      
                       </div>
                   </div>
                   <div class="col-sm-12">
                       <div class="form-group">
                           <label style="margin-right:10px"><b>Product Name :</b> {{ $data->product_name }}</label>  
                          <br>
                          <label style="margin-right:10px"><b>Each Package :</b> {{ $data->follower_subscriber }}</label>  

                          <label  style="margin-right:10px"><b> Each Package Price :</b> {{ $data->unit_price }} {{ $data->user_info->currency }}</label>     
                          <label><b> Total package :</b> {{ $data->total_follower_subscriber }} </label>  
                         
                           <br>
                           <label style="margin-right:10px"><b>Follower/Subscriber :</b> {{ $data->follower_subscriber }} </label>  

                           <label style="margin-right:10px"><b> Total Follower/Subscriber :</b> {{ $data->total_follower_subscriber }} </label>  
                       </div>
                   </div>
                  
                   <div class="col-sm-12">
                       <div class="form-group">
                           <label><b>Details:</b> </label>
                           <textarea class="form-control" required rows="6" name="description">{{ $data->description }} </textarea>
                       </div>
                   </div>
                   <div class="col-sm-12">
                       <div class="form-group">

                       
                           <img class="col-7" src="{{ asset('back_end/subcategory_images') }}/{{ $data->subcategory_info->image }}"> 
                       </div>
                   </div>

               </div>
               @elseif($form_name=='top_up_apps')
               <div class="row">
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label style="margin-right:10px"><b> Category Name :</b> {{ $data->category_info->name }}</label>  
                         
                          <label style="margin-right:10px"><b> Subcategory Name :</b> {{ $data->subcategory_info->name }}</label>   
                                     
                      </div>
                  </div>
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label style="margin-right:10px"><b>Product Name :</b> {{ $data->product_name }}</label>  
                         <br>
                         <label style="margin-right:10px"><b>Each Package :</b> {{ $data->top_up }}</label>  

                         <label  style="margin-right:10px"><b> Each Package Price :</b> {{ $data->unit_price }} {{ $data->user_info->currency }}</label>     
                         <label><b> Total package :</b> {{ $data->total_top_up }} </label>  
                        
                          <br>
                          <label style="margin-right:10px"><b>Top up :</b> {{ $data->top_up }} </label>  

                          <label style="margin-right:10px"><b> Total Top up :</b> {{ $data->total_top_up }} </label>  
                      </div>
                  </div>
                 
                  <div class="col-sm-12">
                      <div class="form-group">
                          <label><b>Details:</b> </label>
                          <textarea class="form-control" required rows="6" name="description">{{ $data->description }} </textarea>
                      </div>
                  </div>
                  <div class="col-sm-12">
                      <div class="form-group">

                      
                          <img class="col-7" src="{{ asset('back_end/subcategory_images') }}/{{ $data->subcategory_info->image }}"> 
                      </div>
                  </div>

              </div>
              @elseif($form_name=='games_zone')
              <div class="row">
                 <div class="col-sm-12">
                     <div class="form-group">
                         <label style="margin-right:10px"><b> Category Name :</b> {{ $data->category_info->name }}</label>  
                        
                         <label style="margin-right:10px"><b> Subcategory Name :</b> {{ $data->subcategory_info->name }}</label>   
                                    
                     </div>
                 </div>
                 <div class="col-sm-12">
                     <div class="form-group">
                         <label style="margin-right:10px"><b>Product Name :</b> {{ $data->product_name }}</label>  
                        <br>
                        <label style="margin-right:10px"><b>Each Package :</b> {{ $data->diamonds }}</label>  

                        <label  style="margin-right:10px"><b> Each Package Price :</b> {{ $data->unit_price }} {{ $data->user_info->currency }}</label>     
                        <label><b> Total package :</b> {{ $data->total_diamonds }} </label>  
                       
                         <br>
                         <label style="margin-right:10px"><b>Diamonds :</b> {{ $data->diamonds }} </label>  

                         <label style="margin-right:10px"><b> Total Diamonds :</b> {{ $data->total_diamonds }} </label>  
                     </div>
                 </div>
                
                 <div class="col-sm-12">
                     <div class="form-group">
                         <label><b>Details:</b> </label>
                         <textarea class="form-control" required rows="6" name="description">{{ $data->description }} </textarea>
                     </div>
                 </div>
                 <div class="col-sm-12">
                     <div class="form-group">

                     
                         <img class="col-7" src="{{ asset('back_end/subcategory_images') }}/{{ $data->subcategory_info->image }}"> 
                     </div>
                 </div>

             </div>
@endif

                 



                </form>
            </div>
        </section>


    </div>
    <div class="ps-section__right" style="max-width: 100%;    max-width: 100%;
             border: 1px solid #80bc00;
             border-style: ridge;
             padding: 40px 0px;
             margin:5px 10px" id="product">
 
            <section class="ps-card">
                <div class="ps-card__header">
                <h4 style="text-align: center">User Information</h4>
            </div>
                <div class="ps-sidebar__center ">
                    <img style="width: 150px;height: 150px; margin-bottom:20px;"
                    class="center img-fluid" src="{{asset('profile_image')}}/{{ $data->user_info->image }}"
                alt="">
                </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-md-4 offset-md-4">
                                    <div class=" form-group">
                                        <span class="profile_text" ><b>Full Name : </b>{{ $data->user_info->name }}</span>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
        
                        <div class="col-sm-4 offset-sm-4">
                            <div class=" form-group">
                                <span class="profile_text" ><b>Email : </b>{{ $data->user_info->email }}</span>
                            </div>
                        </div>
        
                        <div class=" col-sm-4 offset-sm-4">
                            <div class=" form-group">
                                <span class="profile_text" ><b>Phone : </b>{{ $data->user_info->phone }}</span>
                            </div>
                        </div>
                        <div class=" col-sm-4 offset-sm-4">
                            <div class=" form-group">
                                <span class="profile_text" ><b>Country : </b>{{ $data->user_info->country }}</span>
                            </div>
                        </div>
        
                        <div class=" col-sm-4 offset-sm-4">
                            <div class=" form-group">
                                <span class="profile_text" ><b>Address : </b>{{ $data->user_info->address }}</span>
                            </div>
                        </div>
        
                        <div class="col-sm-12">
                        <div  class="ps-form__submit text-center ">
                          
        
                           
                                  @if($data->status==1)
                                  <button class=" ps-btn success">
                                    {{-- <a style="color:white" href="{{ route('admin.status',[$data->id,$data->status,$form_name])  }}">Active</a> --}}
                                    <a style="color:white">Active</a>
    
                                    </button> 
                                    <button class=" ps-btn " style="background: #8a00fb" >
                                        <a style="color:white" href="{{ route('admin.status',[$data->id,8,$form_name])  }}">Temporarily Off</a>
                                    </button>
                                      
                                    @else 
                                    @if($data->status==8)
                                    <button class=" ps-btn " style="background: #8a00fb" >
                                     <a style="color:white" href="{{ route('admin.status',[$data->id,0,$form_name])  }}">Active Now</a>
                                   </button>
                                   @else
                                      <button class=" ps-btn " style="background: #8a00fb" >
                                        <a style="color:white" href="{{ route('admin.status',[$data->id,$data->status,$form_name])  }}">Active Now</a>
                                      </button>

                                      @endif
                                     
                                     @if($data->status==9)
                                    {{-- <a style="color:white" href="{{ route('admin.product.decline',[$data->id,$form_name]) }}">Decline</a> --}}
                                    <button class=" ps-btn " style="background: #fcb800">       
                                    <a style="color:white" id="hide" >Rejected</a>
                                   </button>           


                                     @else
                                    <button class=" ps-btn ">
                                   <a  style="cursor: pointer;color:white"   data-toggle="modal"  data-target="#loginModal">Reject</a>
                                    </button>           

                                     @endif
                   

                                    @endif
                                </button>


                                <button class=" ps-btn black" style="background-color:#3d56c5"><a style="color:white" href="{{ route('product_permission',[$form_name]) }}">Back</a></button>
                         


                

                        </div>
                        </div>
           
        
                    </div>
                    </section>
    </div>






    <div class="ps-section__right" style="max-width: 100%;    max-width: 100%;
              border: 1px solid #80bc00;
              border-style: ridge;
              padding: 40px 0px;
              margin:5px 10px;display:none" id="reject"

              >

        <section class="ps-card">
             <div class="ps-card__header">
              <h4 style="text-align: center">Reject Message</h4>
             </div>
      
           <div class="row">
             
            <div class="col-sm-12" style="height:551px;overflow: scroll;">
                <div class="form-group">
             @foreach($message as $msg)
                @if($msg->send_user=="Admin")
                    <label style="margin-right:10px"><b>Admin </b> </label> <p style="background: lightblue">   {{ $msg->message }} </p>
                    <br>         
                    @else
              
                    <label style="margin-right:10px;float:right"> <b>{{ $data->user_info->name }}</b> 
                       </label> <br>
                    <p style="background: rgb(238, 218, 240)">    {{ $msg->message }} </p><br>
                    @endif
                   @endforeach 
                </div>
            </div>
            
         <hr>
           
               <div class="col-sm-12">
               <div  class="ps-form__submit text-center ">
                 

                  
                    
                    
                       @if($data->status==1)

                        <button class=" ps-btn " style="background: #8a00fb" >
                           <a style="color:white" href="{{ route('admin.status',[$data->id,$data->status,$form_name])  }}">Inactive</a>
                         </button>

                           @elseif($data->status==8)
                           <button class=" ps-btn " style="background: #8a00fb" >
                            <a style="color:white" href="{{ route('admin.status',[$data->id,0,$form_name])  }}">Inactive</a>
                          </button>
 
                           @else 
                           <button class=" ps-btn " style="background: #8a00fb" >
                            <a style="color:white" href="{{ route('admin.status',[$data->id,$data->status,$form_name])  }}">Inactive</a>
                          </button>
                          @if($data->status==9)
                           {{-- <a style="color:white" href="{{ route('admin.product.decline',[$data->id,$form_name]) }}">Decline</a> --}}
                           <button class=" ps-btn " style="background: #fcb800">       
                           <a style="color:white" id="show" >User</a>
                          </button>           


                            @else
                            <button class=" ps-btn ">
                            <a 
                             style="cursor: pointer;color:white" 
                             data-toggle="modal" 
                              data-target="#loginModal">Decline</a>
                              </button>           

                         @endif
          

                           @endif
                       </button>
                       <button class=" ps-btn ">
                        <a 
                         style="cursor: pointer;color:white" 
                         data-toggle="modal" 
                          data-target="#loginModal">message</a>
                          </button>           



                

               </div>
               </div>
  

           </div>
           </section>
</div>


</section>


<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin-top: 183px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModal" style="text-align: center;margin: 2px 50% 2px 50%;">{{ __('Reject Cases') }}</h5>
            
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form method="POST" action="{{ route('reject_message') }}">
              
                    @csrf
  
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Message') }}</label>
  
                        <div class="col-md-6">
                           <textarea class="form-control" type="text" name="message"> </textarea>
                           <input type="hidden" name="product_id" value="{{ $data->id }}"/>
                           <input type="hidden" name="post_id" value="{{ $data->post_id }}"/>
                           <input type="hidden" name="form_name" value="{{ $data->category_info->form_name }}"/>

                        
                        </div>
                    </div>
  
               
               
                    <div class="form-group row mb-0">

                        <div class="col-md-8 offset-md-4">
                            <div class="form-group submit">
                                <button class="ps-btn ps-btn">Reject</button>
                              </div>
                         
                           
                               
                            
                        </div>
                        

                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
  
@if(session('errors'))
<script>
$(function() {
    $('#loginModal').modal({
        show: true,
        
    });
});
</script>
@endif

<script>
    $(document).ready(function(){
      $("#hide").click(function(){
        $("#product").hide();
        $("#reject").show();
        $("#reject").css('display','block');

       
      });
      $("#show").click(function(){
        $("#product").show();
        $("#reject").hide();
        $("#reject").css('display','none');

      });
    });
    </script>

@endsection