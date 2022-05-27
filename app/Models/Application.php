<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'message', 'user_id', 'attached_file', 'attached_file'];
    protected $dates = ['created_at'];

    public function scopetodayEntry($builder)
    {
        return $builder->where('user_id', auth()->id())->whereRaw('(created_at + INTERVAL 1 DAY) > NOW()');
    }
}
