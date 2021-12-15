<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RumahSakitModel;
use App\Models\SpesialisModel;
use App\Models\KecamatanModel;

class RumahSakitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->RumahSakitModel = new RumahSakitModel();
        $this->SpesialisModel = new SpesialisModel();
        $this->KecamatanModel = new KecamatanModel();
    }


    public function index()
    {
        $data = [
            'title' => 'Rumah Sakit',
            'rumahsakit' => $this->RumahSakitModel->AllData(),

        ];
        return view('admin.rumahsakit.v_index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add Rumah Sakit',
            'spesialis' => $this->SpesialisModel->AllData(),
            'kecamatan' => $this->KecamatanModel->AllData(),

        ];
        return view('admin.rumahsakit.v_add', $data);
    }

    public function insert()
    {
        Request()->validate(
            [
                'nama_rumahsakit' => 'required',
                'telepon' => 'required',
                'id_kecamatan' => 'required',
                'id_spesialis' => 'required',
                'alamat' => 'required',
                'posisi' => 'required',
                'deskripsi' => 'required',
                'foto' => 'required|max:1024',


            ],
            [
                'nama_rumahsakit.required' => 'Wajib Untuk Diisi !',
                'telepon.required' => 'Wajib Untuk Diisi !',
                'id_kecamatan.required' => 'Wajib Untuk Diisi !',
                'id_spesialis.required' => 'Wajib Untuk Diisi !',
                'alamat.required' => 'Wajib Untuk Diisi !',
                'posisi.required' => 'Wajib Untuk Diisi !',
                'deskripsi.required' => 'Wajib Untuk Diisi !',
                'foto.required' => 'Wajib Untuk Diisi !',
                'foto.max' => 'Foto Max 1024 KB !',
            ]
        );

        //Jika validasi berhasil maka simpan ke database
        $file = Request()->foto;
        $filename =  $file->getClientOriginalName();
        $file->move(public_path('foto'), $filename);

        $data = [
            'nama_rumahsakit' => Request()->nama_rumahsakit,
            'telepon' => Request()->telepon,
            'id_kecamatan' => Request()->id_kecamatan,
            'id_spesialis' => Request()->id_spesialis,
            'alamat' => Request()->alamat,
            'posisi' => Request()->posisi,
            'deskripsi' => Request()->deskripsi,
            'foto' => $filename,
        ];

        $this->RumahSakitModel->InsertData($data);
        return redirect()->route('rumahsakit')->with('pesan', 'Data berhasil Di Tambahkan');
    }

    public function edit($id_rumahsakit)
    {
        $data = [
            'title' => 'Edit Data Rumah Sakit',
            'rumahsakit' => $this->RumahSakitModel->DetailData($id_rumahsakit),
            'kecamatan' => $this->KecamatanModel->AllData(),
            'spesialis' => $this->SpesialisModel->AllData(),



        ];
        return view('admin.rumahsakit.v_edit', $data);
    }

    public function update($id_rumahsakit)
    {
        Request()->validate(
            [
                'nama_rumahsakit' => 'required',
                'telepon' => 'required',
                'id_kecamatan' => 'required',
                'id_spesialis' => 'required',
                'alamat' => 'required',
                'posisi' => 'required',
                'deskripsi' => 'required',
                'foto' => 'max:1024',


            ],
            [
                'nama_rumahsakit.required' => 'Wajib Untuk Diisi !',
                'telepon.required' => 'Wajib Untuk Diisi !',
                'id_kecamatan.required' => 'Wajib Untuk Diisi !',
                'id_spesialis.required' => 'Wajib Untuk Diisi !',
                'alamat.required' => 'Wajib Untuk Diisi !',
                'posisi.required' => 'Wajib Untuk Diisi !',
                'deskripsi.required' => 'Wajib Untuk Diisi !',
                'foto.max' => 'Foto Max 1024 KB !',
            ]
        );

        if (Request()->foto <> "") {
            //hapus foto lama
            $rumahsakit = $this->RumahSakitModel->DetailData($id_rumahsakit);
            if ($rumahsakit->foto <> "") {
                unlink(public_path('foto') . "/" . $rumahsakit->foto);
            }
            //Jika ingin mengganti foto
            $file = Request()->foto;
            $filename =  $file->getClientOriginalName();
            $file->move(public_path('foto'), $filename);

            $data = [
                'nama_rumahsakit' => Request()->nama_rumahsakit,
                'telepon' => Request()->telepon,
                'id_kecamatan' => Request()->id_kecamatan,
                'id_spesialis' => Request()->id_spesialis,
                'alamat' => Request()->alamat,
                'posisi' => Request()->posisi,
                'deskripsi' => Request()->deskripsi,
                'foto' => $filename,
            ];

            $this->RumahSakitModel->UpdateData($id_rumahsakit, $data);
        } else {
            //jika tidak mengganti foto
            $data = [
                'nama_rumahsakit' => Request()->nama_rumahsakit,
                'telepon' => Request()->telepon,
                'id_kecamatan' => Request()->id_kecamatan,
                'id_spesialis' => Request()->id_spesialis,
                'alamat' => Request()->alamat,
                'posisi' => Request()->posisi,
                'deskripsi' => Request()->deskripsi,
            ];

            $this->RumahSakitModel->InsertData($data);
        }
        return redirect()->route('rumahsakit')->with('pesan', 'Data berhasil Di Update');
    }
    public function delete($id_rumahsakit)
    {
        //hapus icon lama
        $rumahsakit = $this->RumahSakitModel->DetailData($id_rumahsakit);
        if ($rumahsakit->foto <> "") {
            unlink(public_path('foto') . "/" . $rumahsakit->foto);
        }
        $this->RumahSakitModel->DeleteData($id_rumahsakit);
        return redirect()->route('rumahsakit')->with('pesan', 'Data berhasil Di Hapus');
    }
}
