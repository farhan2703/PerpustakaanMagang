@extends('layouts.layouts')

@section('main')
<section class="section">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Data Role</h5>
                    {{-- <div class="text-end">
                        <a href="{{ route('pengembalian.create') }}" class="btn btn-success" title="Add" style="margin-bottom:10px;">
                            <i class="bi bi-plus"></i>
                        </a>
                    </div> --}}
                        {{-- @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <strong>Success!</strong> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
                            </div>
                        @endif --}}
    
                        <div class="table-responsive">
                            <table id="roleTable" class="table table-bordered table-responsive-md">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>idRole</th>
                                        <th>Nama</th>
                                        <th>Guard Name</th>
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
    </div>
    </div>
</section>
    <input type="hidden" id="role-table-url" value="{{ route('tableRole') }}">
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

