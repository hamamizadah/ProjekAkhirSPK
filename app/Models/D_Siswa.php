<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class D_Siswa extends Model
{
    use HasFactory;

    protected $table = 'd_siswa';
    protected $primaryKey = 'siswa_id';

    protected $fillable = [
        'siswa_id',
        'siswa_no_pendaftaran',
        'siswa_nama',
        'siswa_tempat_lahir',
        'siswa_tanggal_lahir',
        'siswa_asal_sekolah',
        'siswa_jenis_kelamin',
        'created_at',
        'updated_at',
        'created_by'
    ];

    public function nilaiSiswa()
    {
        return $this->hasMany(T_Nilai_Siswa::class, 'siswa_id', 'siswa_id');
    }
}
