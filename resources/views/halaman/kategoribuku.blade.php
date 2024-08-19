<!DOCTYPE html>
<html lang="en">

<head>
    @include('templatemember.header')
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    @include('templatemember.headerbody')
    </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    @include('templatemember.sidebar')
    </aside><!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tabel Kategori Buku</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Kategori Buku</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tabel Kategori Buku</h5>
                    <div class="text-end">
                      <a href="{{ route('addkategoribuku') }}" class="btn btn-success" title="Add" style="margin-bottom:10px;">
                        <i class="bi bi-plus"></i>
                    </a>
                  </div>
                  <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="kategoriTable" class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Tanggal Diperbarui</th>
                                    <th>Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
<<<<<<< HEAD
                            <tbody>
                                @foreach($kategoriBuku as $kategori)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $kategori->nama_kategori }}</td>
                                    <td>{{ $kategori->deskripsi_kategori }}</td>
                                    <td>{{ $kategori->tanggal_dibuat }}</td>
                                    <td>{{ $kategori->tanggal_diperbarui }}</td>
                                    <td>
                                     <a href="{{ route('halaman.kategoribuku.detail', $kategori->id_kategori) }}" class="btn light btn-secondary shadow btn-xs sharp mr-1"><i class="bi bi-info-circle"></i></a>
                                     <form id="editForm_{{ $kategori->id_kategori }}" action="{{ route('halaman.kategoribuku.edit', $kategori->id_kategori) }}" method="GET" style="display: inline;">
                                      @csrf
                                      <button type="submit" class="btn btn-warning shadow btn-xs sharp">
                                          <i class="bi bi-pencil-square"></i>
                                      </button>
                                  </form>

                                        <a href="#" class="btn light btn-danger shadow btn-xs sharp mr-1"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
=======
                            <tbody></tbody>
>>>>>>> 32d440794a4748956fe41f43ee2ab3275116ff93
                        </table>
                    </div>
                </div>
            </div>
<<<<<<< HEAD
        </section>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
    <script>$(document).ready(function() {

        // Menambahkan data kategori buku baru
        $('#submit').click(function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ url('addKategoriBuku') }}",
                type: "post",
                dataType: "json",
                data: $('#kategoriForm').serialize(),
                success: function(response) {
                    $('#kategoriForm')[0].reset();
                    console.log(response);
                    table.ajax.reload();
                }
            });
        });

        // Tampilkan data kategori buku
        var table = $('#kategoriTable').DataTable({
            ajax: "{{ url('getKategoriBuku') }}",
            columns: [
                { "data": "nama_kategori" },
                { "data": "deskripsi_kategori" },
                { "data": "tanggal_dibuat" },
                { "data": "tanggal_diperbarui" },
                {
                    "data": null,
                    render: function(data, type, row) {
                        return `
                            <button data-id="${row.id_kategori}" class="btn btn-info editKategori" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>
                            <button data-id="${row.id_kategori}" class="btn btn-danger deleteKategori"><i class="fa fa-trash"></i></button>`;
                    }
                }
            ]
        });

        // Menangani event klik untuk tombol edit kategori
        $(document).on('click', '.editKategori', function() {
            $.ajax({
                url: "{{ url('getKategoriById') }}",
                type: "post",
                dataType: 'json',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id_kategori": $(this).data('id')
                },
                success: function(response) {
                    $('input[name="id_kategori"]').val(response.data.id_kategori);
                    $('input[name="edit_nama_kategori"]').val(response.data.nama_kategori);
                    $('textarea[name="edit_deskripsi_kategori"]').val(response.data.deskripsi_kategori);
                }
            });
        });

        // Menyimpan perubahan kategori
        $('#updateKategori').click(function(e) {
            e.preventDefault();
            if(confirm('Apakah Anda yakin ingin memperbarui kategori ini?')) {
                $.ajax({
                    url: '{{ url("updateKategoriBuku") }}',
                    type: 'post',
                    dataType: 'json',
                    data: $('#editKategoriForm').serialize(),
                    success: function(response) {
                        $('#editKategoriForm')[0].reset();
                        table.ajax.reload();
                        $('#editModal').modal('hide');
                    }
                });
            }
        });

        // Menghapus kategori
        $(document).on('click', '.deleteKategori', function() {
            if(confirm('Apakah Anda yakin ingin menghapus kategori ini?')){
                $.ajax({
                    url: "{{ url('deleteKategoriBuku') }}",
                    type: "post",
                    dataType: 'json',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id_kategori": $(this).data('id')
                    },
                    success: function(response) {
                        table.ajax.reload();
                    }
                });
            }
        });

    });

    </script>
    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
=======
        </div>
    </div>
</div>
</div>
>>>>>>> 32d440794a4748956fe41f43ee2ab3275116ff93

   @include('templatemember.scripts')
<input type="hidden" id="kategori-table-url" value="{{ route('tableKategori') }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.1.3/datatables.min.js"></script>
<script src="{{ asset('main.js') }}"></script>
</body>
</html>
