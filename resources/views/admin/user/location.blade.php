@extends('layouts.admin_app')
@section('content')
	<div class="container" style="margin-top: 1%;">
		@if(Session::has('success'))
            <div class="alert alert-success">
            {{ Session::get('success') }}
            </div>
          @endif
		<div class="row justify-content-center">
	        <div class="col-md-11">
	        	<div class="card-header" style="text-align: center; padding-bottom: 3%; font-size: 26px; color: #000000">Location List<a href="{{route('add-location')}}" class="btn btn-info" style="float:right">Add Location</a></div>
	            	<div style="overflow-x: scroll;">
		              <table class="table table-bordered table-striped" id="system_table">
						    <thead>
						        <tr>
						            <th>Sr. No.</th>
						            <th>Location</th>
						            <th colspan="2">Action</th>
						        </tr>
						    </thead>
						    <tbody>
						        @foreach ($location as $index => $user)
						        <tr>
						            <td>{{ $loop->iteration }}</td> 
						            <td>{{ $user->location }}</td>     

						
						            <td>
						                <a href="{{route('edit' ,$user->id)}}" class="btn btn-info"> <i class="fa fa-edit"></i> Edit
										</a>
						                <a href="javascript:void(0)" class="btn btn-danger btn-sm delete-btn" data-id="{{ $user->id }}">
									    <i class="fas fa-trash-alt"></i> Delete
									</a>

						            </td>
						        </tr>
						        @endforeach
						    </tbody>
						</table>

				</div>
				<!-- pagination -->
				{{ $location->links() }}
	        </div>
	    </div>
    </div>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function() {
            let itemId = this.getAttribute("data-id");
            
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "location_delete/" + itemId;
                }
            });
        });
    });
});

</script>
@endsection