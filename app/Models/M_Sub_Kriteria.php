<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Sub_Kriteria extends Model
{
    use HasFactory;

    protected $table = 'm_sub_kriteria';
    protected $primaryKey = 'sub_kriteria_id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'kriteria_id',
        'sub_kriteria_nama',
        
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'timestamp',
        'created_by' => 'int',
    ];

    public function kriteria()
    {
        return $this->belongsTo(M_Kriteria::class, 'kriteria_id');
    }
}

