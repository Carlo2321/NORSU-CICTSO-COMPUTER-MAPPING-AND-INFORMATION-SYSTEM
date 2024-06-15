<?php

namespace App\Models;

use App\Models\Floor;
use App\Models\Building;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'building_id',
        'roomName',
        'floor_id',
        'top',
        'left'
    ];

        public function building(): BelongsTo{
            return $this->belongsTo(Building::class);
        }
        public function computers(): HasMany{
            return $this->hasMany(Computer::class);
        }
        public function floor(): BelongsTo
        {
            return $this->belongsTo(Floor::class);
        }
        public function getNumberOfComputersAttribute(): int
        {
            return $this->computers()->count();
        }
        public function updateNumberOfComputers()
        {
            $this->update(['numberOfComputers' => $this->computers()->count()]);
        }
        public function getFaultyComputersCountAttribute()
        {
            return $this->computers->where('working', false)->count();
        }
        public function getWorkingComputersCountAttribute()
        {
            return $this->computers->where('working', true)->count();
        }



}
