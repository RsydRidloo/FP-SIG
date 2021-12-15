<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WebModel extends Model
{
    public function DataKecamatan()
    {
        return DB::table('kecamatan')
            ->get();
    }

    public function DataSpesialis()
    {
        return DB::table('spesialis')
            ->get();
    }

    public function DetailSpesialis($id_spesialis)
    {
        return DB::table('spesialis')->where('id_spesialis', $id_spesialis)
            ->first();
    }

    public function DataRumahSakitSpesialis($id_spesialis)
    {
        return DB::table('rumah_sakit')
            ->join('spesialis', 'spesialis.id_spesialis', '=', 'rumah_sakit.id_spesialis')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'rumah_sakit.id_kecamatan')
            ->where('rumah_sakit.id_spesialis', $id_spesialis)
            ->get();
    }

    public function DetailKecamatan($id_kecamatan)
    {
        return DB::table('kecamatan')->where('id_kecamatan', $id_kecamatan)
            ->first();
    }

    public function DataRumahSakit($id_kecamatan)
    {
        return DB::table('rumah_sakit')
            ->join('spesialis', 'spesialis.id_spesialis', '=', 'rumah_sakit.id_spesialis')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'rumah_sakit.id_kecamatan')
            ->where('rumah_sakit.id_kecamatan', $id_kecamatan)
            ->get();
    }


    public function AllDataRumahSakit()
    {
        return DB::table('rumah_sakit')
            ->join('spesialis', 'spesialis.id_spesialis', '=', 'rumah_sakit.id_spesialis')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'rumah_sakit.id_kecamatan')
            ->get();
    }

    public function DetailDataRumahSakit($id_rumahsakit)
    {
        return DB::table('rumah_sakit')
            ->join('spesialis', 'spesialis.id_spesialis', '=', 'rumah_sakit.id_spesialis')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'rumah_sakit.id_kecamatan')
            ->where('id_rumahsakit', $id_rumahsakit)
            ->first();
    }
}
