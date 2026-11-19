<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nama_pegawai',
        'nomor_kontak',
        'jabatan',
        'status',
    ];
}