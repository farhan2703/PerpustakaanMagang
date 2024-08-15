<!DOCTYPE html>
<html lang="en">

<head>
    @include('template.header')
</head>

<body>

<header id="header" class="header fixed-top d-flex align-items-center">
    @include('template.headerbody')
</header>

<aside id="sidebar" class="sidebar">
    @include('template.sidebar')
</aside>

<main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit Admin</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('halaman.admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Edit Admin</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Edit Admin</h5>
                            </div>
                            <div class="card-body">

                                <!-- General Form Elements -->
                                <form action="{{ route('admin.update', $admin->id_admin) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group row mb-3">
                                        <label for="nama_admin" class="col-sm-3 col-form-label">Nama Admin</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="nama_admin" name="nama_admin" value="{{ $admin->nama_admin }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="email" class="col-sm-3 col-form-label">email</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="email" name="email" value="{{ $admin->email }}" required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" id="password" name="password">
                                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password</small>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $admin->alamat }}">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="no_telepon" class="col-sm-3 col-form-label">No Telepon</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="{{ $admin->no_telepon }}">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $admin->tanggal_lahir }}">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-9">
                                            <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                                                <option value="" disabled>Jenis Kelamin</option>
                                                <option value="Laki-laki" {{ $admin->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="Perempuan" {{ $admin->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <div class="col-sm-9 offset-sm-3">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <a href="{{ route('halaman.admin') }}" class="btn btn-secondary ms-2">Cancel</a>
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

    </main><!-- End #main -->

    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{assets('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{assets('assets/js/main.js')}}"></script>

</body>

</html>
