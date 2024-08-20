@extends('layouts.layouts')

@section('main')


<section class="section">
  <div class="row">
      <div class="card">
          <div class="card-body">
              <h5 class="card-title">Data Pengembalian</h5>
              <div class="container">
                      @if(session('success'))
                          <div class="alert alert-success alert-dismissible fade show">
                              <strong>Success!</strong> {{ session('success') }}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                          </div>
                      @endif
  
                      <!-- Hidden input to store user ID -->
                      <input type="hidden" id="user-id" value="{{ Auth::user()->nama }}">

                      <table id="pgmemberTable" class="table table-responsive-md">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Judul Buku</th>
                                  <th>Nama Member</th>
                                  <th>Tanggal Peminjaman</th>
                                  <th>Tanggal Pengembalian</th>
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
</section>
<input type="hidden" id="pgmember-table-url" value="{{ route('tablePengembalianMember') }}">
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

