<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract  extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [


       'segel_togary' ,'water_no' ,'electric_no' , 'contract_status','parent_contract_id', 'e_no',  'start_payment_amount', 'no_of_all_payments', 'total_amount', 'delay_fine','period_year', 'period_month', 'period_day',  'start_date', 'end_date', 'start_dateh', 'end_dateh', 'no_of_payments', 'year_amount','services_amount', 'insurance_amount', 'unit_id', 'center_id', 'renter_id', 'notes', 'created_at', 'updated_at', 'created_by', 'updated_by', 'img', 'is_active'
    ];
protected $table = 'contracts';

    protected static  function booted()
    {
        static::deleting(function ($model) {

            $model->payments()->delete();
        }) ;
    }
    public function events()
    {
        return $this->hasMany(ContractEvent::class);
    }

    public function parent()
    {
        return $this->belongsTo(Contract::class,'parent_contract_id');
    }
   public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function renter()
    {

        return $this->belongsTo(Renter::class, 'renter_id');
    }
    public function unit()
    {

        return $this->belongsTo(Unit::class, 'unit_id');
    }
    public function center()
    {

        return $this->belongsTo(Center::class, 'center_id');
    }
    public function maincenter()
    {
        return $this->belongsTo(Maincenter::class, 'maincenter_id');
    }

    public function contractPeriod()
    {
        if (!$this->start_date || !$this->end_date) {
            return null;
        }

        $date1 = new \DateTime($this->start_date);
        $date2 = new \DateTime($this->end_date);
        $date2->modify('+1 day');
        $interval = $date1->diff($date2);

        return [
            'years'  => $interval->y,
            'months' => $interval->m,
            'days'   => $interval->d,
            'total_days' => $interval->days,
        ];
    }

    public function getSumPayments  ()
    {
       $all =  $this->payments ->whereIn('payment_for', [1,2,5])
            ->sum('amount');
       $payed =  $this->payments ->where('status', 1)
           ->whereIn('payment_for', [1,2,5])
            ->sum('amount');
       $notPayed =  $this->payments ->where('status', 0)
           ->whereIn('payment_for', [1,2,5])
            ->sum('amount');

        $allYearPayment =  $this->payments ->whereIn('payment_for', [1,5])
                                           ->sum('amount');

       $allYearPaymentPayed =  $this->payments ->whereIn('payment_for', [1,5])
           ->where('status', 1)
           ->sum('amount');
        $allYearPaymentNotPayed =  $this->payments ->whereIn('payment_for', [1,5])
           ->where('status', 0)
           ->sum('amount');


        return [
            'all'  => $all,
            'payed'  => $payed,
            'notPayed'  => $notPayed,
            'allYearPayment'  => $allYearPayment,
            'allYearPaymentPayed'  => $allYearPaymentPayed,
            'allYearPaymentNotPayed'  => $allYearPaymentNotPayed

        ];

    }


}
