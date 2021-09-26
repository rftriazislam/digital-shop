@extends('admin.dashboard')
@section('maincontent')
<section class="ps-items-listing">
    <h2 style="text-align-last: center">Product Permission</h2>
    <hr>
    <div style="text-align:center"> 

    @foreach($category as $v_cat)
    <div class="ps-section__atctions" style="float: left;margin-right:2px;margin-top:2px;"><a class="ps-btn success" href="{{ route('product_permission',[$v_cat->form_name]) }}">{{ $v_cat->name }}</a></div>
   @endforeach
  
     

     <div class="ps-section__header"></div>
   
    </div>
   
  <br>
  <div class="ps-section__content">
    <div class="table-responsive">
   @if($form_code=='null')
  
   @elseif($form_code=="social_media")
   <h2 style="text-align:center ">Social Media</h2>
   <div class="ps-section__content">
       <div class="table-responsive">
           <table class="table ps-table">
               <thead>
                   <tr>
                       <th >ID</th>
                       <th >Category</th>
                       <th >Subcategory</th>
                       <th >Social Name</th>
                       <th >Friends</th>
                       <th >Followers</th>
                       <th >Price</th>
                       <th >Image</th>
                       <th >status</th>


                   </tr>
               </thead>
               <tbody>
                   @foreach ($data as $item)
                       
                
                   <tr>
                       <td>{{ $item->id }}</td>
                       <td>{{ $item->category_info->name }}</td>
                       <td>{{ $item->subcategory_info->name }}</td>
                       <td><span class="ps-badge success">{{ $item->social_name }}</span>
                       </td>
                     
                       <td>
                           {{ $item->friends }}
                       </td> 
                       <td>
                           {{ $item->followers }}
                       </td> 
                       <td>
                           <strong>{{ $item->price }} <b style="color:red"> {{ $item->user_info->currency }}</b></strong>
                       </td>
                       <td>
                         <img src="{{ asset('back_end/social_images') }}/{{ $item->image }}" alt="" style="height:50px;width:70px;">
                       </td>
                      
                    
                       <td> <div class="btn-group">
                        @if($item->status=='1')
                    
                       {{-- <button type="button" class="btn btn-success"><a href="{{ route('admin.status',[$item->id,$item->status,$form_code])  }}">Active</a>
                            </button> --}}

                            <button type="button" class="btn btn-success"><a >Active</a>
                            </button>
                        @else
                        <button type="button" class="btn "  style="background: #673ab7;color:white"><a href="{{ route('admin.status',[$item->id,$item->status,$form_code])  }}" >Inactive</a>
                        </button>
                        @endif
                      
                          
                            <button type="button" class="btn btn-primary"><a href="{{ route('admin.product.view',[$item->id,$form_code]) }}">Views</a></button>
                         
                          </div>
                       </td>
                   </tr>
                  @endforeach
               </tbody>
           </table>
       </div>
{{ $data->links() }}

   </div>
  @elseif($form_code=="make_payment")
   <h2 style="text-align:center ">Make Payment</h2>
   <div class="ps-section__content">
       <div class="table-responsive">
           <table class="table ps-table">
               <thead>
                   <tr>
                       <th>ID</th>
                       <th>Category</th>
                       <th>Subcategory</th>
                      
                       <th>Send Amount</th>
                       <th>Send Wallet</th>
                     
                       <th>Get Currency</th>
                      
                       <th>Get Wallet</th>
                      
                       <th>Price</th>
                      
                       <th>Status</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($data as $item)
                       
                
                   <tr>
                       <td>{{ $item->id }}</td>
                       <td>{{ $item->category_info->name }}</td>
                       <td>{{ $item->subcategory_info->name }}</td>
                      
                       <td>
                           {{ $item->send_amount }} <b style="color:red"> {{ $item->send_currency }}</b>
                       </td> 
                       <td><span class="ps-badge success">{{ $item->send_wallet}}</span>
                       </td>
              
                       <td>
                           {{ $item->get_currency }}
                       </td> 
                   
                       <td>
                           <strong>{{ $item->get_wallet }}</strong>
                       </td>
                    
                       <td>
                           {{ $item->unit_price }} <b style="color:red"> {{ $item->user_info->currency }}</b>
                       </td> 
       
                       
                    
                       <td>
                        <div class="btn-group">
                            @if($item->status=='1')
                        
                           {{-- <button type="button" class="btn btn-success"><a href="{{ route('admin.status',[$item->id,$item->status,$form_code])  }}">Active</a>
                            </button> --}}

                            <button type="button" class="btn btn-success"><a >Active</a>
                            </button>
                            @else
                            <button type="button" class="btn "  style="background: #673ab7;color:white"><a href="{{ route('admin.status',[$item->id,$item->status,$form_code])  }}" >Inactive</a>
                            </button>
                            @endif
                          
                              
                                <button type="button" class="btn btn-primary"><a href="{{ route('admin.product.view',[$item->id,$form_code]) }}">Views</a></button>
                             
                              </div>
                           
                       </td>
                   </tr>
                  @endforeach
               </tbody>
           </table>
       </div>
       {{ $data->links() }}
   </div>
   @elseif($form_code=="influence_marketing")
   <h2 style="text-align:center ">Influence Marketing</h2>
   <div class="ps-section__content">
       <div class="table-responsive">
           <table class="table ps-table">
               <thead>
                   <tr>
                       <th>ID</th>
                       <th>Category</th>
                       <th>Subcategory</th>
                       <th>Social Name</th>
                    
                       <th>Last Engagement</th>
                     
                       <th>Price</th>
                     
                      
                       <th>status</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($data as $item)
                       
                
                   <tr>
                       <td>{{ $item->id }}</td>
                       <td>{{ $item->category_info->name }}</td>
                       <td>{{ $item->subcategory_info->name }}</td>
                       <td><span class="ps-badge success">{{ $item->social_name }}</span>
                       </td>
                    
                       <td>
                           {{ $item->last_engagement }}
                       </td> 
                    
                       <td>
                          {{ $item->price }} <b style="color:red"> {{ $item->user_info->currency }}</b>
                       </td>
                       
                      
                     
                       <td>  <div class="btn-group">
                        @if($item->status=='1')
                 {{-- <button type="button" class="btn btn-success"><a href="{{ route('admin.status',[$item->id,$item->status,$form_code])  }}">Active</a>
                            </button> --}}

                            <button type="button" class="btn btn-success"><a >Active</a>
                            </button>
                        @else
                        <button type="button" class="btn "  style="background: #673ab7;color:white"><a href="{{ route('admin.status',[$item->id,$item->status,$form_code])  }}" >Inactive</a>
                        </button>
                        @endif
                      
                          
                            <button type="button" class="btn btn-primary"><a href="{{ route('admin.product.view',[$item->id,$form_code]) }}">Views</a></button>
                         
                          </div>
                       </td>
                   </tr>
                  @endforeach
               </tbody>
           </table>
       </div>
       {{ $data->links() }}
   </div>
   @elseif($form_code=="gift_card")
   <h2 style="text-align:center ">Gift Card</h2>
   <div class="ps-section__content">
       <div class="table-responsive">
           <table class="table ps-table">
               <thead>
                   <tr>
                       <th>ID</th>
                       <th>Category</th>
                       <th>Subcategory</th>
                       <th>Name</th>
                       <th>Quantity</th>
                       <th>Price</th>
                      
                       <th>Status</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($data as $item)
                       
                
                   <tr>
                       <td>{{ $item->id }}</td>
                       <td>{{ $item->category_info->name }}</td>
                       <td>{{ $item->subcategory_info->name }}</td>
                       <td>
                           <strong>{{ $item->name }}</strong>
                       </td>
                       <td>
                           {{ $item->qty }}
                       </td> 
                      
                       <td>{{ $item->price }} <b style="color:red"> {{ $item->user_info->currency }}</b></td>
                     
       
                       
                    
                       <td>
                        <div class="btn-group">
                            @if($item->status=='1')
                        
                            {{-- <button type="button" class="btn btn-success"><a href="{{ route('admin.status',[$item->id,$item->status,$form_code])  }}">Active</a>
                            </button> --}}

                            <button type="button" class="btn btn-success"><a >Active</a>
                            </button>
                            @else
                            <button type="button" class="btn "  style="background: #673ab7;color:white"><a href="{{ route('admin.status',[$item->id,$item->status,$form_code])  }}" >Inactive</a>
                            </button>
                            @endif
                          
                              

                               
                                <button type="button" class="btn btn-primary"><a href="{{ route('admin.product.view',[$item->id,$form_code]) }}">Views</a></button>
                             
                              </div>
                           
                       </td>
                   </tr>
                  @endforeach
               </tbody>
           </table>
       </div>
       {{ $data->links() }}
   </div>
   @elseif($form_code=="subscription")
   <h2 style="text-align:center ">Subscription</h2>
   <div class="ps-section__content">
       <div class="table-responsive">
           <table class="table ps-table">
               <thead>
                   <tr>
                       <th>ID</th>
                       <th>Category</th>
                       <th>Subcategory</th>
                       <th>Name</th>
                       <th>Quantity</th>
                       <th>Price</th>
                      
                       <th>Status</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($data as $item)
                       
                
                   <tr>
                       <td>{{ $item->id }}</td>
                       <td>{{ $item->category_info->name }}</td>
                       <td>{{ $item->subcategory_info->name }}</td>
                       <td>
                           <strong>{{ $item->name }}</strong>
                       </td>
                       <td>
                           {{ $item->qty }}
                       </td> 
                      
                       <td>{{ $item->price }} <b style="color:red">{{ $item->user_info->currency }}</b></td>
                     
       
                       
                     
                       <td>
                        <div class="btn-group">
                            @if($item->status=='1')
                        
                         {{-- <button type="button" class="btn btn-success"><a href="{{ route('admin.status',[$item->id,$item->status,$form_code])  }}">Active</a>
                            </button> --}}

                            <button type="button" class="btn btn-success"><a >Active</a>
                            </button>
                            @else
                            <button type="button" class="btn "  style="background: #673ab7;color:white"><a href="{{ route('admin.status',[$item->id,$item->status,$form_code])  }}" >Inactive</a>
                            </button>
                            @endif
                          
                              
                                <button type="button" class="btn btn-primary"><a href="{{ route('admin.product.view',[$item->id,$form_code]) }}">Views</a></button>
                             
                              </div>
                       </td>
                   </tr>
                  @endforeach
               </tbody>
           </table>
       </div>
       {{ $data->links() }}
   </div>
   @elseif($form_code=="digital_wallet")
   <h2 style="text-align:center ">Digital Wallet</h2>
   <div class="ps-section__content">
       <div class="table-responsive">
           <table class="table ps-table">
               <thead>
                   <tr>
                       <th>ID</th>
                       <th>Category</th>
                       <th>Subcategory</th>
                       <th>Account Name</th>
                       <th>Country</th>
                       <th>Price</th>
                       <th>Opening Year</th>
                       <th>Status</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($data as $item)
                       
                
                   <tr>
                       <td>{{ $item->id }}</td>
                       <td>{{ $item->category_info->name }}</td>
                       <td>{{ $item->subcategory_info->name }}</td>
                       <td>
                           <strong>{{ $item->account_name }}</strong>
                       </td>
                       <td>
                           {{ $item->country }}
                       </td> 
                      
                       <td>{{ $item->price }} <b style="color:red"> {{ $item->user_info->currency }}</b></td>
                     
       
                       
                       <td><p>  {{ $item->opening_year }}</p></td>
                       <td>
                        <div class="btn-group">
                            @if($item->status=='1')
                        
                            {{-- <button type="button" class="btn btn-success"><a href="{{ route('admin.status',[$item->id,$item->status,$form_code])  }}">Active</a>
                            </button> --}}

                            <button type="button" class="btn btn-success"><a >Active</a>
                            </button>
                            @else
                            <button type="button" class="btn "  style="background: #673ab7;color:white"><a href="{{ route('admin.status',[$item->id,$item->status,$form_code])  }}" >Inactive</a>
                            </button>
                            @endif
                          
                              
                                <button type="button" class="btn btn-primary"><a href="{{ route('admin.product.view',[$item->id,$form_code]) }}">Views</a></button>
                             
                              </div>
                       </td>
                   </tr>
                  @endforeach
               </tbody>
           </table>
       </div>
       {{ $data->links() }}
   </div>
   @elseif($form_code=="advertisement_account")
   <h2 style="text-align:center ">Advertisement Account</h2>
   <div class="ps-section__content">
       <div class="table-responsive">
           <table class="table ps-table">
               <thead>
                   <tr>
                       <th>ID</th>
                       <th>Category</th>
                       <th>Subcategory</th>
                       <th>Account Name</th>
                       <th>Country</th>
                       <th>Price</th>
                       <th>Opening Year</th>
                       <th>Status</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($data as $item)
                       
                
                   <tr>
                       <td>{{ $item->id }}</td>
                       <td>{{ $item->category_info->name }}</td>
                       <td>{{ $item->subcategory_info->name }}</td>
                       <td>
                           <strong>{{ $item->account_name }}</strong>
                       </td>
                       <td>
                           {{ $item->country }}
                       </td> 
                      
                       <td>{{ $item->price }}<b style="color:red"> {{ $item->user_info->currency }}</b></td>
                     
       
                       
                       <td><p>  {{ $item->opening_year }}</p></td>
                       <td>
                        <div class="btn-group">
                            @if($item->status=='1')
                        
                         {{-- <button type="button" class="btn btn-success"><a href="{{ route('admin.status',[$item->id,$item->status,$form_code])  }}">Active</a>
                            </button> --}}

                            <button type="button" class="btn btn-success"><a >Active</a>
                            </button>
                            @else
                            <button type="button" class="btn "  style="background: #673ab7;color:white"><a href="{{ route('admin.status',[$item->id,$item->status,$form_code])  }}" >Inactive</a>
                            </button>
                            @endif
                          
                              
                                <button type="button" class="btn btn-primary"><a href="{{ route('admin.product.view',[$item->id,$form_code]) }}">Views</a></button>
                            
                              </div>
                       </td>
                   </tr>
                  @endforeach
               </tbody>
           </table>
       </div>
       {{ $data->links() }}
   </div>
   @elseif($form_code=="social_media_promotion")
   <h2 style="text-align:center ">social media promotion</h2>
   <div class="ps-section__content">
       <div class="table-responsive">
           <table class="table ps-table">
               <thead>
                   <tr>
                       <th>ID</th>
                       <th>Category</th>
                       <th>Subcategory</th>
                       <th>Product Name</th>
                       <th>Followers</th>
                       <th>Price</th>
                       <th>Total Followers</th>
                       <th>Status</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($data as $item)
                       
                
                   <tr>
                       <td>{{ $item->id }}</td>
                       <td>{{ $item->category_info->name }}</td>
                       <td>{{ $item->subcategory_info->name }}</td>
                       <td>
                           <strong>{{ $item->product_name }}</strong>
                       </td>
                       <td>
                           {{ $item->follower_subscriber }}
                       </td> 
                      
                       <td>{{ $item->unit_price }}<b style="color:red"> {{ $item->user_info->currency }}</b></td>
                     
       
                       
                       <td><p>  {{ $item->total_follower_subscriber }}</p></td>
                       <td>
                        <div class="btn-group">
                            @if($item->status=='1')
                        
                           {{-- <button type="button" class="btn btn-success"><a href="{{ route('admin.status',[$item->id,$item->status,$form_code])  }}">Active</a>
                            </button> --}}

                            <button type="button" class="btn btn-success"><a >Active</a>
                            </button>
                            @else
                            <button type="button" class="btn "  style="background: #673ab7;color:white"><a href="{{ route('admin.status',[$item->id,$item->status,$form_code])  }}" >Inactive</a>
                            </button>
                            @endif
                          
                              
                                <button type="button" class="btn btn-primary"><a href="{{ route('admin.product.view',[$item->id,$form_code]) }}">Views</a></button>
                             
                              </div>
                       </td>
                   </tr>
                  @endforeach
               </tbody>
           </table>
       </div>
       {{ $data->links() }}
   </div>
   @elseif($form_code=="top_up_apps")
   <h2 style="text-align:center ">Top Up Apps</h2>
   <div class="ps-section__content">
       <div class="table-responsive">
           <table class="table ps-table">
               <thead>
                   <tr>
                       <th>ID</th>
                       <th>Category</th>
                       <th>Subcategory</th>
                       <th>Product Name</th>
                       <th>Top Up</th>
                       <th>Price</th>
                       <th>Total Top Up</th>
                       <th>Status</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($data as $item)
                       
                
                   <tr>
                       <td>{{ $item->id }}</td>
                       <td>{{ $item->category_info->name }}</td>
                       <td>{{ $item->subcategory_info->name }}</td>
                       <td>
                           <strong>{{ $item->product_name }}</strong>
                       </td>
                       <td>
                           {{ $item->top_up }}
                       </td> 
                      
                       <td>{{ $item->unit_price }}<b style="color:red">{{ $item->user_info->currency }}</b></td>
                     
       
                       
                       <td><p>  {{ $item->total_top_up }}</p></td>
                       <td>
                        <div class="btn-group">
                            @if($item->status=='1')
                        
                            {{-- <button type="button" class="btn btn-success"><a href="{{ route('admin.status',[$item->id,$item->status,$form_code])  }}">Active</a>
                            </button> --}}

                            <button type="button" class="btn btn-success"><a >Active</a>
                            </button>
                            @else
                            <button type="button" class="btn "  style="background: #673ab7;color:white"><a href="{{ route('admin.status',[$item->id,$item->status,$form_code])  }}" >Inactive</a>
                            </button>
                            @endif
                          
                              
                                <button type="button" class="btn btn-primary"><a href="{{ route('admin.product.view',[$item->id,$form_code]) }}">Views</a></button>
                             
                              </div>
                       </td>
                   </tr>
                  @endforeach
               </tbody>
           </table>
       </div>
       {{ $data->links() }}
   </div>
   @elseif($form_code=="games_zone")
   <h2 style="text-align:center ">Games Zone </h2>
   <div class="ps-section__content">
       <div class="table-responsive">
           <table class="table ps-table">
               <thead>
                   <tr>
                       <th>ID</th>
                       <th>Category</th>
                       <th>Subcategory</th>
                       <th>Product Name</th>
                       <th>Diamonds</th>
                       <th>Price</th>
                       <th>Total Diamonds</th>
                       <th>Status</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($data as $item)
                       
                
                   <tr>
                       <td>{{ $item->id }}</td>
                       <td>{{ $item->category_info->name }}</td>
                       <td>{{ $item->subcategory_info->name }}</td>
                       <td>
                           <strong>{{ $item->product_name }}</strong>
                       </td>
                       <td>
                           {{ $item->diamonds }}
                       </td> 
                      
                       <td>{{ $item->unit_price }}<b style="color:red"> {{ $item->user_info->currency }}</b></td>
                     
       
                       
                       <td><p>  {{ $item->total_diamonds }}</p></td>
                       <td>
                        <div class="btn-group">
                            @if($item->status=='1')
                        
                           {{-- <button type="button" class="btn btn-success"><a href="{{ route('admin.status',[$item->id,$item->status,$form_code])  }}">Active</a>
                            </button> --}}

                            <button type="button" class="btn btn-success"><a >Active</a>
                            </button>
                            @else
                            <button type="button" class="btn "  style="background: #673ab7;color:white"><a href="{{ route('admin.status',[$item->id,$item->status,$form_code])  }}" >Inactive</a>
                            </button>
                            @endif
                                <button type="button" class="btn btn-primary"><a href="{{ route('admin.product.view',[$item->id,$form_code]) }}">Views</a></button>
                             
                              </div>
                       </td>
                   </tr>
                  @endforeach
               </tbody>
           </table>
       </div>
       {{ $data->links() }}
   </div>
      
 @endif
    </div>
  </div>
</section>

@endsection