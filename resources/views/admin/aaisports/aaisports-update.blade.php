@extends('layouts.app')

@section('content')
<div class="page-body">
    <div class="container py-4">
    <!-- Messages -->
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
        <div class="col-md-12">
            <!-- Form -->
    <div class="card mt-3">
        <div class="card-header">
            <h4 class="mb-0">Submit a Document</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('update-aaisports-spoarts/' . $aaisport->id) }}" enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="title" class="form-label">Title:</label>
                <input type="text" id="title" name="title" value="{{ old('title', $aaisport->title) }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="page_title" class="form-label">Page Title:</label>
                <input type="text" id="page_title" name="page_title" value="{{ old('page_title', $aaisport->page_title) }}" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="discription" class="form-label">Description:</label>
                <textarea id="discription" name="discription" class="form-control" rows="3">{{ old('discription', $aaisport->discription) }}</textarea>
            </div>
            <div class="col-md-6">
                <label for="content_category" class="form-label">Content Category:</label>
                <input type="text" id="content_category" name="content_category" value="{{ old('content_category', $aaisport->content_category) }}" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="public_documents" class="form-label">Public Documents:</label>
                <input type="text" id="public_documents" name="public_documents" value="{{ old('public_documents', $aaisport->public_documents) }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="upload_file" class="form-label">Upload File:</label>
                <input type="file" id="upload_file" name="upload_file" class="form-control">
                @if($aaisport->upload_file)
                    <p>Current File: <a href="{{ asset('/' . $aaisport->upload_file) }}" target="_blank">{{ $aaisport->upload_file }}</a></p>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="region" class="form-label">Region:</label>
                <select id="region" name="region" class="form-select">
                    <option value="">Select Region</option>
                    @php
                        $regions = ['All', 'CHQ', 'Eastern Region', 'North Eastern Region', 'Northern Region', 'Southern Region', 'Western Region'];
                    @endphp
                    @foreach($regions as $region)
                        <option value="{{ $region }}" {{ old('region', $aaisport->region) == $region ? 'selected' : '' }}>{{ $region }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label for="airport" class="form-label">Airport: {{ $aaisport->airport }}</label>
                <select id="airport" name="airport" class="form-select">
                    <option value="">Select Airport</option>
                    @foreach($airports as $airport)
                      <option value="{{ $airport }}" 
                        {{ trim(strtolower(old('airport', $aaisport->airport))) == trim(strtolower($airport)) ? 'selected' : '' }}>
                        {{ $airport }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Published Status:</label>
                <div class="form-check form-check-inline">
                    <input type="radio" id="published_yes" name="published_status" value="Yes" class="form-check-input"
                        {{ old('published_status', $aaisport->published_status) == 'Yes' ? 'checked' : '' }}>
                    <label for="published_yes" class="form-check-label">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" id="published_no" name="published_status" value="No" class="form-check-input"
                        {{ old('published_status', $aaisport->published_status) == 'No' ? 'checked' : '' }}>
                    <label for="published_no" class="form-check-label">No</label>
                </div>
            </div>
            <div class="col-md-6">
                <label for="document_number" class="form-label">Document Number:</label>
                <input type="text" id="document_number" name="document_number" value="{{ old('document_number', $aaisport->document_number) }}" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="document_date" class="form-label">Document Date From:</label>
                <input type="date" id="document_date" name="document_date" value="{{ old('document_date', $aaisport->document_date) }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="document_date_to" class="form-label">Document Date To:</label>
                <input type="date" id="document_date_to" name="document_date_to" value="{{ old('document_date_to', $aaisport->document_date_to) }}" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="signing_authority" class="form-label">Signing Authority:</label>
                <input type="text" id="signing_authority" name="signing_authority" value="{{ old('signing_authority', $aaisport->signing_authority) }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">E-mail:</label>
                <input type="email" id="email" name="email" value="{{ old('email', $aaisport->email) }}" class="form-control">
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Update Record</button>
        </div>
    </form>
        </div>
    </div>
        </div>
    </div>

    
</div>
</div>
<script>
    document.getElementById('region').value = "{{ $aaisport->region }}";
</script>

@endsection
