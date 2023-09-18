<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    use HasFactory;
    // mengizinkan kolom kolom tersebut untuk diisi
    protected $fillable = ['nim', 'nama', 'jurusan'];
    // menentukan nama tabel tempat model ini digunakan (secara default akan dideteksi dengan nama mahasiswas)
    protected $table = 'mahasiswa';
    // memberitahu bahwa tidak menggunakan timestamps di tabel mahasiswa
    public $timestamps = false;
}
