<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;
    protected $guarded = [];
    //protected $fillable = ['title', 'description'];

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
