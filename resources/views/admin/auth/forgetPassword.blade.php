@extends('layouts.login-app')   
@section('css')

@endsection
@section('content')
    <!-- loader starts-->
    <div class="loader-wrapper">
      <div class="loader"> 
        <div class="loader4"></div>
      </div>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
      <div class="container-fluid p-0">
        <div class="row">
          <div class="col-12">     
            <div class="login-card login-dark">
              <div>
                <div><a class="logo" href="index.html"> <img class="img-fluid for-dark" src="{{asset('admin/assets/images/logo/logo.png')}}" alt="looginpage" style="width: 10em; border-radius: 0.5em;"><img class="img-fluid for-light" src="{{asset('admin/assets/images/logo/logo.png')}}" alt="looginpage" style="width: 10em; border-radius: 0.5em;"></a></div>
                @if($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        @if($message = Session::get('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ $message }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $error)
                                    <strong>{{ $error }}</strong><br>
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                <div class="login-main"> 
                  <form class="theme-form" action="{{ route('forget.password.post') }}" method="POST">
                    @csrf
                    <h4>Reset Your Password</h4>
                    
                    
                    
                   
                    <div class="form-group">
                      <label class="col-form-label">Email</label>
                      <div class="form-input position-relative">
                        <input class="form-control" type="email" name="email" required="" placeholder="test@gmail.com">
                        @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                        
                      </div>
                    </div>
                                    <div class="row form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
                                 <div class="col-md-12">
                                    <label for="password" class=" control-label">Captcha</label>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="captcha">
                                       <span >{!! captcha_img() !!}</span>
                                       <svg style="   
                                          margin-top: -32px;
                                          margin-left: -10px;
                                          background: #e579ba;
                                          padding: 3px;
                                          width: 24px;
                                          height: 24px;
                                          border-radius: 50%;
                                          color: white;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise btn-refresh" viewBox="0 0 16 16">
                                          <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"></path>
                                          <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"></path>
                                       </svg>
                                    </div>
                                 </div>
                                 <div class="col-md-8">
                                    <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                                    @if ($errors->has('captcha'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                    @endif
                                 </div>
                              </div>
                    
                    <div class="form-group mb-0">
                      <div class="checkbox p-0">
                        <input id="checkbox1" type="checkbox">
                        <label class="text-muted" for="checkbox1">Remember password</label>
                      </div>
                      <button class="btn btn-primary btn-block w-100" type="submit">Send Password Reset Link </button>
                    </div>
                    <p class="mt-4 mb-0 text-center">Already have an password?<a class="ms-2" href="{{route('login')}}">Sign in</a></p>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection