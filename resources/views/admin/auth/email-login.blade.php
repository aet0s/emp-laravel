 @extends('layouts.admin.login-app')   
    <!-- END: Head -->
    @section('content')
    <body class="login">
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col min-h-screen">
                    <div class="my-auto">
                        <img alt="admin" class="-intro-x w-1/2 -mt-16" src="{{asset('admin/dist/images/Ghaziabad_Development_Authority.png')}}" style="width:75%;">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            A few more clicks to 
                            <br>
                            sign in to your account.
                        </div>
                        <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Manage all your account details at one place</div>
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <img src="{{asset('admin/dist/images/logo.png')}}" style="height: 75px;">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left" style="margin-top:30px;">
                        Login Using
                        </h2><br>
                        <label>
                            <input type="radio" id="citizenLoginTypeOtpId" name="hosReqTypelogin" value="O" class="loginTypeRadio" onclick="redirectToUrl('{{route('login')}}')">
                            Mobile & OTP
                        </label>

                        <label>
                            <input type="radio" id="citizenLoginTypeLoginId" name="hosReqTypelogin" value="L" class="loginTypeRadio" checked onclick="redirectToUrl('{{route('email-login')}}')">
                            Email ID/Login-ID & Password
                        </label>
                        @if($message = Session::get('success'))
					      <div class="alert alert-success alert-block">
					        <button type="button" class="close" data-dismiss="alert">×</button>
					        <strong>{{ $message }}</strong>   
					      </div>
						@endif
					    @if($message = Session::get('error'))
					      <div class="alert alert-danger alert-block">
					        <button type="button" class="close" data-dismiss="alert">×</button>
					        <strong>{{ $message }}</strong> 
					      </div>
					    @endif
					    @if($errors->any())
					      <div class="alert alert-danger alert-block">
					        <button type="button" class="close" data-dismiss="alert">×</button>
					        @foreach ($errors->all() as $error)
				                <strong>{{ $error }}</strong>
				            @endforeach
					      </div>
					    @endif
                        <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
                        <form action="{{route('custom-login')}}" method="post" enctype="multipart/form-data"> 
                            @csrf
                        <div class="intro-x mt-8">
                            <label><b>Email address</b></label>
                            <input autocomplete="off" type="email"  name="email" class="intro-x login__input form-control py-3 px-4 block" placeholder="Enter your email" style="width:467px;"><br>
                            <label><b>Password</b></label>
                             <input type="password" id="password" class="intro-x login__input form-control py-3 px-4 block" placeholder="Password" name="password" style="width:467px;">
                             <span toggle="#password" class="fa fa-eye field-icon toggle-password" onclick="togglePassword()"></span>
                        </div>
                     
                        <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm">
                           <div class="flex items-center mr-auto">
                             <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
                                  <label><b>Captcha</b></label>
                                      <div class="col-md-6">
                                         <input id="captcha" type="text" class="intro-x login__input form-control py-3 px-4 block" placeholder="Enter Captcha" name="captcha" style="width:467px;">
                                          <div class="captcha">
                                          <center><span>{!! captcha_img() !!}</span></center>
                                          <svg style="margin-top: -39px;margin-left: 316px;background: #e579ba;padding: 3px;width: 24px;height: 24px;border-radius: 50%;color: white;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise btn-refresh" viewBox="0 0 16 16">
                                              <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"></path>
                                              <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"></path>
                                            </svg>
                                          </div>
                                         
                                          @if ($errors->has('captcha'))
                                              <span class="help-block">
                                                  <strong>{{ $errors->first('captcha') }}</strong>
                                              </span>
                                          @endif
                                      </div>
                              </div>
                            </div>
                            
                        </div>
                        <a href="{{ route('forget.password.get') }}">Forgot Password?</a> 
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Login</button>
                            <a  href="{{route('user-registration')}}" class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Register</a>
                        </div>
                      </form>
                        <div class="intro-x xl:mt-24 text-slate-600 dark:text-slate-500 text-center xl:text-left"> By signin up, you agree to our <a class="text-primary dark:text-slate-200" href="#">Terms and Conditions</a> & <a class="text-primary dark:text-slate-200" href="#">Privacy Policy</a>  <br> For Support Call <a class="text-primary dark:text-slate-200" href="#"> 9654916779</a></div>
                    </div>
                </div>
                <!-- END: Login Form -->
            </div>
        </div>
@endsection  
<script src="{{asset('admin/dist/js/jquery-3.6.0.min.js')}}"></script>   
<script>
    function redirectToUrl(url) {
        window.location.href = url;
    }
</script>


       
        
       