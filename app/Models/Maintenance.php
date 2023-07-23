<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    protected $table = 'tb_maintenance';
    protected $primaryKey = 'id_maintenance';
    protected $guarded = ['id_maintenance'];

    public function lokasi(){
        return $this->hasMany(Lokasi::class, 'id_lokasi', 'lokasi_id');
    }

    public function barang(){
        return $this->hasMany(Masterbarang::class, 'id_barang', 'barang_id');
    }

    public function serah(){
        return $this->hasMany(Serah_terima::class, 'id_serah', 'serah_id');
    }
}
