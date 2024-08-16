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
        <h1>Tambah Member</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Tambah Member</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Tambah Member</h5>
                        </div>
                        <div class="card-body">
                            <!-- Tampilkan Pesan Error Umum -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- General Form Elements -->
                            <form action="{{ route('member.store') }}" method="POST">
                                @csrf

                                <div class="form-group row mb-3">
                                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
                                        @error('nama')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="no_telepon" class="col-sm-3 col-form-label">No Telepon</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon" name="no_telepon" value="{{ old('no_telepon') }}">
                                        @error('no_telepon')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{ route('halaman.member') }}" class="btn btn-secondary ml-2">Cancel</a>
                                    </div>
                                </div>

                            </form>
                            <!-- End General Form Elements -->

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</main>

<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
</footer>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>

</body>

</html>
