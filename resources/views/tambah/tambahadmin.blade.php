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
        <h1>Tambah Admin</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('halaman.admin') }}">Home</a></li>
                <li class="breadcrumb-item active">Tambah Admin</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
    
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Tambah Admin</h5>
                        </div>
                        <div class="card-body">
    
                            <!-- General Form Elements -->
                            <form action="{{ route('admin.store') }}" method="POST">
                                @csrf
    
                                <div class="form-group row mb-3">
                                    <label for="nama_admin" class="col-sm-3 col-form-label">Nama Admin</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama_admin" name="nama_admin" required>
                                    </div>
                                </div>
    
                                <div class="form-group row mb-3">
                                    <label for="email" class="col-sm-3 col-form-label">email</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>
    
                                <div class="form-group row mb-3">
                                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                </div>
    
                                <div class="form-group row mb-3">
                                    <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="alamat" name="alamat">
                                    </div>
                                </div>
    
                                <div class="form-group row mb-3">
                                    <label for="no_telepon" class="col-sm-3 col-form-label">No Telepon</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="no_telepon" name="no_telepon">
                                    </div>
                                </div>
    
                                <div class="form-group row mb-3">
                                    <label for="tanggal_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                                    </div>
                                </div>
    
                                <div class="form-group row mb-3">
                                    <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-9">
                                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                                            <option value="" selected>Jenis Kelamin</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
    
                                <div class="form-group row mb-3">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{ route('halaman.admin') }}" class="btn btn-secondary ml-2">Cancel</a>
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
