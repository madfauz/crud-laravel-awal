@extends('layout.template')

@section('konten')

    {{-- action mengarah ke route controller mahasiswa --}}
 <form action='{{url('mahasiswa/'.$data_edit->nim)}}' method='post'>
    {{-- karna ingin melakukan edit, maka method diubah ke PUT (secara default method nya POST) --}}
    @method('PUT')


    {{-- @csrf menghasilkan token (dibuat otomatis) sebagai penanda agar form valid dan berasal dari halaman yang sama --}}
    @csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <a href='{{ url('mahasiswa') }}' class="btn btn-secondary">kembali</a>
        <div class="mb-3 row">
            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
            <div class="col-sm-10">
                {{ $data_edit->nim }}
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nama' id="nama" value="{{ $data_edit->nama }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='jurusan' id="jurusan" value="{{ $data_edit->jurusan }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
        </div>
    </div>
</form>

@endsection
  