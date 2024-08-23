@extends('layouts.layouts')

@section('main')
<section class="section">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Role</h4>
            </div>
            <div class="card-body">
                <!-- Display validation errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Success message -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('role.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <input type="hidden" name="role_id" value="{{ $role->id }}">

                    <!-- Role Name -->
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">Role Name *</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $role->name) }}" required disabled>
                    </div>

                    <!-- Guard Name -->
                    <div class="form-group mb-3">
                        <label for="guard_name" class="form-label">Guard Name *</label>
                        <input type="text" class="form-control" id="guard_name" name="guard_name" value="{{ old('guard_name', $role->guard_name) }}" required disabled>
                    </div>

                    <!-- Permissions -->
                    <div class="form-group mb-3">
                        <label class="form-label">Permissions *</label>
                        <div class="row">
                            @foreach($permissions as $id => $name)
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $id }}" 
                                        {{ in_array($id, $rolePermissions) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $name }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Submit and Cancel Buttons -->
                    <div class="form-group mb-0">
                        <button type="button" class="btn btn-light" onclick="window.location='{{ route('halaman.role') }}'">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@section('css')
<link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/font-awesome/css/all.min.css') }}" rel="stylesheet">
<!-- Add any custom CSS here -->
@endsection

@section('js')
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<!-- Add any custom JS here -->
@endsection

@endsection
