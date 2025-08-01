<h1>Forgot Password Email</h1>
   
You can reset password from bellow link:
<a href="{{ route('reset.password.get', $token) }}">Reset Password</a>
<br>
<h4>If Reset Password is not working , click below link </h4>
<a href="{{ route('reset.password.get', $token) }}">{{ route('reset.password.get', $token) }}</a>
<br><br><br><br>