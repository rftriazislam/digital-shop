@extends('customer.dashboard')
@section('maincontent')
<section class="ps-dashboard ps-items-listing">

    <div class="ps-section__left" style="max-width: 100%;    max-width: 100%;
    border: 1px solid #80bc00;
    border-style: ridge;
    padding: 40px 0px;
    margin:5px 10px">
    <section class="ps-card">

        <div class="ps-sidebar__center ">
            <img style="width: 150px;height: 150px; margin-bottom:20px;"
            class="center img-fluid" src="{{asset('back_end/img/user/admin.jpg')}}"
        alt="">
        </div>
            <div class="row">
                <div class="col-12">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class=" form-group">
                                    <span class="profile_text" >Withdraw Name : <b> {{ $withdraws_view->user_info->name }} </b></span>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
    
                    <div class="col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" > Withdraw Email :<b> {{ $withdraws_view->user_info->email }} </b></span>
                        </div>
                    </div>
    
                    <div class=" col-sm-12">
                        <div class=" form-group">
                            <span class="profile_text" >Withdraw Phone :<b>  {{ $withdraws_view->user_info->phone }} </b></span>
                        </div>
                    </div>
    
                  
                </div>
               
                <div class="col-12">
                    
                 
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" >Payment Method:<b> {{ $withdraws_view->payment_method }} </b></span>
                        </div>
                    </div>
    
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" >Payment Type :<b> {{ $withdraws_view->payment_type }}</b></span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" >Account Name :<b> {{ $withdraws_view->account_name }}</b></span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" >Account No :<b> {{ $withdraws_view->account }}</b></span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" >Amount :<b> {{ $withdraws_view->amount }}</b><sup style="color:red">{{ $withdraws_view->user_info->currency }}</sup></span>
                        </div>
                    </div>
                 
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" >Request Date :<b> {{ $withdraws_view->created_at }} </b></span>
                        </div>
                    </div>
                    <div class=" col-sm-12 ">
                        <div class=" form-group">
                            <span class="profile_text" >Update Date :<b> {{ $withdraws_view->updated_at }} </b></span>
                        </div>
                    </div>


                </div>
              
                

            </div>
            <div class="ps-form__submit text-center">
                @if($withdraws_view->status==0)
                <button class="ps-btn ps-btn--danger mr-3" type="reset">Due</button>
                @else 
                <button class="ps-btn danger mr-3" type="reset">Complete</button>

                @endif
            </div>
            <section>

    </div>

    <div class="ps-section__right " style="max-width: 100%;    max-width: 100%;
    border: 1px solid #80bc00;
    border-style: ridge;
    padding: 68px 10px;
    margin:5px 10px;">

   <section class="ps-card">
            <div class="ps-card__header">
                <h4>Document View</h4>
            </div>
            <div class=" col-sm-12 item">
                <a href="{{ asset('back_end/withdraw_images') }}/{{$withdraws_view->image1  }}" > 
                <img src="{{ asset('back_end/withdraw_images') }}/{{$withdraws_view->image1  }}" style="height:50px;width:70px">
               </a>
               <a href="{{ asset('back_end/withdraw_images') }}/{{$withdraws_view->image2  }}" > 
                <img src="{{ asset('back_end/withdraw_images') }}/{{$withdraws_view->image2  }}" style="height:50px;width:70px">
               </a>
               <a href="{{ asset('back_end/withdraw_images') }}/{{$withdraws_view->image3  }}" > 
                <img src="{{ asset('back_end/withdraw_images') }}/{{$withdraws_view->image3  }}" style="height:50px;width:70px">
               </a>
            </div>
        <br>
           <p><b>Please check your Balance </b></p>
           <h4 style="text-align: center;color:red">Payment Complete</h4>
        </section>


    </div>
</section>
@endsection