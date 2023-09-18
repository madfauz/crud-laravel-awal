<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class mahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     * contoh cara megakses 127.0.0.1:8000/mahasiswa
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;

        // jika parameter kata kunci terdapat isinya
        $jumlahbaris = 4;
        if(strlen($katakunci)){
            $data = mahasiswa::where('nim', 'like', "%$katakunci%")
            ->orwhere('nama', 'like', "%$katakunci%")
            ->orwhere('jurusan', 'like', "%$katakunci%")
            ->paginate($jumlahbaris);
        } else {
            // mengambil data yang dimiliki tabel mahasiswa
            $data = mahasiswa::orderBy('nim','desc')->paginate($jumlahbaris);
        }

        


        // setiap route yang mengakses class mahasiswaController akan menampilkan view ini
        return view('mahasiswa.index')->with('data_mahasiswa', $data);
    }

    /**
     * Show the form for creating a new resource.
     * contoh cara megakses 127.0.0.1:8000/mahasiswa/create
     */

    
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // menampilkan kembali isian dari input form ketika terjadi error validasi
        Session::flash('nim', $request->nim);
        Session::flash('nama', $request->nama);
        Session::flash('jurusan', $request->jurusan);


        // validasi tiap kolom input dan unique:mahasiswa,nim menjadi tabel acuan terhadap data input yang harus unique
        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswa,nim',
            'nama' => 'required',
            'jurusan' => 'required',
        ],[
            'nim.required' => 'NIM wajib diisi',
            'nim.numeric' => 'NIM harus angka',
            'nim.unique' => 'NIM sudah terdaftar',
            'nama.required' => 'Nama wajib diisi',
            'jurusan.required' => 'Jurusan wajib diisi',

        ]);

        // property yang terdapat di $request berasal dari attribute name dari input form
        $data = [
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
        ];

        // menyimpan $data ke tabel mahasiswa
        mahasiswa::create($data);


        return redirect()->to('mahasiswa')->with('success', 'Berhasil menambahkan data');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // ambil data mahasiswa sesuai nim nya
        $data = mahasiswa::where('nim', $id)->first();
        return view('mahasiswa.edit')->with('data_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validasi tiap kolom input dan unique:mahasiswa,nim menjadi tabel acuan terhadap data input yang harus unique
        $request->validate([
            'nama' => 'required',
            'jurusan' => 'required',
        ],[
            'nama.required' => 'Nama wajib diisi',
            'jurusan.required' => 'Jurusan wajib diisi',
        ]);

        // property yang terdapat di $request berasal dari attribute name dari input form
        $data = [
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
        ];  

        // menyimpan $data ke tabel mahasiswa
        mahasiswa::where('nim', $id)->update($data);


        return redirect()->to('mahasiswa')->with('success', 'Berhasil mengedit data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        mahasiswa::where('nim', $id)->delete();
        return redirect()->to('mahasiswa')->with('success', 'Berhasil menghapus data');
    }
}
