@extends('layouts.app')

@section('content')
<style>
    .container {
        margin-left: 15rem; 

    }
    .container-mt{
    	margin-top: 7rem;
    }
</style>
<div class="container my-5">
	
    <div class="row justify-content-center container-mt">
    	@if(Session::has('success'))
    <div class="row justify-content-center mt-3">
        <div class="col-md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <style>
        /* Smooth opacity fade */
        .fade-out {
            transition: opacity 0.5s ease;
            opacity: 0;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const alert = document.getElementById("success-alert");
            if (alert) {
                setTimeout(() => {
                    alert.classList.add("fade-out"); // fade out via CSS
                    setTimeout(() => {
                        alert.remove(); // remove from DOM
                    }, 500); // after fade completes
                }, 2000); // 2 seconds wait
            }
        });
    </script>
@endif

        <div class="col-md-11">
            <div class="card shadow-sm rounded-4">
                <div class="card-header d-flex justify-content-between align-items-center bg-light">
                    <h4 class="mb-0 text-dark">Role List</h4>
                    <a href="{{ route('add_role') }}" class="btn btn-primary btn-sm">Add Role</a>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Role</th>
                                <th colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($role as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->role }}</td>
                                    @php $editID = Crypt::encrypt($user->id) @endphp
                                    <td>
                                        <a href="{{ url('edit_role/' . $editID) }}" class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                    <td>
                                        <a href="{{ url('delete_role/' . $user->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this role?')">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-end">
                        {{ $role->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
