<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Center;
use App\Models\Maincenter;
use App\Models\Location;
use App\Models\Othercontent;
use App\Models\Unit;
use App\Models\Payment_type;
use App\Models\Ohda;
use App\Models\Source_type;
use App\Models\Sarf_type;
use App\Models\Service_type;
use App\Models\Recipient;
use App\Models\Payroll;
use Illuminate\Support\Facades\DB;
use App\Models\Unit_type;
use App\Models\Contract;
use App\Models\Payment;
use App\Models\Sarf;
use App\Models\Employee;
use App\Models\All_file;
use Spatie\Permission\Models\Role;

use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Alkoumi\LaravelHijriDate\Hijri;
use Illuminate\Support\Carbon;
use App\Models\Notification;
use AliAbdalla\Tafqeet\Core\Tafqeet;
use Illuminate\Contracts\Database\Eloquent\Builder;



class MaincenterController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = Maincenter::with('centers.units', 'employee')->get();
        // dd($data[0]->location->name) ;
        $current_user = User::find(Auth::user()->id);
        $locations = Location::get();
        $others = Othercontent::get();
        return view('maincenters.index', compact('data', 'locations','others', 'current_user'))
             ->with('i', 0);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {

        $current_user = User::find(Auth::user()->id);
        $emps = Employee::get();
        return view('maincenters.create', compact('emps', 'current_user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $img = '';
        if ($request->has('btn_add_center')) {



            if ($request->has('file')) {
                $uploadedFile = $request->file('file');
                $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
                $img = $uploadedFile->storeAs('uploads', $storedName, 'public');
            }

            $this->validate($request, [
                'center_name' => 'required',
                'center_location' => 'required',
            //    'woter_no' => 'required',
             //   'electric_no' => 'required',
                'maincenter_id'   =>  'required'
            ], [
            'center_name' => 'يجب ادخال اسم العمارة',
            'center_location' => 'يجب اختيار الموقع',
            'maincenter_id'   =>  'يجب اختيار المركز الرئيسي '

            //  'woter_no' => 'required',
            //  'electric_no' => 'required'
        ]);

            $input = $request->all();
            $input['img'] = $img;
            $input['created_by'] = Auth::user()->id;
                if(isset($request->othercontents))
                {
                     $input['othercontents'] = implode(",",$request->othercontents) ;
                }
            $center =  Center::create($input);
        } else {
            if ($request->has('file')) {
                $uploadedFile = $request->file('file');
                $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
                $img = $uploadedFile->storeAs('uploads', $storedName, 'public');
            }

            $this->validate($request, [
                'name' => 'required',
             //   'iban'   => ['required', 'regex:/^SA\d{22}$/'],
            ], [
                'name' => 'يجب تسجيل الاسم ',
             //   'iban.regex'   => 'IBAN يجب ان يبدأ ب SA  ويتبعه 22 رقم .',

            ]);

            $input = $request->all();
            $input['img'] = $img;
            $input['created_by'] = Auth::user()->id;
            if(isset($request->othercontents))
                {
                     $input['othercontents'] = implode(",",$request->othercontents) ;
                }
            $center =  Maincenter::create($input);
        }



        return redirect()->route('maincenters.index')
            ->with('success', '     تم الاضافة  بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {

       $current_tab = ''   ;
       if ($request->has('current_tab'))
            $current_tab = $request->current_tab ;


          if($request->has('btn_add_ohda'))
        {
            $this->validate($request, [
            'emp_id' => 'required',
            'purpose' => 'required',
           // 'center_id' => 'required',
          //  'maincenter_id' => 'required',
            'raseed' => 'required'

        ], [
                'emp_id' => 'يجب اختيار الموظف المسؤول',
                'purpose' => 'يجب تسجيل البيان ',
                // 'center_id' => 'required',
                //  'maincenter_id' => 'required',
                'raseed' => 'يجب تسجيل الرصيد'

            ]);

        DB::transaction(function () use ($request) {
            $ohda = Ohda::create([
                'emp_id'  => $request->emp_id,
                'purpose' => $request->purpose,
                'raseed'  => $request->raseed,
                'maincenter_id'  => $request->maincenter_id,
                'masder'  => $request->masder,
                'esm_elmohawel'  => $request->esm_elmohawel,
                't_date'  => $request->t_date,
                'tdateh'  =>Hijri::ShortDate( $request->tdateh),
            ]);


        });
        }





        $img = '';
        if ($request->has('btn_add_center')) {


            if ($request->has('file')) {
                $uploadedFile = $request->file('file');
                $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
                $img = $uploadedFile->storeAs('uploads', $storedName, 'public');
            }

            $this->validate($request, [
                'center_name' => 'required',
                'center_location' => 'required',
              //  'woter_no' => 'required',
             //   'electric_no' => 'required',
                'maincenter_id'   =>  'required'
            ], [
            'center_name' => 'يجب ادخال اسم العمارة',
            'center_location' => 'يجب اختيار الموقع',
            'maincenter_id'   =>  'يجب اختيار المركز الرئيسي '

            //  'woter_no' => 'required',
            //  'electric_no' => 'required'
        ]);

            $input = $request->all();
            $input['img'] = $img;
            $input['created_by'] = Auth::user()->id;
           if(isset($request->othercontents))
                {
                     $input['othercontents'] = implode(",",$request->othercontents) ;
                }
            $center =  Center::create($input);
        }



        $maincenter = Maincenter::with('centers', 'employee')->find($id);
        $current_user = User::find(Auth::user()->id);
        $emps = Employee::get();
        $files = All_file::where('object_name','maincenters')
                ->where('object_id',$id)
                ->get() ;
        // dd($maincenter);
        $centers =   Center::with('units')
            ->where('maincenter_id', $id)
            ->orderby('id')
            ->get();


        // $payments = Payment::with(['contract.renter', 'paymentType', 'employee'])
        //     ->wherehas('contract', fn($sql) => $sql->where('maincenter_id', $id))
        //     ->where('status', 1)
        //     ->orderByDesc('id')
        //     ->get();

        // $sarfs = Sarf::with(['sarfType', 'serviceType', 'payrool.employee', 'recipient', 'paymentType', 'sourceType', 'fromOhda.employee', 'toOhda.employee'])
        //     ->where('center_id', $id)
        //     ->orderByDesc('id')
        //     ->get();


         $locations = Location::get();
           $others = Othercontent::get();
            $ohdas = Ohda::with(['employee','operatios.sarf'])
            ->where('maincenter_id', $id)
            ->orderByDesc('id')
            ->get();

            $sourceTypes = Source_type::get();
            $sarfTypes = Sarf_type::get();
            $payment_types = Payment_type:: where('id','<', 4)->get();
            $serviceTypes = Service_type::get();
             $recipients = Recipient::get();


        $payrolls = Payroll::with(['employee'])
            ->where('payment_status', 0)
            ->get();
        return view('maincenters.show', compact('centers', 'locations','recipients','payrolls','sourceTypes','serviceTypes','payment_types','sarfTypes','current_tab', 'ohdas',  'others', 'emps','files', 'maincenter', 'current_user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $center = Center::find($id);
        $current_user = User::find(Auth::user()->id);
        $locations = Location::get();
        return view('maincenters.edit', compact('center', 'locations', 'current_user'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {

        $img = '';
        if ($request->has('file')) {
            $uploadedFile = $request->file('file');
            $storedName = Str::uuid()->toString() . '.' . $uploadedFile->getClientOriginalExtension();
            $img = $uploadedFile->storeAs('uploads', $storedName, 'public');
        }

        $this->validate($request, [
            'name' => 'required',
          //  'iban'   => ['required', 'regex:/^SA\d{22}$/'],
        ], [
            'name' => 'يجب تسجيل الاسم',
         //   'iban.regex'   => 'IBAN يجب ان يبدأ ب SA  ويتبعه 22 رقم .',

        ]);

        $input = $request->all();
        if ($img != '')
            $input['img'] = $img;
        $input['updated_by'] = Auth::user()->id;
        // dd($input) ;
        $center =  Maincenter::find($id);


        $center->update($input);
        // dd($input) ;


        return redirect()->route('maincenters.show', $id)
            ->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {


        Center::find($id)->delete();
        return redirect()->route('maincenters.index')
            ->with('success', 'تم الحذف بنجاح');
    }
}
