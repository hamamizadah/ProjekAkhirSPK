<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Jurusan extends Model
{
    use HasFactory;

    protected $table = 'm_jurusan';
    protected $primaryKey = 'jurusan_id';
    protected $fillable = [
        'jurusan_kode',
        'jurusan_nama',
        'create_by'
    ];

    public $timestamps = true;

    // Define the fields that should be treated as date instances
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the user who created the jurusan.
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'create_by');
    }
}

