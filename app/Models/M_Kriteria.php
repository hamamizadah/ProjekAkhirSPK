<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Kriteria extends Model
{
    use HasFactory;

    // Nama tabel yang berhubungan dengan model ini
    protected $table = 'm_kriteria';

    // Primary key dari tabel
    protected $primaryKey = 'kriteria_id';

    // Tipe data dari primary key
    protected $keyType = 'int';

    // Apakah primary key auto-incrementing
    public $incrementing = true;

    // Kolom-kolom yang bisa diisi secara massal
    protected $fillable = [
        'kriteria_nama',
        'create_by'
    ];

    // Kolom-kolom yang di-cast ke tipe data tertentu
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'timestamp',
        'create_by' => 'int',
    ];

    // Menentukan apakah model harus menggunakan kolom timestamps
    public $timestamps = true;

    // Menyesuaikan format timestamps
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    // Definisikan relasi dengan User
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'create_by', 'id');
    }

    
}
