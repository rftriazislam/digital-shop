@extends('customer.dashboard')
@section('title')
Unistag Digital|| My Profile
@endsection
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
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <div class=" form-group">
                                <span class="profile_text" ><b>Full Name : </b>{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>

                <div class="col-sm-4 offset-sm-4">
                    <div class=" form-group">
                        <span class="profile_text" ><b>Email : </b>{{ Auth::user()->email }}</span>
                    </div>
                </div>

                <div class=" col-sm-4 offset-sm-4">
                    <div class=" form-group">
                        <span class="profile_text" ><b>Phone : </b>{{ Auth::user()->phone }}</span>
                    </div>
                </div>

                <div class=" col-sm-4 offset-sm-4">
                    <div class=" form-group">
                        <span class="profile_text" ><b>Address : </b>{{ Auth::user()->address }}</span>
                    </div>
                </div>

                <div class="col-sm-12">
                <div  class="ps-form__submit text-center ">
                    <button class=" ps-btn ps-btn--gray mr-3" type="reset">

                        {{ ( Auth::user()->status== 1) ? 'Active' : 'Inactive'}}

                    </button>

                    <button class=" ps-btn success"><a style="color:white" href="{{route('logout')}}">Logout</a></button>

                </div>
                </div>

                

            </div>
            </section>

    </div>

    <div class="ps-section__right " style="max-width: 100%;    max-width: 100%;
    border: 1px solid #80bc00;
    border-style: ridge;
    padding: 68px 10px;
    margin:5px 10px;">

   <section class="ps-card">
            <div class="ps-card__header">
                <h4>Account Settings</h4>
            </div>
            <div class="ps-card__content">
                <form class="ps-form--account-settings" action="{{ route('customer.profile_update') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Full Name :</label>
                                <input class="form-control" name="name" value="{{ Auth::user()->name}}" type="text" placeholder="" />
                                <input class="form-control" name="user_id" type="hidden" value="{{ Auth::user()->id }}" placeholder="" />

                            </div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="form-group">
                                <label>Phone
                                </label>
                                <input class="form-control" name="phone" value="{{ Auth::user()->phone }}" type="text" placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Address</label>
                                </label>
                                <input class="form-control" name="address" value="{{ Auth::user()->address }}" type="text" placeholder="" />
                            </div>
                        </div>

                    </div>

                    <div class="ps-form__submit text-center">
                        <button class="ps-btn ps-btn--gray mr-3" type="reset">Cancel</button>
                        <button class="ps-btn success">Update</button>
                    </div>

                </form>
            </div>
        </section>


    </div>
</section>

@endsection
