<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SpesialisModel extends Model
{
    public function AllData()
    {
        return DB::table('spesialis')
            ->get();
    }

    public function InsertData($data)
    {
        DB::table('spesialis')
            ->insert($data);
    }

    public function DetailData($id_spesialis)
    {
        return DB::table('spesialis')->where('id_spesialis', $id_spesialis)
            ->first();
    }

    public function UpdateData($id_spesialis, $data)
    {
        DB::table('spesialis')
            ->where('id_spesialis', $id_spesialis)
            ->update($data);
    }

    public function DeleteData($id_spesialis)
    {
        DB::table('spesialis')
            ->where('id_spesialis', $id_spesialis)
            ->delete();
    }
}
