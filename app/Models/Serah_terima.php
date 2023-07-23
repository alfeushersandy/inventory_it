<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serah_terima extends Model
{
    use HasFactory;
    protected $table = 'serah_terima';
    protected $primaryKey = 'id_serah';
    protected $guarded = ['id_serah'];

    public function lokasi(){
        return $this->hasMany(Lokasi::class, 'id_lokasi', 'lokasi_id');
    }

}
