<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\ContractEvent;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ContractExtendController extends Controller
{
    public function store(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {

            $contract = Contract::findOrFail($id);

            ContractEvent::create([
                'contract_id' => $contract->id,
                'event_type' => 'extend',
                'event_date' => now(),
                'effective_date' => $contract->end_date,
                'notes' => 'تمديد حتى '.$request->new_end_date,
                'created_by' => auth()->id()
            ]);

            $contract->update([
                'end_date' => $request->new_end_date,
                'contract_status' => 'extended'
            ]);
        });

        return back()->with('success','تم تمديد العقد');
    }
}
