<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoshuComment extends Model
{
    use HasFactory;

    use HasFactory;
    protected $fillable = [
        'body',
        'user_id',
        'boshujoho_id',
    ];

    public function boshujoho()
    {
        return $this->belongsTo(Boshujoho::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
