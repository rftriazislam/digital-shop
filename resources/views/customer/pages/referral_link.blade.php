@extends('customer.dashboard')
@section('maincontent')

{{-- <h4>Referral Link : <b style="color:rebeccapurple"><a href="{{ $referral }}">  {{ $referral }} </a> </b></h4> --}}
  <h3>Your Referral Link :</h3>
<div class="form-group form-group--select">
  
<input class="form-control col-6" type="text" style="float: left;" value="{{ $referral }}" id="myInput">
<button class="ps-btn"style="float: none;height: 50px;" onclick="myFunction()">Copy</button>
</div>

<h4 >** List of Your Referral commission</h4>
<div class="ps-section__content">
    <div class="table-responsive">

    

        <table class="table ps-table">
            <thead>
                <tr>
             
                    <th>Name</th>
                    <th>Sell</th>
                    <th>Buy</th>
                    <th>Commission</th>
                </tr>
            </thead>
            <tbody>

                @foreach($referr_data as $item)
                <tr>
                 
                    <td><strong>{{ $item['name']}}</strong></td>
                    <td><span class="ps-badge success">{{ $item['total_sell'] }}</span></td>
                    <td><span class="ps-badge success">{{  $item['total_buy']  }}</span>
                    </td>
                    <td>
                        
                        <span class="ps-badge success">{{ $item['total_commission']   }} {{ Auth::user()->currency }}</span>     
                 
                    </td>
                    
                
                   
                </tr>
             
               @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    function myFunction() {
      var copyText = document.getElementById("myInput");
      copyText.select();
      copyText.setSelectionRange(0, 99999)
      document.execCommand("copy");
    // $('#s').append('dddd')
    }
    </script>
    
@endsection