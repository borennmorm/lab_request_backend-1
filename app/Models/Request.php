<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'lab_id',
        'session_id',
        'user_id',
        'request_date',
        'major',
        'subject',
        'generation',
        'software_need',
        'number_of_student',
        'additional',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}
