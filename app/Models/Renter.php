<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renter  extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'id_no',
        'nationality',
        'mobile_no',
        'created_by',
        'updated_by',
        'img',
        'employer',
        'id_type',
        'other_no',
        'work_no',
        'work_letter',

        'notes'
    ];
    protected static  function booted()
    {
        static::deleting(function ($model) {

            $model->contracts()->delete();
            $model->contacts()->delete();
        }) ;
    }
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
    public function contacts()
    {
        return $this->hasMany(Renter_contact::class);
    }

public function idType()
    {
        return $this->belongsTo(Id_type::class, 'id_type');
    }
public function nat()
    {
        return $this->belongsTo(Nationality::class, 'nationality');
    }

}
