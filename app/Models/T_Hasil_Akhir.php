<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_Hasil_Akhir extends Model
{
    use HasFactory;

    protected $table = 't_hasil_akhir';
    protected $primaryKey = 'hasil_akhir_id';

    protected $fillable = [
        'siswa_id',
        'jurusan_id',
        'hasil_akhir_nilai',
        'created_by'
    ];

    // Define the relationship with the Siswa model
    public function siswa()
    {
        return $this->belongsTo(D_Siswa::class, 'siswa_id');
    }

    // Define the relationship with the Jurusan model
    public function jurusan()
    {
        return $this->belongsTo(M_Jurusan::class, 'jurusan_id');
    }
}
