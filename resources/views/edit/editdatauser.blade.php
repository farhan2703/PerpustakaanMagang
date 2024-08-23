@extends('layouts.layouts')

@section('main')

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Data User</h5>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('datauser.updateRole', $member->id_member) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Input untuk Nama -->
                            <div class="form-group row mb-3">
                                <label for="nama" class="col-sm-3 col-form-label">Nama *</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <i class="fa fa-user"></i> </span>
                                        </div>
                                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $member->nama) }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <!-- Input untuk No Telepon -->
                            <div class="form-group row mb-3">
                                <label for="no_telepon" class="col-sm-3 col-form-label">No Telepon *</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        </div>
                                        <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $member->no_telepon) }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <!-- Input untuk Email -->
                            <div class="form-group row mb-3">
                                <label for="email" class="col-sm-3 col-form-label">Email *</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                           <i class="fa fa-envelope"></i> </span>
                                        </div>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $member->email) }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <!-- Checkbox untuk Roles -->
                            <div class="form-group mb-3">
                                <label class="col-form-label">Roles *</label>
                                <div class="row">
                                    @foreach($roles as $role)
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}" 
                                                {{ in_array($role->name, $memberRoles) ? 'checked' : '' }}>
                                                <label class="form-check-label">{{ $role->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Tombol Submit dan Cancel -->
                            <div class="form-group mb-0">
                                <a href="{{ route('halaman.datauser') }}" class="btn btn-light">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Roles</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>

@endsection

@section('css')
<link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/font-awesome/css/all.min.css') }}" rel="stylesheet">
<!-- Add any custom CSS here -->
@endsection

@section('js')
<!-- Add any custom JS here -->
@endsection

@section('scripts')
<!-- Add any additional scripts here -->
@endsection
