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
                  @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <table id="kategoriBuku" class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Kategori</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Tanggal Dibuat</th>
                                    <th scope="col">Tanggal Diperbarui</th>
                                    <th></th>
                                </tr>
                            </thead>
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
                        </table>
                        <!-- Pagination links -->
                        <div class="d-flex justify-content-end">
                            {{ $kategoriBuku->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
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
    <script src="assets/js/main.js"></script>

</body>

</html>
