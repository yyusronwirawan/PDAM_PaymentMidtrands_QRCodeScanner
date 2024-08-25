<?php

namespace App\Models;

use App\Models\Bulan;
use App\Models\Tahun;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Periode extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function bulan()
    {
        return $this->belongsTo(Bulan::class);
    }

    public function tahun()
    {
        return $this->belongsTo(Tahun::class);
    }
}
