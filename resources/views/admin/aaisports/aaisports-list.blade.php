@extends('layouts.app')

@section('content')

<div class="page-body">
    <!-- Messages -->
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12">
                    @if($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End messages -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="card col-md-12 p-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Aai Sports List</h4>
                    <a data-bs-toggle="modal" data-bs-target="#addaaisportsModal" class="btn btn-info btn-sm">Impoart Csv</a>
                </div>

                <!-- Toast Notification -->
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                    <div id="statusToast" class="toast align-items-center text-white bg-success border-0"
                         role="alert" aria-live="assertive" aria-atomic="true" style="display:none;">
                        <div class="d-flex">
                            <div class="toast-body" id="toastMessage">Status updated successfully!</div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                </div>

                <!-- Search -->
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <form action="{{ url('aaisports-search') }}" method="GET" class="input-group">
                                <input type="search" name="aaisports_name" class="form-control" placeholder="Search by aaisports" value="{{ request('aaisports_name') }}">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-search"></i>
                                </button>
                                <a href="{{ url('aaisports-list') }}" class="btn btn-primary ms-2">
                                    <i class="fas fa-sync-alt"></i>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Page title</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($aaisports as $value)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>{{ $value->page_title }}</td>

<!--                                         <td>
                                            <select name="status" class="status-select form-select form-select-sm"
                                                    data-id="{{ $value->id }}"
                                                    style="color: {{ $value->status == 1 ? 'green' : 'red' }};">
                                                <option value="1" {{ $value->status == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $value->status == 0 ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </td> -->
                                       <td class="text-center">
                                            <a href="{{ url('update-spoarts/' . $value->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <!-- <button type="button" class="btn btn-sm btn-danger delete-btn" data-type="aaisports" data-id="{{ $value->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button> -->
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No data found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination">
                        {{ $aaisports->links() }}
                    </div>
                </div>

                <!-- Add aaisports Modal -->
                <div class="modal fade" id="addaaisportsModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-4 shadow">
                            <div class="modal-header bg-secondary text-white">
                                <h5 class="modal-title">Add New aaisports</h5>
                                <button type="button" class="btn-close btn-close-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                           <form action="{{ url('aaisports-import') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Upload CSV File</label>
                                        <input type="file" class="form-control" name="upload_file" accept=".csv" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-info">Import Airports</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    var toastEl = document.getElementById('statusToast');
    var toast = new bootstrap.Toast(toastEl);

    $('.status-select').change(function() {
        let select = $(this);
        let status = select.val();
        let aaisportsId = select.data('id');

        $.ajax({
            url: 'update-aaisports-status/' + aaisportsId,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function(response) {
                // Update color of select text based on status
                select.css('color', status == 1 ? 'green' : 'red');
                $('#toastMessage').text('Status updated successfully!');
                toastEl.classList.remove('bg-danger');
                toastEl.classList.add('bg-success');
                toast.show();
            },
            error: function(xhr) {
                $('#toastMessage').text('Failed to update status.');
                toastEl.classList.remove('bg-success');
                toastEl.classList.add('bg-danger');
                toast.show();

                // Reset color to original after toast hide
                toastEl.addEventListener('hidden.bs.toast', function () {
                    toastEl.classList.remove('bg-danger');
                    toastEl.classList.add('bg-success');
                });
            }
        });
    });
});
</script>

@endsection
