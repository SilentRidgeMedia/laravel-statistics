<?php

namespace SilentRidge\Statistics\Models;

use Illuminate\Database\Eloquent\Model;

class BaseStatisticModel extends Model
{
    protected $casts = [
        'data' => 'array'
    ];

    protected $fillable = [ 'uuid', 'data'];


    public function store(string $uuid, array $data): void
    {
        self::create([
                         'uuid' => $uuid,
                         'data' => $data,
                     ]);
    }

    public function getByUuid(string $uuid)
    {
        return self::where('uuid', $uuid)->first();
    }

    public function remove(string $uuid): void
    {
        self::where('uuid', $uuid)->delete();
    }
}
