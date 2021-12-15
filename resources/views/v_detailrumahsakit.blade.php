@extends('layouts.frontend')

@section('content')

<div class="col-sm-6">
    <div id="map" style="width: 100%; height: 300px;"></div>

</div>

<div class="col-sm-6">
    <img src="{{ asset('foto') }}/{{ $rumahsakit->foto }}" style="width: 100%; height: 290px;">
</div>

<div class="col-sm-12">
   <table class="table table-bordered">
       <br>
       <br>
    <tr>
        <td width="180px">Nama Rumah Sakit</td>
        <td width="50px">:</td>
        <td>{{ $rumahsakit->nama_rumahsakit }}</td>
    </tr>
    <tr>
        <td width="180px">No Telepon</td>
        <td width="50px">:</td>
        <td>{{ $rumahsakit->telepon }}</td>
    </tr>
       <tr>
           <td>Spesialis</td>
           <td>:</td>
           <td>{{ $rumahsakit->spesialis }}</td>
       </tr>
       <tr>
        <td>Kecamatan</td>
        <td>:</td>
        <td>{{ $rumahsakit->kecamatan }}</td>
    </tr>
    <tr>
        <td>Alamat Rumah Sakit</td>
        <td>:</td>
        <td>{{ $rumahsakit->alamat }}</td>
    </tr>
   </table>
</div>

<script>
    var peta1 = L.tileLayer(
        'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11'
        });

    var peta2 = L.tileLayer(
        'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/satellite-v9'
        });


    var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });

    var peta4 = L.tileLayer(
        'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/dark-v10'
        });

    var map = L.map('map', {
        center: [{{$rumahsakit->posisi}}],
        zoom: 13,
        layers: [peta1],
    });

    var baseMaps = {
        "Grayscale": peta1,
        "Satellite": peta2,
        "Streets": peta3,
        "Dark": peta4,
    };

    L.control.layers(baseMaps).addTo(map);

    var iconrumahsakit = L.icon({
            iconUrl: '{{ asset('icon') }}/{{ $rumahsakit->icon }}',
            iconSize: [40, 55], // size of the icon
            });
        
            L.marker([<?= $rumahsakit->posisi ?>],{icon: iconrumahsakit})
            .addTo(map);

</script>

@endsection