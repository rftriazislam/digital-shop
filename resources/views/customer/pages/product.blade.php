
@extends('customer.dashboard')
@section('title')
Unistag Digital||Product
@endsection
@section('maincontent')

<section class="ps-items-listing">
   
    <div class="ps-section__header">
        <div class="ps-section__filter">
            <form class="ps-form--filter" action="{{ route('customer.addpoduct') }}" method="post">
             @csrf
                <div class="ps-form__left">
                   
                    <div class="form-group row">
                    
                        <select   id="idcategory" required class="form-control col-8"  name="category_id" >

                            <option value="" selected disabled>Select Category</option>
                                    
                            @foreach($category as $v_category)
                            <option value="{{$v_category->id}}">{{$v_category->name}}</option>
                             @endforeach

                        </select>
                 </div>
                 
                    <div class="form-group row">
                    
                        <select   id="idsubcategory" class="form-control col-8" required  name="subcategory_id" >
                          <option value="" selected disabled>Select Subcategory</option>
                        </select>
                      </div>
                    <div class="form-group">
                    
                        <button type="submit" style="background-color: #ffffff;border-width: 0px;"><a class="ps-btn success"  style="padding: 10px 30px;color:white"><i class="icon icon-plus mr-2"></i>Product</a>
                        </button>
                    </div>
                </div>
                <div class="ps-form__right">
                </div>
                 

            </form>
        </div>
        <div class="ps-section__search">
            
        </div>
    </div>

    @if($form_code=="social_media")
    <h2 style="text-align:center ">Social Media</h2>
    <div class="ps-section__content">
        <div class="table-responsive">
            <table class="table ps-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Social Name</th>
                  
                        <th>Friends</th>
                        <th>Followers</th>
                        <th>Price</th>
                        <th>Image</th>
                      
                        <th>status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($social_media as $item)
                        
                 
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
                            <strong>{{ $item->price }} <b style="color:red"> {{ Auth::user()->currency }}</b></strong>
                        </td>
                        <td>
                          <img src="{{ asset('back_end/social_images') }}/{{ $item->image }}" alt="" style="height:50px;width:70px;">
                        </td>
                       
                     
                        <td>  <div class="btn-group">
                            @if($item->status=='1')
                        
                            <button type="button" class="btn btn-success"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}" >Active</a>
                            </button>
                            @elseif($item->status=='8')  
                            <button type="button" class="btn " style="background: #fcb800;color:white"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}">Temporarily Off</a>
                            </button>
                            @elseif($item->status=='9')
                        
                            <button type="button" class="btn " style="background: #fcb800;color:white"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}">Reject</a>
                            </button>
                            @else
                            <button type="button" class="btn "  style="background: #673ab7;color:white"><a >Pending</a>
                            </button>
                            @endif
                          
                              
                                <button type="button" class="btn btn-primary"><a href="{{ route('customer.productedit',[$item->id,$form_code]) }}">Edit/Update</a></button>
                                @if($item->status=='0')
                                <button type="button" class="btn btn-danger"><a href="{{ route('customer.social-delete',[$item->id]) }}">Delete  </a></button>
                                @endif
                            </div>
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
        {{ $social_media->links() }}
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
                    @foreach ($make_payment as $item)
                        
                 
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
                            {{ $item->unit_price }} <b style="color:red"> {{ $item->get_currency }}</b>
                        </td> 
        
                        
                     
                        <td>
                            @if($item->status=='1')
                        
                            <button type="button" class="btn btn-success"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}" >Active</a>
                            </button>
                            @elseif($item->status=='8')  
                            <button type="button" class="btn " style="background: #fcb800;color:white"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}">Temporarily Off</a>
                            </button>
                            @elseif($item->status=='9')
                        
                            <button type="button" class="btn " style="background: #fcb800;color:white"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}">Reject</a>
                            </button>
                            @else
                            <button type="button" class="btn "  style="background: #673ab7;color:white"><a >Pending</a>
                            </button>
                            @endif
                          
                              
                            <button type="button" class="btn btn-primary"><a href="{{ route('customer.productedit',[$item->id,$form_code]) }}">Edit/Update</a></button>
                                @if($item->status=='0')
                                <button type="button" class="btn btn-danger"><a href="{{ route('customer.makepayment-delete',[$item->id]) }}">Delete  </a></button>
                                @endif
                            
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
        {{ $make_payment->links() }}
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
                        <th>Image</th>
                       
                        <th>status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($influence as $item)
                        
                 
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
                           {{ $item->price }} <b style="color:red"> {{ Auth::user()->currency }}</b>
                        </td>
                        <td>
                          <img src="{{ asset('back_end/social_images') }}/{{ $item->image }}" alt="" style="height:50px;width:70px;">
                        </td>
                       
                      
                        <td>  <div class="btn-group">
                            @if($item->status=='1')
                        
                            <button type="button" class="btn btn-success"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}" >Active</a>
                            </button>
                            @elseif($item->status=='8')  
                            <button type="button" class="btn " style="background: #fcb800;color:white"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}">Temporarily Off</a>
                            </button>
                            @elseif($item->status=='9')
                        
                            <button type="button" class="btn " style="background: #fcb800;color:white"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}">Reject</a>
                            </button>
                            @else
                            <button type="button" class="btn "  style="background: #673ab7;color:white"><a >Pending</a>
                            </button>
                            @endif
                          
                              
                            <button type="button" class="btn btn-primary"><a href="{{ route('customer.productedit',[$item->id,$form_code]) }}">Edit/Update</a></button>
                                @if($item->status=='0')
                                <button type="button" class="btn btn-danger"><a href="{{ route('customer.social-delete',[$item->id]) }}">Delete  </a></button>
                                @endif
                            </div>
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
        {{ $influence->links() }}
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
                    @foreach ($giftcard as $item)
                        
                 
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
                       
                        <td>{{ $item->price }} <b style="color:red"> {{ Auth::user()->currency }}</b></td>
                      
        
                        
                     
                        <td>
                            @if($item->status=='1')
                        
                            <button type="button" class="btn btn-success"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}" >Active</a>
                            </button>
                            @elseif($item->status=='8')  
                            <button type="button" class="btn " style="background: #fcb800;color:white"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}">Temporarily Off</a>
                            </button>
                            @elseif($item->status=='9')
                        
                            <button type="button" class="btn " style="background: #fcb800;color:white"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}">Reject</a>
                            </button>
                            @else
                            <button type="button" class="btn "  style="background: #673ab7;color:white"><a >Pending</a>
                            </button>
                            @endif
                          
                              
                            <button type="button" class="btn btn-primary"><a href="{{ route('customer.productedit',[$item->id,$form_code]) }}">Edit/Update</a></button>
                                @if($item->status=='0')
                                <button type="button" class="btn btn-danger"><a href="{{ route('customer.giftcard-delete',[$item->id]) }}">Delete  </a></button>
                                @endif
                            
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
        {{ $giftcard->links() }}
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
                    @foreach ($subscription as $item)
                        
                 
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
                       
                        <td>{{ $item->price }} <b style="color:red"> {{ Auth::user()->currency }}</b></td>
                      
        
                        
                      
                        <td>
                            @if($item->status=='1')
                        
                            <button type="button" class="btn btn-success"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}" >Active</a>
                            </button>
                            @elseif($item->status=='9')  
                            <button type="button" class="btn " style="background: #fcb800;color:white"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}">Temporarily Off</a>
                            </button>
                            @elseif($item->status=='9')
                        
                            <button type="button" class="btn " style="background: #fcb800;color:white"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}">Reject</a>
                            </button>
                            @else
                            <button type="button" class="btn "  style="background: #673ab7;color:white"><a >Pending</a>
                            </button>
                            @endif
                          
                              
                            <button type="button" class="btn btn-primary"><a href="{{ route('customer.productedit',[$item->id,$form_code]) }}">Edit/Update</a></button>
                                @if($item->status=='0')
                                <button type="button" class="btn btn-danger"><a href="{{ route('customer.subscription-delete',[$item->id]) }}">Delete  </a></button>
                                @endif
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
        {{ $subscription->links() }}
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
                    @foreach ($digital_wallet as $item)
                        
                 
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
                       
                        <td>{{ $item->price }} <b style="color:red"> {{ Auth::user()->currency }}</b></td>
                      
        
                        
                        <td><p>  {{ $item->opening_year }}</p></td>
                        <td>
                            @if($item->status=='1')
                            <button type="button" class="btn btn-success"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}" >Active</a>
                            </button>
                            @elseif($item->status=='8')  
                            <button type="button" class="btn " style="background: #fcb800;color:white"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}">Temporarily Off</a>
                            </button>
                            @elseif($item->status=='9')
                        
                            <button type="button" class="btn " style="background: #fcb800;color:white"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}">Reject</a>
                            </button>
                            @else
                            <button type="button" class="btn "  style="background: #673ab7;color:white"><a >Pending</a>
                            </button>
                            @endif
                          
                              
                            <button type="button" class="btn btn-primary"><a href="{{ route('customer.productedit',[$item->id,$form_code]) }}">Edit/Update</a></button>
                                @if($item->status=='0')
                                <button type="button" class="btn btn-danger"><a href="{{ route('customer.digitalwallet-delete',[$item->id]) }}">Delete  </a></button>
                                @endif
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
        {{ $digital_wallet->links() }}
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
                    @foreach ($advertisement as $item)
                        
                 
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
                       
                        <td>{{ $item->price }}<b style="color:red"> {{ Auth::user()->currency }}</b></td>
                      
        
                        
                        <td><p>  {{ $item->opening_year }}</p></td>
                        <td>
                            @if($item->status=='1')
                        
                            <button type="button" class="btn btn-success"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}" >Active</a>
                            </button>
                            @elseif($item->status=='8')  
                            <button type="button" class="btn " style="background: #fcb800;color:white"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}">Temporarily Off</a>
                            </button>
                            @elseif($item->status=='9')
                        
                            <button type="button" class="btn " style="background: #fcb800;color:white"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}">Reject</a>
                            </button>
                            @else
                            <button type="button" class="btn "  style="background: #673ab7;color:white"><a >Pending</a>
                            </button>
                            @endif
                          
                              
                            <button type="button" class="btn btn-primary"><a href="{{ route('customer.productedit',[$item->id,$form_code]) }}">Edit/Update</a></button>
                                @if($item->status=='0')
                                <button type="button" class="btn btn-danger"><a href="{{ route('customer.advertisementaccount-delete',[$item->id]) }}">Delete  </a></button>
                                @endif
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
        {{ $advertisement->links() }}
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
                    @foreach ($promotion as $item)
                        
                 
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
                       
                        <td>{{ $item->unit_price }}<b style="color:red"> {{ Auth::user()->currency }}</b></td>
                      
        
                        
                        <td><p>  {{ $item->total_follower_subscriber }}</p></td>
                        <td>
                            @if($item->status=='1')
                        
                            <button type="button" class="btn btn-success"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}" >Active</a>
                            </button>
                            @elseif($item->status=='8')  
                            <button type="button" class="btn " style="background: #fcb800;color:white"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}">Temporarily Off</a>
                            </button>
                            @elseif($item->status=='9')
                        
                            <button type="button" class="btn " style="background: #fcb800;color:white"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}">Reject</a>
                            </button>
                            @else
                            <button type="button" class="btn "  style="background: #673ab7;color:white"><a >Pending</a>
                            </button>
                            @endif
                          
                              
                            <button type="button" class="btn btn-primary"><a href="{{ route('customer.productedit',[$item->id,$form_code]) }}">Edit/Update</a></button>
                                @if($item->status=='0')
                                <button type="button" class="btn btn-danger"><a href="{{ route('customer.socialmediapromotion-delete',[$item->id]) }}">Delete  </a></button>
                                @endif
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
        {{ $promotion->links() }}
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
                    @foreach ($topup as $item)
                        
                 
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
                       
                        <td>{{ $item->unit_price }}<b style="color:red"> {{ Auth::user()->currency }}</b></td>
                      
        
                        
                        <td><p>  {{ $item->total_top_up }}</p></td>
                        <td>
                            @if($item->status=='1')
                        
                            <button type="button" class="btn btn-success"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}" >Active</a>
                            </button>
                            @elseif($item->status=='8')  
                            <button type="button" class="btn " style="background: #fcb800;color:white"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}">Temporarily Off</a>
                            </button>
                            @elseif($item->status=='9')
                        
                            <button type="button" class="btn " style="background: #fcb800;color:white"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}">Reject</a>
                            </button>
                            @else
                            <button type="button" class="btn "  style="background: #673ab7;color:white"><a >Pending</a>
                            </button>
                            @endif
                          
                              
                            <button type="button" class="btn btn-primary"><a href="{{ route('customer.productedit',[$item->id,$form_code]) }}">Edit/Update</a></button>
                                @if($item->status=='0')
                                <button type="button" class="btn btn-danger"><a href="{{ route('customer.topupapps-delete',[$item->id]) }}">Delete  </a></button>
                                @endif
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
        {{ $topup->links() }}
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
                    @foreach ($game as $item)
                        
                 
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
                       
                        <td>{{ $item->unit_price }}<b style="color:red"> {{ Auth::user()->currency }}</b></td>
                      
        
                        
                        <td><p>  {{ $item->total_diamonds }}</p></td>
                        <td>
                            @if($item->status=='1')
                        
                            <button type="button" class="btn btn-success"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}" >Active</a>
                            </button>
                            @elseif($item->status=='8')
                            <button type="button" class="btn " style="background: #fcb800;color:white"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}">Reject</a>
                            </button>
                            @elseif($item->status=='9')  
                            <button type="button" class="btn " style="background: #fcb800;color:white"><a href="{{ route('customer.reject',[$item->id,$form_code]) }}">Temporarily Off</a>
                            </button>
                            @else
                            <button type="button" class="btn "  style="background: #673ab7;color:white"><a >Pending</a>
                            </button>
                            @endif
                          
                              
                            <button type="button" class="btn btn-primary"><a href="{{ route('customer.productedit',[$item->id,$form_code]) }}">Edit/Update</a></button>
                                @if($item->status=='0')
                                <button type="button" class="btn btn-danger"><a href="{{ route('customer.gameszone-delete',[$item->id]) }}">Delete  </a></button>
                                @endif
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
        {{ $game->links() }}
    </div>
    @else
      @endif

