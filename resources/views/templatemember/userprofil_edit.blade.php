{{-- @extends('admin.dashboard')

@section('content')
<h1 class="h3 mb-3">Ubah Data User</h1>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {!! Form::model(auth()->member(),[
                    'route' => ['userprofil.update',0],
                    'method' => 'PUT',
                ]) !!}


                    <div class="form-group mb-3">
                        <label for="nama">Nama</label>
                        {!! Form::text('nama', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{!! $errors->first('nama') !!}</span>
                    </div>                    <div class="form-group mb-3">
                        <label for="email">email</label>
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{!! $errors->first('email') !!}</span>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        {!! Form::password('password', null, ['class' => 'form-control']) !!}
                        <span class="text-danger">{!! $errors->first('password') !!}</span>
                    </div>

            </div>
           </div>
        </div>
    </div>
</div> --}}
