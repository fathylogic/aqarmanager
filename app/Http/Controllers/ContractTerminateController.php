<?php

namespace App\Http\Controllers;

use AliAbdalla\Tafqeet\Core\Tafqeet;
use Alkoumi\LaravelHijriDate\Hijri;
use App\Models\All_file;
use App\Models\Center;
use App\Models\Contract;
use App\Models\ContractEvent;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Notification;
use App\Models\Ohda;
use App\Models\Othercontent;
use App\Models\Payment;
use App\Models\Payment_type;
use App\Models\Payroll;
use App\Models\Recipient;
use App\Models\Renter;
use App\Models\Sarf;
use App\Models\Sarf_type;
use App\Models\Service_type;
use App\Models\Source_type;
use App\Models\Unit;
use App\Models\Unit_type;
use App\Models\User;
use Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;


class ContractTerminateController extends Controller
{
    public function store(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {

            $contract = Contract::findOrFail($id);

            $contract->update([
                'contract_status' => 'terminated',
                'is_active' => 3
            ]);

            ContractEvent::create([
                'contract_id' => $contract->id,
                'event_type' => 'terminate',
                'event_date' => now(),
                'effective_date' => $request->effective_date,
                'old_renter_id' => $contract->renter_id,
                'notes' => $request->notes,
                'created_by' => auth()->id()
            ]);

            Payment::where('contract_id',$contract->id)
                ->where('status',0)
                ->where('p_date','>',$request->effective_date)
                ->update([
                    'payment_status' => 'cancelled',
                    'cancel_reason' => 'contract_terminated'
                ]);
        });

        return back()->with('success','تم فسخ العقد بنجاح');
    }
}
