<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_Nilai_Siswa extends Model
{
    use HasFactory;

    protected $table = 't_nilai_siswa';
    protected $primaryKey = 'nilai_siswa_id';

    protected $fillable = [
        'siswa_id',
        'sub_kriteria_id',
        'nilai_siswa_count',
        'created_by',
    ];

    public function siswa()
    {
        return $this->belongsTo(D_Siswa::class, 'siswa_id', 'siswa_id');
    }

    public function subKriteria()
    {
        return $this->belongsTo(M_Sub_Kriteria::class, 'sub_kriteria_id', 'sub_kriteria_id');
    }
}