</section>
<script type=text/javascript>  

    $('#idcategory').change(function(){
        
    var category_id=$(this).val();
   console.log("success id found =",category_id);

  
     
    if(category_id){
       $("#cols").empty();
     
        $("#cols").append(
          '<li class="nav-item"><a class="nav-link" href="#i'+category_id+'" data-toggle="tab" style="color:white;height:50px;width:100px;text-align:center;background:#24bb2a;">GO</a></li>');

          $("#link").append('<a  href="{{url('get-add-product-list')}}/'+category_id+'"  style="color:white;height:50px;width:100px;text-align:center;background:#24bb2a;">GO</a>');
          $("#category_id").append('<input type="hidden" class="form-control" name="category_id" value="'+category_id+'" placeholder="category id">');
          
         
    }
        
    if(category_id){

      

      $.ajax({
        type:"GET",
        url:"{{url('get-subcategory-list')}}?category_id="+category_id,
        success:function(res){        
        if(res){
          $("#idsubcategory").empty();

          $("#idsubcategory").append('<option value="" >Select</option>');

          $.each(res,function(key,value){

            $("#idsubcategory").append('<option value="'+key+'">'+value+'</option>');
            // $("#idsubcateggory").append('<li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab" >'+value+'</a></li>');

          });
        }else{

          $("#idsubcategory").empty();

        }
        }
      });
    }else{    
      $("#idsubcategory").empty(); 
  }  
  

  });

  </script>
@endsection