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
	        	<div class="card-header" style="text-align: center; padding-bottom: 3%; font-size: 26px; color: #000000">Designation List<a href="{{route('add_designation')}}" class="btn btn-info" style="float:right">Add Designation</a></div>
	            	<div style="overflow-x: scroll;">
		              <table class="table table-bordered table-striped" id="system_table">
		                <thead>
			                <tr>
			                  <th>#</th>
			                
			                  <th>Designation</th>
			              
			              
			                  <th colspan="2" >Action</th>
			                </tr>
		                </thead>
		                <tbody>
		               		@foreach ($designations as $user)
			                <tr>
				                <td>{{ $user->id }}</td>
				               
				               
				               
				                <td>{{ $user->designation}}</td>  
				            
				             
				             @php $editID = Crypt::encrypt($user->id) @endphp
				            <td>
				            	<a href="edit_designation/{{ $editID}}"  class="btn btn-info">Edit</a>
				             <a href="delete_designation/{{ $user->id}}"  class="btn btn-danger">delete</a>

				             <button class="btn btn-{{ $user->status == 1 ? 'success' : 'danger' }} toggle-status"
									        data-id="{{ $user->id }}"
									        data-state="{{ $user->status }}">
									    {{ $user->status == 1 ? 'Active' : 'Inactive' }}
									</button>

									
				         </td>

				               
			                </tr>
		              @endforeach
		              </tbody>
             		</table>
				</div>
				<!-- pagination -->
				{{ $designations->links() }}
	        </div>
	    </div>
    </div>
										<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script>
   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

   $(document).ready(function() {
    $('.toggle-status').click(function() {
        let button = $(this);
        let id = button.data('id');
        let currentStatus = button.data('state');
        let newStatus = currentStatus ? 0 : 1;

        $.ajax({
            type: 'POST',
            url: '{{ route("update.status.designation") }}',
            data: {
                id: id,
                status: newStatus
            },
            success: function(response) {
                if (response.success) {
                    button.data('state', newStatus);
                    button.removeClass(currentStatus ? 'btn-success' : 'btn-danger')
                          .addClass(newStatus ? 'btn-success' : 'btn-danger')
                          .text(newStatus ? 'Active' : 'Inactive');
                    alert('Status updated successfully!');
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert('Error updating status. Check the console for details.');
            }
        });
    });
});


</script>
@endsection