<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->UserModel = new UserModel();
    }


    public function index()
    {
        $data = [
            'title' => 'User',
            'user' => $this->UserModel->AllData(),
        ];
        return view('admin.user.v_index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add User',

        ];
        return view('admin.user.v_add', $data);
    }

    public function insert()
    {
        Request()->validate(
            [
                'name' => 'required',
                'email' => 'required|unique:users,email',
                'foto' => 'required|max:1000',
                'password' => 'required|min:8',

            ],
            [
                'name.required' => 'Wajib Untuk Diisi !',
                'email.required' => 'Wajib Untuk Diisi !',
                'email.unique' => 'Email sudah terdaftar !',
                'foto.required' => 'Wajib Untuk Diisi !',
                'password.required' => 'Wajib Untuk Diisi !',
                'password.min' => 'Password Wajib Min 8 Untuk Diisi !',
            ]
        );

        //Jika validasi berhasil maka simpan ke database

        $file = Request()->foto;
        $filename =  $file->getClientOriginalName();
        $file->move(public_path('foto'), $filename);

        $data = [
            'name' => Request()->name,
            'email' => Request()->email,
            'password' => Hash::make(Request()->password),
            'foto' => $filename,
        ];

        $this->UserModel->InsertData($data);
        return redirect()->route('user')->with('pesan', 'Data berhasil Di Simpan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit User',
            'user' => $this->UserModel->DetailData($id),

        ];
        return view('admin.user.v_edit', $data);
    }

    public function update($id)
    {
        Request()->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required|min:8',

            ],
            [
                'name.required' => 'Wajib Untuk Diisi !',
                'email.required' => 'Wajib Untuk Diisi !',
                'password.required' => 'Wajib Untuk Diisi !',
                'password.min' => 'Password Wajib Min 8 Untuk Diisi !',
            ]
        );

        if (Request()->foto <> "") {
            //hapus icon lama
            $user = $this->UserModel->DetailData($id);
            if ($user->foto <> "") {
                unlink(public_path('foto') . "/" . $user->foto);
            }
            //Jika ingin mengganti icon
            $file = Request()->foto;
            $filename =  $file->getClientOriginalName();
            $file->move(public_path('foto'), $filename);

            $data = [
                'name' => Request()->name,
                'foto' => $filename,
            ];

            $this->UserModel->UpdateData($id, $data);
        } else {
            //jika tidak mengganti icon
            $data = [
                'name' => Request()->name,
            ];

            $this->UserModel->UpdateData($id, $data);
        }
        return redirect()->route('user')->with('pesan', 'Data berhasil Di Update');
    }

    public function delete($id)
    {
        //hapus icon lama
        $user = $this->UserModel->DetailData($id);
        if ($user->foto <> "") {
            unlink(public_path('foto') . "/" . $user->foto);
        }
        $this->UserModel->DeleteData($id);
        return redirect()->route('user')->with('pesan', 'Data berhasil Di Hapus');
    }
}
