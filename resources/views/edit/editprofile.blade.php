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
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li> --}}
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <img src="{{ asset($user->foto_profil) }}" alt="Profile" class="rounded-circle" style="width: 150px; height: 150px;">
                        <h2>{{ $user->nama }}</h2>
                        <h3>{{ $user->role }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Profile Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Full Name</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->nama }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8">{{ $user->no_telepon }}</div>
                                </div>
                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                
                                    <!-- Nama -->
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $user->nama) }}">
                                    </div>
                                
                                    <!-- No Telepon -->
                                    <div class="form-group">
                                        <label for="no_telepon">No Telepon</label>
                                        <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="{{ old('no_telepon', $user->no_telepon) }}">
                                    </div>
                                
                                    <!-- Email -->
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
                                    </div>
                                
                                    <!-- Password -->
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                        <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                                    </div>
                                
                                    <!-- Foto Profil -->
                                    <!-- Foto Profil -->
                                    <div class="form-group">
                                        <label for="foto_profil">Foto Profil</label>
                                        <input type="file" class="form-control-file" id="foto_profil" name="foto_profil">
                                        @if($user->foto_profil)
                                            <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Profile" class="img-thumbnail mt-2" style="width: 150px; height: 150px;">
                                        @endif
                                    </div>

                                
                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                </form>
                                
                            </div>
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->


<!-- Vendor JS Files -->
@include('templatemember.scripts')
<script src="assets/js/main.js"></script>

</body>
</html>
