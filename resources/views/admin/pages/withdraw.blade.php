@extends('admin.dashboard')
@section('maincontent')


   



    <h2 style="text-align:center ">Withdraw List</h2>

    <div class="ps-section__content">
        <div class="table-responsive">
            <table class="table ps-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
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
    <td><strong>{{ $withdraw->user_info->name }}</strong></td>
    <td><strong>{{ $withdraw->payment_method }}</strong></td>
    <td><strong>{{ $withdraw->payment_type }}</strong></td>
    <td><strong>{{ $withdraw->account_name }}</strong></td>
    <td><span class="ps-badge success">{{ $withdraw->account }}</span>
    </td>
    <td>               
     <strong> {{ $withdraw->amount }} <sup style="color:red">{{ $withdraw->user_info->currency }} </sup></strong> 
      <span class="ps-badge success"> {{ $withdraw->status==1?'Paid':'Pending'}}</span>               
    </td>
    <td><strong>{{ $withdraw->created_at }}</strong></td>
    
    <td>
        <div class="btn-group">
           
          
        @if($withdraw->status==0)
            <button type="button" class="btn "  style="background: #66e946;color:white;width:150px;font-size:15px"><a href="{{ route('admin.withdraw_view',[$withdraw->id]) }}">Incomming</a>
            </button>
          @else 
            <button type="button" class="btn "  style="background: #a410df;color:white;width:150px;font-size:15px"><a href="{{ route('admin.withdraw_view',[$withdraw->id]) }}">Complete</a>
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




@endsection