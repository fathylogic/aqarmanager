<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  use AliAbdalla\Tafqeet\Core\Tafqeet;
class Payment  extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

'payment_for','cancel_reason','payment_status','receved_by','contract_id', 'maincenter_id','center_id','unit_id','remender_amount','is_for_sale_product','product_desc','p_date', 'p_dateh', 'amount','amount_txt', 'payment_no', 'emp_id', 'payment_type', 'status', 'year_m', 'year_h', 'sereal', 'actual_date', 'actual_dateh', 'notes', 'created_at', 'updated_at', 'created_by', 'updated_by', 'img'

];

protected $table = 'payments';

    protected static  function booted()
    {
//        static::updating(function ($model) {
//            // Check if amount is being updated
//            if ($model->isDirty('amount') && $model->contract_id) {
//                $originalAmount = $model->getOriginal('amount');
//                $newAmount = $model->amount;
//                $difference = $newAmount - $originalAmount;
//
//                if ($difference != 0) {
//                    // Find the next payment in the same contract
//                    $nextPayment = Payment::where('contract_id', $model->contract_id)
//                        ->where('id', '!=', $model->id)
//                        ->where('p_date', '>', $model->p_date)
//
//
//                        ->orderBy('p_date', 'asc')
//                        ->orderBy('sereal', 'asc')
//                        ->first();
//
//                    if ($nextPayment) {
//                        // Adjust the next payment amount
//                        $nextPayment->amount = $nextPayment->amount - $difference;
//                        $nextPayment->save();
//                    } elseif ($difference < 0) {
//                        // Create new payment with the difference if no next payment exists
//                        Payment::create([
//                            'contract_id' => $model->contract_id,
//                            'maincenter_id' => $model->maincenter_id,
//                            'center_id' => $model->center_id,
//                            'unit_id' => $model->unit_id,
//                            'payment_for' => $model->payment_for,
//                            'payment_type' => $model->payment_type,
//                            'amount' => abs($difference),
//                            'p_date' => $model->p_date,
//                            'p_dateh' => $model->p_dateh,
//                            'year_m' => $model->year_m,
//                            'year_h' => $model->year_h,
//                            'status' => $model->status,
//                            'created_by' => $model->updated_by ?? $model->created_by,
//                        ]);
//                    }
//                }
//            }
//        });
    }

    public function paymentType()
    {
        return $this->belongsTo(Payment_type::class, 'payment_type');
    }

    public function paymentFor()
    {
        return $this->belongsTo(Payment_for::class, 'payment_for');
    }
	public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }
    public function maincenter()
    {
        return $this->belongsTo(Maincenter::class, 'maincenter_id');
    }
    public function center()
    {
        return $this->belongsTo(Center::class, 'center_id');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }
    public function amountText()
    {
       if($this->amount>0)
            return   Tafqeet::arablic($this->amount);
        else return '' ;
    }




}
