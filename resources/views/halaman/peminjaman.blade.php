@extends('layouts.layouts')

@section('main')

<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Peminjaman</h5>
                    <div class="text-end">
                        <a href="{{ route('peminjaman.create') }}" class="btn btn-success" title="Add" style="margin-bottom:10px;">
                            <i class="bi bi-plus"></i>
                        </a>
                    </div>
                    <h5>Daftar Peminjaman</h5>
                       
                            <table id="peminjamanTable" class="table table-responsive-md">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Buku</th>
                                        <th>Nama Member</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Status</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</section>
    <input type="hidden" id="peminjaman-table-url" value="{{ route('tablePeminjaman') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.1.3/datatables.min.js"></script>
    <script src="{{ asset('main.js') }}"></script>
    </body>
    </html>

@endsection

@section('css')
<!-- Add any custom CSS here -->
@endsection

@section('js')
<!-- Add any custom JS here -->
@endsection

@section('scripts')

<!-- Add any additional scripts here -->
@endsection


