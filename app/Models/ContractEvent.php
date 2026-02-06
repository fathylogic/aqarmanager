<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractEvent extends Model
{
protected $fillable = [
'contract_id','event_type','event_date',
'effective_date','old_renter_id','new_renter_id',
'notes','created_by'
];

public function contract()
{
return $this->belongsTo(Contract::class);
}
}
