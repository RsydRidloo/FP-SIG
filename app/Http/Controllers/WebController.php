<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebModel;

class WebController extends Controller
{
    public function __construct()
    {
        $this->WebModel = new WebModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Pemetaan',
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'rumahsakit' => $this->WebModel->AllDataRumahSakit(),
            'spesialis' => $this->WebModel->DataSpesialis(),

        ];
        return view('v_web', $data);
    }

    public function kecamatan($id_kecamatan)
    {
        $kec = $this->WebModel->DetailKecamatan($id_kecamatan);

        $data = [
            'title' => 'Kecamatan ' . $kec->kecamatan,
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'rumahsakit' => $this->WebModel->DataRumahSakit($id_kecamatan),
            'spesialis' => $this->WebModel->DataSpesialis(),
            'kec' => $kec,


        ];
        return view('v_kecamatan', $data);
    }

    public function spesialis($id_spesialis)
    {
        $spesi = $this->WebModel->DetailSpesialis($id_spesialis);

        $data = [
            'title' => 'Spesialis ' . $spesi->spesialis,
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'rumahsakit' => $this->WebModel->DataRumahSakitSpesialis($id_spesialis),
            'spesialis' => $this->WebModel->DataSpesialis(),

        ];
        return view('v_spesialis', $data);
    }

    public function detailrumahsakit($id_rumahsakit)
    {
        $rumahsakit = $this->WebModel->DetailDataRumahSakit($id_rumahsakit);

        $data = [
            'title' => 'Detail Rumah Sakit ' . $rumahsakit->nama_rumahsakit,
            'kecamatan' => $this->WebModel->DataKecamatan(),
            'spesialis' => $this->WebModel->DataSpesialis(),
            'rumahsakit' => $rumahsakit,
        ];
        return view('v_detailrumahsakit', $data);
    }
}
