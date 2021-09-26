@extends('customer.dashboard')
@section('maincontent')

<section class="ps-items-listing">
   
<div style="margin:auto 10px;height:100px"> 
<div class="col-6"style="float:left">
    <h4>Total Balance </h4> <h4 id="total_balancee" >{{ $balance->balance }} {{  $balance->currency }}</h4>
</div>
<div class="col-6" style="float:left">
    <h4>Pending Balance</h4> <h4 id="pending_balancee"></h4>
</div>
  

</div>

<div class="ps-section__header">
        <div class="ps-section__filter">
            <form class="ps-form--filter" action="{{ route('customer.withdraw') }}" method="post">
             @csrf
                <div class="ps-form__left">
                    {{-- <div class="form-group row">
                    
                        <label><a class="ps-btn success"  style="padding: 10px 30px;color:white"><i class="icon icon-minus mr-2"></i>Withdraw</a>
                        </label>
                      </div> --}}
                    <div class="form-group row">
                    
                        <select   class="form-control col-8" required  name="payment_method" >
                          <option value="" selected disabled>Select Payment Method</option>
                          <option value="mobile_banking">Mobile Banking</option>
                          <option value="bank">Bank</option>
                          <option value="online_money_transfer">Online Money Transfer</option>

                        </select>
                      </div>
                    <div class="form-group">
                    
                        <button type="submit" style="background-color: #ffffff;border-width: 0px;"><a class="ps-btn success"  style="padding: 10px 30px;color:white"><i class="icon icon-minus mr-2"></i>withdraw</a>
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




    <div class="ps-section__content">
        <div class="table-responsive">
            <table class="table ps-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Payment Method</th>
                        <th>Payment Type </th>
                        <th>Account Name</th>
                        <th>Account No.</th>
                        <th>Amount</th>
                        
                        <th>Date</th>
                        <th>Delivery</th>
                    </tr>
                </thead>
                <tbody>
@foreach ($withdraws as $withdraw)
<tr>
    <td>{{ $withdraw->id }}</td>
    <td><strong>{{ $withdraw->payment_method }}</strong></td>
    <td><strong>{{ $withdraw->payment_type }}</strong></td>
    <td><strong>{{ $withdraw->account_name }}</strong></td>
    <td><span class="ps-badge success">{{ $withdraw->account }}</span>
    </td>
    <td>               
     <strong> {{ $withdraw->amount }} <sup style="color:red">{{ Auth::user()->currency }} </sup> </strong>  <span class="ps-badge success"> {{ $withdraw->status==1?'Paid':'Pending'}}</span>               
    </td>
    <td><strong>{{ $withdraw->created_at }}</strong></td>
    
    <td>
        <div class="btn-group">
           
          
        @if($withdraw->status==0)
            <button type="button" class="btn "  style="background: #673ab7;color:white;width:150px;font-size:15px"><a >Panding</a>
            </button>
          @else 
            <button type="button" class="btn "  style="background: #dfdb10;color:white;width:150px;font-size:15px"><a href="{{ route('customer.withdraw_checking',[$withdraw->id]) }}" >Complete</a>
            </button>
         @endif
    
       
    
              </div>
        </td>
    </td>
</tr>
@endforeach
                
                    
                 
                  
                </tbody>
            </table>
             {{ $withdraws->links() }}
        </div>
       
    </div>


<script>  
    $(document).ready(function(){
balance();
function balance()
{
$.ajax({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
url:"{{ route('total_balance') }}",
method:"POST",
dataType:"json",
success:function(data)
{
// $('#cart_details').html(data.cart_details);
$('#total_balancee').html(data.total);

$('#pending_balancee').html(data.pending);

}
});
}

         });

</script>



@endsection