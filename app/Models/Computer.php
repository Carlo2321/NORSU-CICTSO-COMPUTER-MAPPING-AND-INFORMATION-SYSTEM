<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Computer extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $fillable =[
        'room_id',
        'computerName',
        'ipAddress',
        'macAddress',
        'working',
        'top',
        'remarks',
        'left'

    ];

    public function room(): BelongsTo{
        return $this->belongsTo(Room::class);
    }
    public static function countWorkingComputers(): int
    {
        return static::where('working', true)->count();
    }

    public static function countNotWorkingComputers(): int
    {
        return static::where('working', false)->count();
    }
    public function showMapping(Computer $computer)
    {
        return view('computer.mapping', ['computer' => $computer]);
    }
    /**
     * Get the options for logging the model.
     *
     * @return \Spatie\Activitylog\LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['computerName', 'macAddress', 'remarks', 'ipAddress', 'room_id', 'working'])
            ->logOnlyDirty()
            ->useLogName('computer')
            ->setDescriptionForEvent(fn(string $eventName) => "Computer has been {$eventName}");
    }
}
