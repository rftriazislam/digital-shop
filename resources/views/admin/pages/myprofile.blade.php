@extends('admin.dashboard')
@section('title')
Unistag Digital|| My Profile
@endsection
@section('maincontent')
<section class="ps-dashboard ps-items-listing">
    <div class="ps-section__left " style="max-width: 50%;">
        <div class="ps-sidebar__center "><img class="center" src="{{asset('back_end/img/user/admin.jpg')}}" alt="" 
            /></div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                    <h3>    <label>Full Name :
                          
                        </label>    {{ Auth::user()->name }}</h3>
                      
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <h3>   <label>Email :
                            
                        </label>{{ Auth::user()->email }}
                    </h3>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <h3>    <label>Phone :
                          
                        </label>  {{ Auth::user()->phone }}
                    </h3>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <h3>   <label>Address :   
                        </label> {{ Auth::user()->address }}
                    </h3>
                    </div>
                </div>
                <div class="ps-form__submit text-center">
                    <button class="ps-btn ps-btn--gray mr-3" type="reset">
                        
                        {{ ( Auth::user()->status== 1) ? 'Active' : 'Inactive'}}

                    </button>
                    <button class="ps-btn success"><a href="{{route('logout')}}">Logout</a></button>
                </div>
                
            </div>
    </div>
    <div class="ps-section__right " style="max-width: 50%;">

   <section class="ps-card">
            <div class="ps-card__header">
                <h4>Account Settings</h4>
            </div>
            <div class="ps-card__content">
                <form class="ps-form--account-settings" action="{{ route('admin.profile_update') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Full Name :</label> 
                                <input class="form-control" name="name" value="{{ Auth::user()->name}}" type="text" placeholder="" />
                                <input class="form-control" name="user_id" type="hidden" value="{{ Auth::user()->id }}" placeholder="" />

                            </div>
                        </div>
                        <div class="col-sm-12">
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
                        <button class="ps-btn success">Update Profile</button>
                    </div>
                </form>
            </div>
        </section>


    </div>
</section>

@endsection