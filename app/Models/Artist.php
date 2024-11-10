<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Artist extends Model
{
    /** @use HasFactory<\Database\Factories\ArtistFactory> */
    use HasFactory;
    protected $fillable =['name','nationality','city_id'];

    public function concerts(): BelongsToMany{
        return $this->belongsToMany(Concert::class);
    }
    public function city(): BelongsTo {
        return $this->belongsTo(City::class);
    }
}
