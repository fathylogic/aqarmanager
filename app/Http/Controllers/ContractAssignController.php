<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\ContractEvent;
use App\Models\Payment;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ContractAssignController extends Controller
{
    public function store(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {

            $old = Contract::findOrFail($id);

            $old->update([
                'contract_status' => 'assigned',
                'is_active' => 2
            ]);

            $new = Contract::create([
                'start_date' => $request->assign_date,
                'end_date' => $old->end_date,
                'renter_id' => $request->new_renter_id,
                'center_id' => $old->center_id,
                'unit_id' => $old->unit_id,
                'parent_contract_id' => $old->id,
                'contract_status' => 'active',
                'created_by' => auth()->id()
            ]);

            ContractEvent::create([
                'contract_id' => $old->id,
                'event_type' => 'assign',
                'event_date' => now(),
                'effective_date' => $request->assign_date,
                'old_renter_id' => $old->renter_id,
                'new_renter_id' => $request->new_renter_id,
                'created_by' => auth()->id()
            ]);
        });

        return back()->with('success','تم تقبيل العقد بنجاح');
    }
}
