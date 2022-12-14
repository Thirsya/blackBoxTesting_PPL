<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;



class Kategori extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama'
    ];

    public function barang()
    {
        return $this->hasMany(Barang::class);
    }
}
