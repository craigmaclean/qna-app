<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubService extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sub_service_name',
        'sub_service_description',
        'default_unit_cost',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'default_unit_cost' => 'decimal:2',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }


    public function bids()
    {
        return $this->belongsToMany(Bid::class, 'bids_sub_services')
                    ->withPivot(['service_id', 'units', 'quantity', 'adjusted_unit_cost', 'total_cost', 'markup_percent'])
                    ->withTimestamps();
    }

}
