<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;
    protected $table = 'lokasi';
    protected $primaryKey = 'id_lokasi';
    protected $fillable = ['nama_lokasi'];

    public function master_barang(){
        return $this->hasMany(Masterbarang::class, 'lokasi_id', 'id_lokasi');
    }

    public function serah_terima(){
        return $this->hasMany(Serah_terima::class, 'lokasi_id', 'id_lokasi');
    }

    public function serah_terima_detail(){
        return $this->hasMany(Serah_terima_detail::class, 'lokasi_awal_id', 'id_lokasi');
    }

    public function departemen()
    {
        return $this->hasOne(Departemen::class, 'id_dept', 'departemen');
    }
}
