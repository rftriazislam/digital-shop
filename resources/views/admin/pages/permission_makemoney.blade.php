@extends('admin.dashboard')
@section('maincontent')
<section class="ps-items-listing">
    <h2 style="text-align-last: center">Product Permission</h2>
    <hr>
    <div style="text-align:center"> 

    
    <div class="ps-section__atctions" style="float: left;margin-left:2px;margin-top:2px;"><a class="ps-btn success" href="{{ route('product_permission') }}">Social Media</a></div>
    <div class="ps-section__acctions" style="float: left;margin-left:2px;margin-top:2px;"><a class="ps-btn success" href="{{ route('permission_makemoney') }}">Make Money</a></div>
    <div class="ps-section__acctions" style="float: left;margin-left:2px;margin-top:2px;"><a class="ps-btn success" href="new-product.html">Product</a></div>
   </div>
   <div class="ps-section__header"></div>
   <div class="ps-section__content">
    <div class="table-responsive">
        <table class="table ps-table">
            <thead>
                <tr>
                    <th  style="background: #673ab7;color:white">ID</th>
                    <th  style="background: #673ab7;color:white">User Name</th>
                    <th  style="background: #673ab7;color:white">Category</th>
                    <th  style="background: #673ab7;color:white">Subcategory</th>
                    <th  style="background: #673ab7;color:white">Send Currency</th>
                    <th  style="background: #673ab7;color:white">Send Wallet</th>
                    <th  style="background: #673ab7;color:white">Send Account</th>
                    <th  style="background: #673ab7;color:white">Get Currency</th>
                    <th  style="background: #673ab7;color:white">Get Wallet</th>
                    <th  style="background: #673ab7;color:white">Get Account</th>
                    <th  style="background: #673ab7;color:white">Sell Rate</th>
                    <th  style="background: #673ab7;color:white">Purchase Rate</th>
                    <th  style="background: #673ab7;color:white">Your Rmount</th>
                    <th  style="background: #673ab7;color:white">Description</th>
                    <th  style="background: #673ab7;color:white">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($makemoney as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->user_info->name }}</td>
                    <td>{{ $item->category_info->category_name }}</td>
                    <td>{{ $item->subcategory_info->subcategory_name }}</td>
                    <td>
                        <strong>${{ $item->send_currency }}</strong>
                    </td>
                    <td><span class="ps-badge success">{{ $item->send_wallet}}</span>
                    </td>
                    <td>{{ $item->send_account }}</td>
                    <td>
                        ${{ $item->get_currency }}
                    </td> 
                    <td>
                        <strong>{{ $item->get_wallet }}</strong>
                    </td>
                    <td>{{ $item->get_account }}</td>
                    <td>
                        {{ $item->sell_rate }}
                    </td> 
    
                    <td>{{ $item->purchase_rate }}</td>
                    <td>
                        {{ $item->your_amount }}
                    </td> 
                    <td><p> <?php echo  $item->description ?> </p></td>
                    <td>
                        <div class="btn-group">
                            @if($item->status=='1')
                        
                            <button type="button" class="btn btn-success"><a href="{{ route('admin.status',[$item->id,$item->status,$item->form_name])  }}">Active</a>
                            </button>
                            @else
                            <button type="button" class="btn "  style="background: #673ab7;color:white"><a href="{{ route('admin.status',[$item->id,$item->status,$item->form_name])  }}" >Inactive</a>
                            </button>
                            @endif
                          
                              
                                <button type="button" class="btn btn-primary"><a href="">Views</a></button>
                                <button type="button" class="btn btn-danger"><a href="{{ route('customer.social-delete',[$item->id,$item->form_name]) }}">Delete</a></button>
                              </div>
                    </td>
                </tr>
               @endforeach
            </tbody>
        </table>
    </div>
</div>
</section>

@endsection