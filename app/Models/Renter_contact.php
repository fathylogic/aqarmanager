<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Renter_contact  extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $timestamps = false;
    protected $table = 'renter_contacts';
    protected $fillable = [
        'name',
        'mobile_no',
        'renter_id'
    ];

    function renter()
    {
        return $this->belongsTo(Renter::class, 'renter_id');
    }



}
