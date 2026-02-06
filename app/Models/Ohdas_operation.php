<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ohdas_operation  extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [


        'ohda_id',
        'op_type',
        'sarf_id',
        'amount',
        'created_at',
        'last_amount',
        'masder',
        'updated_at'
    ];

    protected static function booted()
    {
        static::deleting(function ($model) {

            $ohda = Ohda::find($model->ohda_id);
            if (!$ohda) return false;

            $ohda->raseed += ($model->op_type == '-')
                ? $model->amount
                : -$model->amount;

            $ohda->save();
            return true;
        });
    }
     public function ohda()
    {
        return $this->belongsTo(Ohda::class, 'ohda_id');
    }
    public function sarf()
    {
        return $this->belongsTo(Sarf::class, 'sarf_id');
    }
     public function opType()
    {
         if( $this->op_type=='+')
            return 'ايداع' ;
        else return 'سحب' ;
    }

}
