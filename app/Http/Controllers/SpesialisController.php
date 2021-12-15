<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpesialisModel;
use Illuminate\Support\Facades\DB;

class SpesialisController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->SpesialisModel = new SpesialisModel();
    }


    public function index()
    {
        $data = [
            'title' => 'Spesialis',
            'spesialis' => $this->SpesialisModel->AllData(),
        ];
        return view('admin.spesialis.v_index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add Spesialis',

        ];
        return view('admin.spesialis.v_add', $data);
    }

    public function insert()
    {
        Request()->validate(
            [
                'spesialis' => 'required',
                'icon' => 'required|max:1024',
            ],
            [
                'spesialis.required' => 'Wajib Untuk Diisi !',
                'icon.required' => 'Wajib Untuk Diisi !',
            ]
        );

        //Jika validasi berhasil maka simpan ke database

        $file = Request()->icon;
        $filename =  $file->getClientOriginalName();
        $file->move(public_path('icon'), $filename);

        $data = [
            'spesialis' => Request()->spesialis,
            'icon' => $filename,
        ];

        $this->SpesialisModel->InsertData($data);
        return redirect()->route('spesialis')->with('pesan', 'Data berhasil Di Simpan');
    }

    public function edit($id_spesialis)
    {
        $data = [
            'title' => 'Edit Data Spesialis',
            'spesialis' => $this->SpesialisModel->DetailData($id_spesialis),

        ];
        return view('admin.spesialis.v_edit', $data);
    }

    public function update($id_spesialis)
    {
        Request()->validate(
            [
                'spesialis' => 'required',
            ],
            [
                'spesialis.required' => 'Wajib Untuk Diisi !',
            ]
        );

        if (Request()->icon <> "") {
            //hapus icon lama
            $spesialis = $this->SpesialisModel->DetailData($id_spesialis);
            if ($spesialis->icon <> "") {
                unlink(public_path('icon') . "/" . $spesialis->icon);
            }
            //Jika ingin mengganti icon
            $file = Request()->icon;
            $filename =  $file->getClientOriginalName();
            $file->move(public_path('icon'), $filename);
            $data = [
                'spesialis' => Request()->spesialis,
                'icon' => $filename,
            ];

            $this->SpesialisModel->UpdateData($id_spesialis, $data);
        } else {
            //jika tidak mengganti icon
            $data = [
                'spesialis' => Request()->spesialis,
            ];

            $this->SpesialisModel->UpdateData($id_spesialis, $data);
        }
        return redirect()->route('spesialis')->with('pesan', 'Data berhasil Di Update');
    }
    public function delete($id_spesialis)
    {
        //hapus icon lama
        $spesialis = $this->SpesialisModel->DetailData($id_spesialis);
        if ($spesialis->icon <> "") {
            unlink(public_path('icon') . "/" . $spesialis->icon);
        }
        $this->SpesialisModel->DeleteData($id_spesialis);
        return redirect()->route('spesialis')->with('pesan', 'Data berhasil Di Hapus');
    }
}
