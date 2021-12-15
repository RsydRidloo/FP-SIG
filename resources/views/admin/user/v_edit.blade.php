@extends('layouts.backend')

@section('content')
    <div class="col-md-12">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Edit Data</h3>

            </div>

            <form action="/user/update/{{ $user->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nama User</label>
                                <input name="name" class="form-control" value="{{ $user->name }}" placeholder="User">
                                <div class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" class="form-control" value="{{ $user->email }}" placeholder="Email"
                                    readonly>
                                <div class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input name="password" class="form-control" value="{{ $user->password }}"
                                    placeholder="Password" readonly>
                                <div class="text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Foto</label>
                                <input type="file" name="foto" class="form-control"
                                    accept="image/png,image/jpg,image/jpeg">
                                <div class="text-danger">
                                    @error('foto')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
                    <a href="/user" class="btn btn-default">Batal</a>
                </div>
            </form>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

@endsection
