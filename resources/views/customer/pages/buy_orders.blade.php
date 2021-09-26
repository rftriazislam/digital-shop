@extends('customer.dashboard')
@section('maincontent')
<section class="ps-items-listing">
    <div class="ps-section__header simple">
        <div class="ps-section__filter">
            {{-- <form class="ps-form--filter" action="index.html" method="get">
                <div class="ps-form__left">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Search..." />
                    </div>
                    <div class="form-group">
                        <select class="ps-select">
                            <option value="1">Status</option>
                            <option value="2">Active</option>
                            <option value="3">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="ps-form__right">
                    <button class="ps-btn ps-btn--gray"><i class="icon icon-funnel mr-2"></i>Filter</button>
                </div>
            </form> --}}
            <h2>Buyer Order Details</h2>
        </div>
        <div class="ps-section__actions"><a class="ps-btn success" href="new-order.html"><i class="icon icon-plus mr-2"></i>New Order</a><a class="ps-btn ps-btn--gray" href="new-order.html"><i class="icon icon-download2 mr-2"></i>Export</a></div>
    </div>
    <div class="ps-section__content">
        <div class="table-responsive">
            <table class="table ps-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Catgory</th>
                        <th>Product Name</th>
                        <th>Seller Info</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Delivery</th>
                        
                    </tr>
                </thead>
                <tbody>

                    @foreach($buy_order as $item)
                    <tr>
                        <td>{{ $item['id'] }}</td>
                        <td><strong>{{ $item['category']}}</strong></td>
                        <td><strong>{{ $item['product_name'] }}</strong></td>
                        <td><a href="order-detail.html"><strong>{{ $item['user_name'] }}</strong></a></td>
                        <td><span class="ps-badge success">{{$item['quantity']}}</span>
                        </td>
                        <td>
                            
                                   

                                     <strong>   {{$item['price'] }} </strong> 
                                   
                     
                        </td>
                        
                        <td>
                          
                                  <div class="btn-group">
                               
                                    @if($item['status']=='0')
                        
                                    <button type="button" class="btn btn-success" style="width:150px;font-size:15px"><a >Pending</a>
                                    </button>
                                    @elseif($item['status']=='1')
                       

                                              
                            <form action="{{ route('customer.buyer_checking') }}" method="post">
                                @csrf                                                                                                                                                                                   
                                                      
                                                        <input type="hidden" name="form_name" value=" {{ $item['form_name'] }}"/>
                                                        <input  type="hidden" name="order_id" value=" {{$item['order_id'] }}" />
                                                                                                     
                                    <button type="submit"class="btn "  style="background: #673ab7;color:white;width:150px;font-size:15px">Comfirm</button>
                           
                            </form>
                            @elseif($item['status']=='2')
                                    <button type="button" class="btn "  style="background: #fcb800;color:white;width:150px;font-size:15px"><a href="" >Complete</a>
                                    </button>
                                    @elseif($item['status']=='3')
                                    <button type="button" class="btn "  style="background: #eb0303;color:white;width:150px;font-size:15px"><a  >Report</a>
                                    </button>
                                    @endif</strong>
                                
                              </div>












                            </td>
                        </td>
                    </tr>
                        
                      
                 
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="ps-section__footer">
        <p>Show 10 in 30 items.</p>
        <ul class="pagination">
            <li><a href="#"><i class="icon icon-chevron-left"></i></a></li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#"><i class="icon-chevron-right"></i></a></li>
        </ul>
    </div>
</section>

@endsection