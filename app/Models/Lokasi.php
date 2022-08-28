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

    public function barang(){
        return $this->hasMany(Masterbarang::class, 'id_lokasi', 'lokasi_id');
    }
}
