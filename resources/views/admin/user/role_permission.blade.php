@extends('layouts.app')
@section('content')
<div class="container" style="margin-top: 5%; margin-left: 20rem;">
   @if(Session::has('success'))
   <div class="alert alert-success">
      {{ Session::get('success') }}
   </div>
   @endif
   <div class="row justify-content-center">
      <div class="col-md-11">
         <form method="post" action="{{url('/submit_role_permission')}}">
            @csrf
            <div class="row card-header">
               <div class="col-md-6">
                  <div  style=" font-size: 26px; color: #000000">Roles & Permission </div>
               </div>
               <div class="col-md-3 mb-2" style="margin-left: 10rem;">
                  <div>
                     <label>Select Role..</label>
                     <select class="form-control " name="role" id="role_select">
                        @foreach($role as $roles)
                        <option value="{{$roles->id}}"><a href=""> {{$roles->role}}</a></option>
                        @endforeach
                     </select>
                  </div>
               </div>
            </div>
            <div >
               <table class="table table-bordered table-striped" id="system_table">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Page</th>
                        <th>Page Action</th>
                     </tr>
                  </thead>
                  <tbody id="ajax_data">
                     @foreach ($pages_permission as $key => $user)
                     <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $user->name}}</td>
                        <td>
                           <div class="form-check form-switch" style="padding-left: 2.25rem;">
                              <input  class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" style="width:4em; height: 2em;" name="options_outlined[]" value="{{$user->id }}">
                              <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                           </div>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
            <!-- pagination -->
            <button class="btn btn-md btn-success mt-4 justify-content-center" >Submit</button>
         </form>
      </div>
   </div>
</div>
@endsection