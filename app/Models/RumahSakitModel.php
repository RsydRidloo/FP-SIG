<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RumahSakitModel extends Model
{
    public function AllData()
    {
        return DB::table('rumah_sakit')
            ->join('spesialis', 'spesialis.id_spesialis', '=', 'rumah_sakit.id_spesialis')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'rumah_sakit.id_kecamatan')
            ->get();
    }

    public function InsertData($data)
    {
        DB::table('rumah_sakit')
            ->insert($data);
    }

    public function DetailData($id_rumahsakit)
    {
        return DB::table('rumah_sakit')->where('id_rumahsakit', $id_rumahsakit)
            ->join('spesialis', 'spesialis.id_spesialis', '=', 'rumah_sakit.id_spesialis')
            ->join('kecamatan', 'kecamatan.id_kecamatan', '=', 'rumah_sakit.id_kecamatan')
            ->first();
    }

    public function UpdateData($id_rumahsakit, $data)
    {
        DB::table('rumah_sakit')
            ->where('id_rumahsakit', $id_rumahsakit)
            ->update($data);
    }

    public function DeleteData($id_rumahsakit)
    {
        DB::table('rumah_sakit')
            ->where('id_rumahsakit', $id_rumahsakit)
            ->delete();
    }
}
