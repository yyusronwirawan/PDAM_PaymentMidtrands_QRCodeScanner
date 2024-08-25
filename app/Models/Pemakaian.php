<?php

namespace App\Models;

use App\Models\Bulan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ramsey\Uuid\Uuid;

class Pemakaian extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'penggunaan_awal',
        'penggunaan_akhir',
        'jumlah_penggunaan',
        'jumlah_pembayaran',
        'batas_bayar',
        'user_id',
        'periode_id',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }

    public function bulan()
    {
        return $this->belongsTo(Bulan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    
}
