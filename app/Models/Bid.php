<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status_active',
        'user_id',
        'project_name',
        'project_sqft',
        'client_first_name',
        'client_last_name',
        'client_company',
        'client_email',
        'client_phone',
        'general_conditions_percent',
        'overhead_profit_percent',
        'tax_exempt',
        'tax_percent',
        'labor_days',
        'labor_unit_cost',
        'grand_total'
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status_active' => 'boolean',
        'project_sqft' => 'decimal:2',
        'general_conditions_percent' => 'decimal:2',
        'overhead_profit_percent' => 'decimal:2',
        'tax_exempt' => 'boolean',
        'tax_percent' => 'decimal:2',
        'grand_total' => 'decimal:2',
        'labor_days' => 'integer',
        'labor_unit_cost' => 'decimal:2',
        'grand_total' => 'decimal:2'
    ];

    public function contractors()
    {
        return $this->belongsToMany(Contractor::class, 'bids_contractors')->withTimestamps();
    }

    public function subServices()
    {
        return $this->belongsToMany(SubService::class, 'bids_sub_services')
                    ->withPivot(['service_id', 'units', 'quantity', 'adjusted_unit_cost', 'total_cost', 'markup_percent'])
                    ->withTimestamps();
    }


}
