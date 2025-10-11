<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Carbon\Carbon;

class AuthenticateLog extends Model
{
    protected $fillable = ['user_id', 'last_login_date', 'last_login_time', 'last_login_ip'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function indonesian_date_format($date)
    {
        $carbon = Carbon::parse($date)->setTimezone('Asia/Jakarta');
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        return $carbon->day . ' ' . $months[$carbon->month] . ' ' . $carbon->year;
    }

    public function time($time)
    {
        return Carbon::parse($time)->setTimezone('Asia/Jakarta')->format('H:i');
    }
}
