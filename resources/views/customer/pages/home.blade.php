@extends('customer.dashboard')
@section('title')
Unistag Digital||Dashboard
@endsection


@section('maincontent')

    <section class="ps-dashboard">
        <div class="ps-section__left">
            <div class="row">
                <div class="col-md-8">
                    <div class="ps-card ps-card--sale-report">
                        <div class="ps-card__header">
                            <h4>Sales Reports</h4>
                        </div>
                        <div class="ps-card__content">
                            <div id="chart"></div>
                        </div>
                        <div class="ps-card__footer">
                            <div class="row">
                                <div class="col-md-8">
                                    <p>Items Earning Sales ($)</p>
                                </div>
                                <div class="col-md-4"><a href="#">Export Report<i class="icon icon-cloud-download ml-2"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-md-4">
                    <div class="ps-card ps-card--earning">
                        <div class="ps-card__header">
                            <h4>Earnings</h4>
                        </div>
                        <div class="ps-card__content">
                            <div class="ps-card__chart">
                                <div id="donut-chart"></div>
                                <div class="ps-card__information"><strong>  <h4 >{{ Auth::user()->balance }} <b style="color:red"> {{ Auth::user()->currency }}</b></h4></strong></div>
                            </div>
                          
                        </div>
                    </div>
                </div>
            </div>
            <div class="ps-card">
                <div class="ps-card__header">
                    <h4>Recent Orders</h4>
                </div>
                <div class="ps-card__content">
                    <div class="table-responsive">
                        <table class="table ps-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Catgory</th>
                                    <th>Product ID</th>
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
                                           
                                          
                                                    
                                <form action="{{ route('customer.order_delivery') }}" method="post">
                                    @csrf                                                                                                                                                                                   
                                                            <input type="hidden" name="form_name" value=" {{ $item['form_name'] }}"/>
                                                            <input  type="hidden" name="product_id" value=" {{$item['product_id'] }}" />
                                                             
                                                            <input  type="hidden" name="order_id" value="{{  $item['order_id']}}"/>
                                                            <input  type="hidden" name="buyer_id" value=" {{$item['buyer_id'] }}" />                                                  
                                        <button type="submit" class="btn btn-success" style="width:150px;font-size:15px">Comfirm</button>
                               
                                </form>


                                              </div>
                                        </td>
                                    </td>
                                </tr>
                             

                               @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="ps-card__footer"><a class="ps-card__morelink" href="{{ route('customer.sell_orders') }}">More Orders<i class="icon icon-chevron-right"></i></a></div>
            </div>
        </div>
        <div class="ps-section__right">
            <section class="ps-card ps-card--statics">
                <div class="ps-card__header">
                    <h4>Statics</h4>
                    <div class="ps-card__sortby"><i class="icon-calendar-empty"></i>
                        <div class="form-group--select">
                            <select class="form-control">
                                <option value="1">Last 30 days</option>
                                <option value="2">Last 90 days</option>
                                <option value="3">Last 180 days</option>
                            </select><i class="icon-chevron-down"></i>
                        </div>
                    </div>
                </div>
                <div class="ps-card__content">
                    <div class="ps-block--stat yellow">
                        <div class="ps-block__left"><span><i class="icon-cart"></i></span></div>
                        <div class="ps-block__content">
                            <p>Total Products</p>
                            <h4>{{ $total_product }}</h4>
                        </div>
                    </div>
                    <div class="ps-block--stat yellow">
                        <div class="ps-block__left"><span><i class="icon-cart"></i></span></div>
                        <div class="ps-block__content">
                            <p>Orders</p>
                            <h4>{{ $order->where('status',0)->count() }}<small class="asc"><i class="icon-arrow-up"></i><span>{{ $order_percentage }}%</span></small></h4>
                        </div>
                    </div>
                    <div class="ps-block--stat pink">
                        <div class="ps-block__left"><span><i class="icon-cart"></i></span></div>
                        <div class="ps-block__content">
                            <p>Compelete Orders</p>
                            <h4>{{ $order->where('status',2)->count() }}<small class="asc"><i class="icon-arrow-up"></i><span>{{ $compelete_order_percentage }}%</span></small></h4>
                        </div>
                    </div>
                    <div class="ps-block--stat green">
                        <div class="ps-block__left"><span><i class="icon-cart"></i></span></div>
                        <div class="ps-block__content">
                            <p>Report Orders</p>
                            <h4>{{ $order->where('status',3)->count() }}<small class="desc"><i class="icon-arrow-down"></i><span>{{ $report_order_percentage }}%</span></small></h4>
                        </div>
                    </div>
                </div>
            </section>
          
        </div>
    </section>


@endsection