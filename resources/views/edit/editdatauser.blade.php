<!DOCTYPE html>
<html lang="en">

<head>
    @include('templatemember.header')
</head>

<body>

<header id="header" class="header fixed-top d-flex align-items-center">
    @include('templatemember.headerbody')
</header>

<aside id="sidebar" class="sidebar">
    @include('templatemember.sidebar')
</aside>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Data User</h1>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Data User</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('datauser.updateRole', $member->id_member) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Input untuk Nama -->
                    <div class="form-group">
                        <label for="nama" class="text-label">Nama *</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $member->nama) }}" readonly>
                        </div>
                    </div>

                    <!-- Input untuk No Telepon -->
                    <div class="form-group">
                        <label for="no_telepon" class="text-label">No Telepon *</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                            </div>
                            <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $member->no_telepon) }}" readonly>
                        </div>
                    </div>

                    <!-- Input untuk Email -->
                    <div class="form-group">
                        <label for="email" class="text-label">Email *</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                            </div>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $member->email) }}" readonly>
                        </div>
                    </div>

                    <!-- Checkbox untuk Roles -->
                    <div class="form-group">
                        <label class="text-label">Roles *</label>
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
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update Roles</button>
                        <button type="button" class="btn btn-light" onclick="window.location='{{ route('halaman.datauser') }}'">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

@include('templatemember.scripts')

</body>
</html>
