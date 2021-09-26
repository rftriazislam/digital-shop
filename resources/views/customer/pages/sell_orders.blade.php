@extends('customer.dashboard')
@section('maincontent')
<section class="ps-items-listing">
    <div class="ps-section__header simple">
        <div class="ps-section__filter">
         <h2>Sell Order Detalis</h2>
        </div>
    </div>
    <div class="ps-section__content">
        <div class="table-responsive">
            <table class="table ps-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Catgory</th>
                        <th>Product Name</th>
                        <th>Buyer Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Delivery</th>
                  
                    </tr>
                </thead>
                <tbody>

                    @foreach($sell_order as $item)
                    <tr>
                        <td>{{ $item['id'] }}</td>
                        <td><strong>{{ $item['category']}}</strong></td>
                        <td><strong>{{ $item['product_name'] }}</strong></td>
                        <td><a href="order-detail.html"><strong>{{ $item['user_name'] }}</strong></a></td>
                        <td><span class="ps-badge success">{{$item['quantity']}}</span>
                        </td>
                        <td>
                            
                                     @if($item['status']=='0'||$item['status']=='3')

                                     <strong>   {{$item['price'] }} </strong>  <span class="ps-badge success"> Pending </span>
                                      @else

                                      <strong>   {{ $item['price']  }} </strong>
                                      @endif
                     
                        </td>
                        
                        <td>
                            <div class="btn-group">
                               
                              
                                @if($item['status']=='0')
                            
                             
                                <form action="{{ route('customer.order_delivery') }}" method="post">
                                    @csrf                                                                                                                                                                                   
                                                            <input type="hidden" name="form_name" value=" {{ $item['form_name'] }}"/>
                                                            <input  type="hidden" name="product_id" value=" {{$item['product_id'] }}" />
                                                             
                                                            <input  type="hidden" name="order_id" value="{{  $item['order_id']}}"/>
                                                            <input  type="hidden" name="buyer_id" value=" {{$item['buyer_id'] }}" />                                                  
                                        <button type="submit" class="btn btn-success" style="width:150px;font-size:15px">Comfirm</button>
                               
                                </form>
                                 @elseif($item['status']=='1')
                                <button type="button" class="btn "  style="background: #673ab7;color:white;width:150px;font-size:15px"><a >Delivery Checking</a>
                                </button>
                                @elseif($item['status']=='2')
                                <button type="button" class="btn "  style="background: #dfdb10;color:white;width:150px;font-size:15px"><a >Order Complete</a>
                                </button>
                             
                             
                                @elseif($item['status']=='3')
                                <button type="button" class="btn "  style="background: #f00101;color:white;width:150px;font-size:15px"><a >Report</a>
                                </button>
                                  @endif
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