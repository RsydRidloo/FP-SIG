@extends('layouts.backend')

@section('content')
    <div class="col-md-12">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Add Data</h3>

            </div>

            <form action="/spesialis/insert" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Spesialis</label>
                                <input name="spesialis" class="form-control" placeholder="Spesialis">
                                <div class="text-danger">
                                    @error('spesialis')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Icon</label>
                                <input type="file" name="icon" class="form-control" accept="image/png">
                                <div class="text-danger">
                                    @error('icon')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
                    <button type="submit" class="btn btn-default">Batal</button>
                </div>
            </form>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

@endsection
