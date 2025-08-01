@extends('layouts.app')
@section('content')
<style>
    .conter-mt{
        margin-top: 4rem;
        margin-left: 15rem;
    }
</style>
<div class="container py-5">
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row justify-content-center conter-mt">
        <div class="col-lg-8 col-lg-12">
            <div class="card shadow rounded-4">
                <div class="card-header bg-light text-center">
                    <h4 class="mb-0">Add Role</h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('add_role') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('role') is-invalid @enderror" 
                                   id="role" 
                                   name="role" 
                                   value="{{ old('role') }}" 
                                   placeholder="Enter role name">
                            @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success px-5">Submit</button>
                        </div>
                    </form>
                </div> <!-- card-body -->
            </div> <!-- card -->
        </div> <!-- col -->
    </div> <!-- row -->
</div>
@endsection
