<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Concert extends Model
{
    /** @use HasFactory<\Database\Factories\ConcertFactory> */
    use HasFactory;
    protected $fillable = ['name','description','date','duration','image'];
    public function artists() : BelongsToMany{
        return $this->belongsToMany(Artist::class);
    }
}
