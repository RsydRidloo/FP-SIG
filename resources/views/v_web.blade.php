@extends('layouts.frontend')
@section('content')

    <div id="map" style="width: 100%; height: 500px;"></div>

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

        @foreach ($kecamatan as $data)
            var data{{ $data->id_kecamatan }} = L.layerGroup();
        @endforeach
            var rumahsakit = L.layerGroup();

        var map = L.map('map', {
            center: [-6.895402972424101, 112.04268604311875],
            zoom: 11,
            layers: [peta2,
                @foreach ($kecamatan as $data)
                    data{{ $data->id_kecamatan }},
                @endforeach
                rumahsakit,
            ]
        });

        var baseMaps = {
            "Grayscale": peta1,
            "Satellite": peta2,
            "Streets": peta3,
            "Dark": peta4,
        };

        var overlayer = {
            @foreach ($kecamatan as $data)
                "{{ $data->kecamatan }}" : data{{ $data->id_kecamatan }},
            @endforeach
            "Rumah Sakit" : rumahsakit,
        };

        L.control.layers(baseMaps, overlayer).addTo(map);

        @foreach ($kecamatan as $data)
            L.geoJSON(<?= $data->geojson ?>,{
            style : {
            color : 'white',
            fillColor : '{{ $data->warna }}',
            fillOpacity : 0.5,
            },
            }).addTo(data{{ $data->id_kecamatan }});
        @endforeach

        @foreach ($rumahsakit as $data)
            var iconrumahsakit = L.icon({
            iconUrl: '{{ asset('icon') }}/{{ $data->icon }}',
            iconSize: [40, 55], // size of the icon
            });
        
             var informasi = '<table class="table table-bordered"><tr><th></th colspan="2"><th><img src="{{ asset('foto') }}/{{ $data->foto }}" width="220px"></th></tr><tbody><tr><td>Nama Rumah Sakit</td><td>: {{ $data->nama_rumahsakit }}</td></tr><tr><td>Spesialis</td><td>: {{ $data->spesialis }}</td></tr><tr><td>No Telepon</td><td>: {{ $data->telepon }}</td></tr><tr><td colspan="2" class="text-center"><a href="/detailrumahsakit/{{ $data->id_rumahsakit }}" class="btn btn-sm btn-primary">Detail</a></td></tr></tbody></table>';
        
            L.marker([<?= $data->posisi ?>],{icon: iconrumahsakit})
            .addTo(rumahsakit)
            .bindPopup(informasi);
        
        
        @endforeach

        
    </script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
