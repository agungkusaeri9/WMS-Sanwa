<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    use HasFactory;
    protected $table = 'stock_outs';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function details()
    {
        return $this->hasMany(StockOutDetail::class);
    }

    public static function getNewCode()
    {
        $prefix = 'SO';
        $lastCode = self::query()
            ->orderBy('id', 'desc')
            ->value('code');

        if ($lastCode) {
            // Ambil angka terakhir dari kode (misal SPL001 -> 001)
            $lastNumber = intval(substr($lastCode, strlen($prefix)));
            $newNumber = $lastNumber + 1; // Tambahkan 1
        } else {
            // Jika belum ada data, mulai dari 1
            $newNumber = 1;
        }
        // Format angka menjadi tiga digit, misalnya 001, 002
        return $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }
}