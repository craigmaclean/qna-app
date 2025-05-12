<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'contractor_first_name',
        'contractor_last_name',
        'contractor_company',
        'contractor_email',
        'contractor_phone',
        'contractor_title',
    ];

    public function bids()
    {
        return $this->belongsToMany(Bid::class, 'bids_contractors')->withTimestamps();
    }

}
