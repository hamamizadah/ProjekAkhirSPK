<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class T_Profile_Jurusan extends Model
{
    use HasFactory;

    protected $table = 't_profile_jurusan';
    protected $primaryKey = 'profile_id';

    protected $fillable = [
        'jurusan_id',
        'sub_kriteria_id',
        'profile_nilai_target',
        'profile_core',
        'created_by',
    ];

    public function jurusan()
    {
        return $this->belongsTo(M_Jurusan::class, 'jurusan_id', 'jurusan_id');
    }

    public function subKriteria()
    {
        return $this->belongsTo(M_Sub_Kriteria::class, 'sub_kriteria_id', 'sub_kriteria_id');
    }
}
