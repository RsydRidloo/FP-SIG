@extends('layouts.backend')

@section('content')
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $kecamatan }}</h3>

                <p>Kecamatan</p>
            </div>
            <div class="icon">
                <i class="fas fa-cube"></i>
            </div>
            <a href="/kecamatan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $spesialis }}</h3>

                <p>Spesialis</p>
            </div>
            <div class="icon">
                <i class="fas fa-heartbeat"></i>
            </div>
            <a href="/spesialis" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $rumahsakit }}</h3>

                <p>Rumah Sakit</p>
            </div>
            <div class="icon">
                <i class="fas fa-plus"></i>
            </div>
            <a href="/rumahsakit" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $user }}</h3>

                <p>User</p>
            </div>
            <div class="icon">
                <i class="fas fa-user"></i>
            </div>
            <a href="/user" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    
@endsection
