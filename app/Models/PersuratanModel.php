<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersuratanModel extends Model
{
    use HasFactory;

    protected $table = "persuratan";
    protected $primaryKey = "persuratan_id";

    protected $fillable = [
        'penduduk_id',
        'nomor_surat',
        'keterangan',
        'tanggal_persuratan'
    ];
}
