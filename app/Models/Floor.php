<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Floor extends Model
{
    use HasFactory;
    protected $fillable = [
        'floor_id',
        'floorNumber',
        'room_id',
        'building_id',
    ];

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }
    public function floor(): BelongsTo{
        return $this->belongsTo(Building::class);
    }
    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }
}
