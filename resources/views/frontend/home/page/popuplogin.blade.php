<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin-top: 183px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModal" style="text-align: center;margin: 2px 50% 2px 50%;">{{ __('Login') }}</h5>
            
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('loginpopup') }}">
                    @if(session('errors'))
                    <p style="text-align: center;color:red"><b>{{ $errors }}</b></p>
                    @endif
                    @csrf
  
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
  
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
  
                        
                        </div>
                    </div>
  
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
  
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control " name="password" required autocomplete="current-password">
                           
                        </div>
                    </div>
  
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                  <div class="ps-checkbox">
                                    <input class="form-control" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember-me">Rememeber me</label>
                                  </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row mb-0">

                        <div class="col-md-8 offset-md-4">
                            <div class="form-group submit">
                                <button class="ps-btn ps-btn">Login</button>
                                <a href="{{route('register')}}" style="line-height:1em;color:#20c997;"> Register</a>
                              </div>
                         
                           
                               
                            
                        </div>
                        

                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
  <div class="modal fade" id="loginModal2" tabindex="-1" role="dialog" aria-labelledby="loginModal2" aria-hidden="true">
    <div class="modal-dialog" role="document" style="margin-top: 183px;background:white">
        
            <div class="modal-header">
                <h5 class="modal-title" id="loginModal2" style="text-align: center;margin: 2px 50% 2px 50%;">{{ __('Login') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
        </div>
        <div class="modal-body">
         
            <h1>Fail</h1>


        </div>

    </div>
  </div>
  
  
  
  
  