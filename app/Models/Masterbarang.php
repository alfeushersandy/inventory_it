<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masterbarang extends Model
{
    use HasFactory;
    protected $table = 'master_barang';
    protected $primaryKey = 'id_barang';
    protected $guarded = ['id_barang'];

    public function lokasi(){
        return $this->hasMany(Lokasi::class, 'id_lokasi', 'lokasi_id');
    }

    public function kategori(){
        return $this->hasMany(Kategori::class, 'id_kategori', 'kategori_id');
    }
}
