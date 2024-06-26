<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $guarded = [];
    //protected $fillable = ['title', 'description'];
    protected $dates = ['published_at'];

    public function series()
    {
        return $this->belongsTo(Serie::class);
    }

}
