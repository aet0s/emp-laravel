@extends('layouts.app')
@section('content')
<style type="text/css">
    .mt-top {
        margin-top: 8rem;
        margin-left: 15rem;
    }

    .custom-dropdown {
        position: relative;
        display: inline-block;
        margin-left: 20rem;
        width: max-content;
    }

    .custom-btn {
        padding: 0.5rem 1rem;
        background-color: #14296d;
        border: 1px solid #ccc;
        color: #fff;
        cursor: pointer;
        border-radius: 4px;
        user-select: none;
        width: 160px; /* Fix width to align with dropdown */
        text-align: left; /* Align text same way as dropdown items */
    }

    .custom-dropdown-menu {
        display: none;
        position: absolute;
        width: max-content;
        background-color: #14296d;
        color: #fff;
        border: 1px solid #ddd;
        min-width: 160px; /* Match button width */
        z-index: 1000;
        margin-top: 5px;
        border-radius: 4px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        margin-left: 3; /* Align dropdown left edge with button */
    }

    /* Show dropdown on hover */
    .custom-dropdown:hover .custom-dropdown-menu {
        display: block !important;
    }

    .custom-dropdown-menu.show {
        display: block;
    }

    .custom-dropdown-item {
        padding: 10px 15px;
        display: block;
        color: #fff;
        text-decoration: none;
        cursor: pointer;
        font-weight: 500;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        transition: background-color 0.3s ease;
    }

    .custom-dropdown-item:last-child {
        border-bottom: none;
    }

    .custom-dropdown-item:hover {
        background-color: #1f3a8a;
        color: #fff;
        text-decoration: none;
    }
</style>

<div class="container mt-top">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

            <form method="POST" action="{{ url('/update_role_permission/' . $role_id) }}">
                @csrf
                <input type="hidden" name="role" value="{{ $role_id }}">

                <div class="row align-items-center mb-4">
                    <div class="col-md-6">
                        <h4 class="mb-0 text-dark">Roles & Permission</h4>
                    </div>
                    <div class="col-md-3 text-end">
                        @php $selectedRole = $role->firstWhere('id', $role_id); @endphp
                        <div class="custom-dropdown">
                            <button type="button" class="custom-btn" id="dropdownButton">
                                {{ $selectedRole ? $selectedRole->role : 'Select Role..' }}
                            </button>
                            <div class="custom-dropdown-menu">
                                @foreach($role as $roles)
                                    <a href="{{ url('/role_permission_edit', $roles->id) }}" class="custom-dropdown-item" data-name="{{ $roles->role }}">
                                        {{ $roles->role }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Page</th>
                                <th>Page Action</th>
                                <th style="display:none;">Button Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages_permission as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        <div class="form-check form-switch d-flex align-items-center">
                                            <input type="checkbox"
                                                class="form-check-input flexSwitchCheckDefault me-2"
                                                name="options_outlined[]"
                                                value="{{ $user->id }}"
                                                id="switch{{ $user->id }}"
                                                @if($user->page_action == 1) checked @endif>

                                            <label class="form-check-label" for="switch{{ $user->id }}">
                                                <span class="switch-label-text" id="switch-label-{{ $user->id }}">
                                                    {{ $user->page_action == 1 ? 'ON' : 'OFF' }}
                                                </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td style="display:none;">
                                        @php $checkedValue = explode(',', $user->button_action); @endphp
                                        <div class="d-flex flex-wrap">
                                            <div class="form-check me-2">
                                                <input type="checkbox" class="form-check-input"
                                                    name="button_action_delete_{{ $user->id }}"
                                                    value="1" id="delete{{ $user->id }}"
                                                    @if(isset($checkedValue[0]) && $checkedValue[0] == 1) checked @endif>
                                                <label class="form-check-label" for="delete{{ $user->id }}">Delete</label>
                                            </div>
                                            <div class="form-check me-2">
                                                <input type="checkbox" class="form-check-input"
                                                    name="button_action_edit_{{ $user->id }}"
                                                    value="2" id="edit{{ $user->id }}"
                                                    @if(isset($checkedValue[1]) && $checkedValue[1] == 2) checked @endif>
                                                <label class="form-check-label" for="edit{{ $user->id }}">Edit</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                    name="button_action_view_{{ $user->id }}"
                                                    value="3" id="view{{ $user->id }}"
                                                    @if(isset($checkedValue[2]) && $checkedValue[2] == 3) checked @endif>
                                                <label class="form-check-label" for="view{{ $user->id }}">View</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success mt-3 d-none" id="submitBtn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- jQuery CDN --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function () {
        // Toggle dropdown menu on button click
        $('#dropdownButton').on('click', function () {
            $('.custom-dropdown-menu').toggleClass('show');
        });

        // Dropdown item click: update button text & redirect
        $('.custom-dropdown-item').on('click', function (e) {
            e.preventDefault();
            const roleName = $(this).data('name');
            $('#dropdownButton').text(roleName);
            $('.custom-dropdown-menu').removeClass('show');
            setTimeout(() => {
                window.location.href = $(this).attr('href');
            }, 300);
        });

        // Close dropdown if clicking outside
        $(document).on('click', function (e) {
            if (!$(e.target).closest('.custom-dropdown').length) {
                $('.custom-dropdown-menu').removeClass('show');
            }
        });

        // Handle page action toggle switch
        $('.flexSwitchCheckDefault').on('change', function () {
            let status = $(this).is(':checked') ? 1 : 0;
            let page_id = $(this).val();

            // Update ON/OFF label text
            $('#switch-label-' + page_id).text(status === 1 ? 'ON' : 'OFF');

            $.ajax({
                url: '{{ url("update_role_page_permission") }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status,
                    page_id: page_id
                },
                success: function (response) {
                    if (response === 1) {
                        console.log('Updated successfully');
                        alert('Permission updated successfully!');  // Success message
                    } else {
                        alert('Error occurred while updating');
                    }
                },
                error: function () {
                    alert('AJAX error occurred');
                }
            });
        });
    });
</script>

@endsection
