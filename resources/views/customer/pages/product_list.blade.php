

@extends('customer.dashboard')
@section('title')
Unistag Digital||Product list
@endsection
@section('maincontent')

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
                        <th>Link</th>
                        <th>Friends</th>
                        <th>Followers</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($social_media->take(8) as $item)
                        
                 
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->category_info->name }}</td>
                        <td>{{ $item->subcategory_info->name }}</td>
                        <td><span class="ps-badge success">{{ $item->social_name }}</span>
                        </td>
                        <td>{{ $item->social_link }}</td>
                        <td>
                            {{ $item->friends }}
                        </td> 
                        <td>
                            {{ $item->followers }}
                        </td> 
                        <td>
                            <strong>${{ $item->price }}</strong>
                        </td>
                        <td>
                          <img src="{{ asset('back_end/social_images') }}/{{ $item->image }}" alt="" style="height:50px;width:70px;">
                        </td>
                       
                        <td><p> <?php echo  $item->description ?> </p></td>
                        <td>  <div class="btn-group">
                            @if($item->status=='1')
                        
                            <button type="button" class="btn btn-success"><a >Active</a>
                            </button>
                            @else
                            <button type="button" class="btn "  style="background: #673ab7;color:white"><a >Inactive</a>
                            </button>
                            @endif
                          
                              
                                <button type="button" class="btn btn-primary"><a href="">Edit/Update</a></button>
                                <button type="button" class="btn btn-danger"><a href="{{ route('customer.social-delete',[$item->id]) }}">Delete  </a></button>
                              </div>
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <h2 style="text-align:center ">Make Payment</h2>
    <div class="ps-section__content">
        <div class="table-responsive">
            <table class="table ps-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Send Currency</th>
                        <th>Send Amount</th>
                        <th>Send Wallet</th>
                        <th>Send Account</th>
                        <th>Get Currency</th>
                        <th>Get Amount</th>
                        <th>Get Wallet</th>
                        <th>Get Account</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($make_payment->take(8) as $item)
                        
                 
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->category_info->name }}</td>
                        <td>{{ $item->subcategory_info->name }}</td>
                        <td>
                            <strong>{{ $item->send_currency }}</strong>
                        </td>
                        <td>
                            ${{ $item->send_amount }}
                        </td> 
                        <td><span class="ps-badge success">{{ $item->send_wallet}}</span>
                        </td>
                        <td>{{ $item->send_account }}</td>
                        <td>
                            {{ $item->get_currency }}
                        </td> 
                        <td>
                            ${{ $item->get_amount }}
                        </td> 
                        <td>
                            <strong>{{ $item->get_wallet }}</strong>
                        </td>
                        <td>{{ $item->get_account }}</td>
                        <td>
                            {{ $item->price }}
                        </td> 
        
                        
                        <td><p> <?php echo  $item->description ?> </p></td>
                        <td>
                            @if($item->status=='1')
                        
                            <button  style="background-color: #ffffff;border-width: 0px;"><a class="ps-btn success"  style="padding: 10px 30px;color:white">Active</a>
                            </button>
                            @else
                            <button  style="background-color: #ffffff;border-width: 0px;"><a class="ps-btn danger"  style="padding: 10px 30px;color:white">Inactive</a>
                            </button>
                            @endif
                        </td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection