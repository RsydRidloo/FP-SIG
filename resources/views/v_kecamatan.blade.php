@extends('layouts.frontend')
@section('content')

    <div id="map" style="width: 100%; height: 500px;"></div>

    <div class="col-sm-12">
        <br>
        <br>
        <div class="text-center">
            <h2><b>Data Rumah Sakit {{ $title }}</b></h2>
        </div>
        <table id="example1" class="table table-bordered table-stripe text-small">
            <thead>
                <tr>
                    <th width="50px" class="text-center">No</th>
                    <th>Nama Rumah Sakit</th>
                    <th width="100px" class="text-center">Telepon</th>
                    <th class="text-center">Spesialis</th>
                    <th class="
                    text-center">Koordinat</th>

                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach ($rumahsakit as $data)
                    <tr>
                        <td class="
                        text-center">{{ $no++ }}</td>
                        <td>{{ $data->nama_rumahsakit }}</td>
                        <td>{{ $data->telepon }}</td>
                        <td>{{ $data->spesialis }}</td>
                        <td>{{ $data->posisi }}</td>
                    </tr>
                @endforeach
            </tbody>
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

        @foreach ($spesialis as $data)
            var spesialis{{ $data->id_spesialis }} = L.layerGroup();
        @endforeach

        var data{{ $kec->id_kecamatan }} = L.layerGroup();

        var map = L.map('map', {
            center: [-6.895402972424101, 112.04268604311875],
            zoom: 11,
            layers: [peta2,data{{ $kec->id_kecamatan }},
            @foreach ($spesialis as $data)
                spesialis{{ $data->id_spesialis }},
            @endforeach
             ]
        });

        var baseMaps = {
            "Grayscale": peta1,
            "Satellite": peta2,
            "Streets": peta3,
            "Dark": peta4,
        };

        var overlayer = {
            "{{ $kec->kecamatan }}": data{{ $kec->id_kecamatan }},
            @foreach ($spesialis as $data)
            "{{ $data->spesialis }}": spesialis{{ $data->id_spesialis }},
            @endforeach

        };

        L.control.layers(baseMaps, overlayer).addTo(map);

        var kec = L.geoJSON(<?= $kec->geojson ?>, {
            style: {
                color: 'white',
                fillColor: '{{ $kec->warna }}',
                fillOpacity: 0.5,
            },
        }).addTo(data{{ $kec->id_kecamatan }});

        map.fitBounds(kec.getBounds());

        @foreach ($rumahsakit as $data)
            var iconrumahsakit = L.icon({
            iconUrl: '{{ asset('icon') }}/{{ $data->icon }}',
            iconSize: [40, 55], // size of the icon
            });
        
             var informasi = '<table class="table table-bordered"><tr><th></th colspan="2"><th><img src="{{ asset('foto') }}/{{ $data->foto }}" width="220px"></th></tr><tbody><tr><td>Nama Rumah Sakit</td><td>: {{ $data->nama_rumahsakit }}</td></tr><tr><td>Spesialis</td><td>: {{ $data->spesialis }}</td></tr><tr><td>No Telepon</td><td>: {{ $data->telepon }}</td></tr><tr><td colspan="2" class="text-center"><a href="/detailrumahsakit/{{ $data->id_rumahsakit }}" class="btn btn-sm btn-primary">Detail</a></td></tr></tbody></table>';
        
            L.marker([<?= $data->posisi ?>],{icon: iconrumahsakit})
            .addTo(spesialis{{ $data->id_spesialis }})
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
