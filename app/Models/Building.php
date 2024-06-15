<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Building extends Model
{
    use HasFactory;
    protected $fillable = [
        'building_id',
        'room_id',
        'buildingName',
    ];
    public function rooms(): HasMany{
            return $this->hasMany(Room::class);
        }
    public function floor(): HasMany{
            return $this->hasMany(Floor::class);
        }
    public function floors(): HasMany
    {
            return $this->hasMany(Floor::class);
    }
    public function updateNumberOfRooms()
        {
            $this->update(['numberOfRooms' => $this->rooms()->count()]);
        }
    public function getNumberOfRoomsAttribute(): int
        {
            return $this->rooms()->count();
        }
}
