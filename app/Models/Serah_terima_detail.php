<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serah_terima_detail extends Model
{
    use HasFactory;
    protected $table = 'serah_terima_detail';
    protected $primaryKey = 'id_serah_detail';
    protected $guarded = ['id_serah_detail'];
    
    public function lokasi1()
    {
        return $this->hasOne(Lokasi::class, 'id_lokasi', 'lokasi_awal_id');
    }

    public function lokasi2()
    {
        return $this->hasOne(Lokasi::class, 'id_lokasi', 'lokasi_tujuan_id');
    }

    public function barang(){
        return $this->hasMany(Masterbarang::class, 'id_barang', 'barang_id');
    }

    public function serah(){
        return $this->hasMany(Serah_terima::class, 'id_serah', 'serah_id');
    }
}
