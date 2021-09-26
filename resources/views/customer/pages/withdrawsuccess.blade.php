@extends('customer.dashboard')
@section('title')
    Unistag Digital || Withdraw Confirm
@endsection
@section('maincontent')

<section class="ps-dashboard ps-items-listing">

   

    <div class="ps-section__right " style="max-width: 100%;    max-width: 100%;
    border: 1px solid #7e2391;
    border-style: ridge;
    padding: 68px 10px;
    margin:5px 10px;">

   <section class="ps-card">
      


            <div class=" col-sm-12 ">
            
            </div>

            <div class="ps-card__content">




               
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">

                                <label>Thank you .</label>
                                <label>You will get money within 3 working days.</label>

                            </div>
                        </div>
                       
                        
                    </div>
                      
                 </section>
                 <button type="button" class="btn "  style="background: #e70410;color:white;width:150px;font-size:15px">
                    <a href="{{ route('balance_withdraw') }}">Back</a>
                 </button>
                         </div>
    </div>
    
</section>

@endsection