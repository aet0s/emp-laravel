@extends('layouts.app')
@section('content')
<style>
    .conter-mt{
        margin-top: 4rem;
        margin-left: 15rem;
    }
</style>
<div class="container py-5">
    
    <div class="row justify-content-center conter-mt">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

        <div class="col-lg-8 col-lg-12">
            <div class="card shadow rounded-4">
                <div class="card-header bg-light text-center">
                    <h4 class="mb-0">Update Role</h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{route('edit_role',$role->id)}}" method="post" enctype="multipart/form-data" >
                    @csrf
                   @method('PUT')
                  <div class="form-row" style="margin-top: 3%;">

                     <div class="form-group col-md-12">
                        <label for="role">Role<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" value="{{$role->role}}"  name="role" id="role">
                       @error('role')
                                  <span style="color:red;">{{$message}}</span>
                                @enderror
                     </div>

 
                 
                    <div class="form-group col-md-12 mt-3" style="text-align: center;">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
                </div> <!-- card-body -->
            </div> <!-- card -->
        </div> <!-- col -->
    </div> <!-- row -->
</div>
@endsection
