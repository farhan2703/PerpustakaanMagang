@extends('layouts.layouts')

@section('main')


<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Peminjaman</h5>
                {{-- <div class="container"> --}}
                    <div class="text-end">
                        <a href="{{ route('peminjamanmember.create') }}" class="btn btn-success" title="Add" style="margin-bottom:10px;">
                            <i class="bi bi-plus"></i>
                        </a>
                    </div>
                        <!-- Hidden input to store user ID -->
                        <input type="hidden" id="user-id" value="{{ Auth::user()->nama }}">
                        <table id="peminjamanmemberTable" class="table table-bordered table-responsive-md">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Judul Buku</th>
                                    <th>Nama Member</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<input type="hidden" id="peminjamanmember-table-url" value="{{ route('tablePeminjamanMember') }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-2.1.3/datatables.min.js"></script>
<script src="{{ asset('main.js') }}"></script>
   
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

