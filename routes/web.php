<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DropzoneController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\RenterController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\WhatsappController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SarfController;
use App\Http\Controllers\OhdaController;
use App\Http\Controllers\MaincenterController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\ContractController;
use App\Models\All_file;
use App\Http\Controllers\TestEmailController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\TodoController;


Auth::routes();
Route::resource('todos', TodoController::class);

Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
Route::patch('/todos/{todo}', [TodoController::class, 'update'])->name('todos.update');
Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');

Route::get('send-whatsapp', [WhatsappController::class, 'index']);
Route::post('send-whatsapp', [WhatsappController::class, 'sendWhatsappMessage'])->name('send.whatsapp');

Route::get('/login-alert', [HomeController::class, 'showAlert'])
    ->name('login.alert');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);

Route::get('dropzone', [DropzoneController::class, 'index']);
Route::post('dropzone/store', [DropzoneController::class, 'store'])->name('dropzone.store');

Route::get('contracts', [ContractController::class, 'index'])->name('contracts.index');
Route::post('contracts/store', [ContractController::class, 'store'])->name('contracts.store');
Route::get('contracts/contract_arch', [ContractController::class, 'contract_arch'])->name('contracts.contract_arch');
Route::get('contracts/show/{id}', [ContractController::class, 'show'])->name('contracts.show');
Route::post('contracts/show/{id}', [ContractController::class, 'show']);
Route::get('contracts/edit/{id}', [ContractController::class, 'edit'])->name('contracts.edit');
Route::post('contracts/edit/{id}', [ContractController::class, 'edit']);
Route::get('contracts/destroy/{id}', [ContractController::class, 'destroy'])->name('contracts.destroy');
Route::get('contracts/create', [ContractController::class, 'create'])->name('contracts.create');
Route::post('contracts/create', [ContractController::class, 'create']);
Route::post('contracts/update/{id}', [ContractController::class, 'update'])->name('contracts.update');
Route::get('centers', [CenterController::class, 'index'])->name('centers.index');
Route::post('centers/store', [CenterController::class, 'store'])->name('centers.store');


Route::post('contracts/{id}/terminate', [ContractTerminateController::class,'store']);
Route::post('contracts/{id}/assign', [ContractAssignController::class,'store']);
Route::post('contracts/{id}/extend', [ContractExtendController::class,'store']);

Route::get('centers/show/{id}', [CenterController::class, 'show'])->name('centers.show');
Route::post('centers/show/{id}', [CenterController::class, 'show']);
Route::get('centers/edit/{id}', [CenterController::class, 'edit'])->name('centers.edit');
Route::get('centers/destroy/{id}', [CenterController::class, 'destroy'])->name('centers.destroy');
Route::get('centers/create', [CenterController::class, 'create'])->name('centers.create');
Route::post('centers/update/{id}', [CenterController::class, 'update'])->name('centers.update');

Route::get('maincenters', [MaincenterController::class, 'index'])->name('maincenters.index');
Route::post('maincenters/store', [MaincenterController::class, 'store'])->name('maincenters.store');
Route::get('maincenters/show/{id}', [MaincenterController::class, 'show'])->name('maincenters.show');
Route::post('maincenters/show/{id}', [MaincenterController::class, 'show']);
Route::get('maincenters/edit/{id}', [MaincenterController::class, 'edit'])->name('maincenters.edit');
Route::get('maincenters/destroy/{id}', [MaincenterController::class, 'destroy'])->name('maincenters.destroy');
Route::get('maincenters/create', [MaincenterController::class, 'create'])->name('maincenters.create');
Route::post('maincenters/update/{id}', [MaincenterController::class, 'update'])->name('maincenters.update');

Route::get('renters', [RenterController::class, 'index'])->name('renters.index');
Route::post('renters/store', [RenterController::class, 'store'])->name('renters.store');
Route::get('renters/show/{id}', [RenterController::class, 'show'])->name('renters.show');
Route::post('renters/show/{id}', [RenterController::class, 'show']);
Route::get('renters/edit/{id}', [RenterController::class, 'edit'])->name('renters.edit');
Route::get('renters/destroy/{id}', [RenterController::class, 'destroy'])->name('renters.destroy');
Route::get('renters/create', [RenterController::class, 'create'])->name('renters.create');
Route::post('renters/update/{id}', [RenterController::class, 'update'])->name('renters.update');


Route::get('employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::post('employees/store', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('employees/show/{id}', [EmployeeController::class, 'show'])->name('employees.show');
Route::post('employees/show/{id}', [EmployeeController::class, 'show']);
Route::get('employees/edit/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::get('employees/addPayroll/{id}', [EmployeeController::class, 'addPayroll'])->name('employees.addPayroll');
Route::post('employees/addPayroll/{id}', [EmployeeController::class, 'addPayroll']);
Route::get('employees/destroy/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
Route::get('employees/create', [EmployeeController::class, 'create'])->name('employees.create');
Route::post('employees/update/{id}', [EmployeeController::class, 'update'])->name('employees.update');
Route::get('employees/get_centers/{id}', [EmployeeController::class, 'get_centers'])->name('employees.get_centers');


Route::match(['get', 'post'], 'reports/payrolls_rpt', [ReportsController::class, 'payrolls_rpt'])->name('reports.payrolls_rpt');
Route::match(['get', 'post'], 'reports/ohda_rpt', [ReportsController::class, 'ohda_rpt'])->name('reports.ohda_rpt');


Route::get('payrolls', [PayrollController::class, 'index'])->name('payrolls.index');
Route::post('payrolls', [PayrollController::class, 'index']);
Route::post('payrolls/store', [PayrollController::class, 'store'])->name('payrolls.store');
Route::get('payrolls/show/{id}', [PayrollController::class, 'show'])->name('payrolls.show');
Route::post('payrolls/show/{id}', [PayrollController::class, 'show']);
Route::get('payrolls/edit/{id}', [PayrollController::class, 'edit'])->name('payrolls.edit');
Route::get('payrolls/destroy/{id}', [PayrollController::class, 'destroy'])->name('payrolls.destroy');
Route::get('payrolls/create', [PayrollController::class, 'create'])->name('payrolls.create');
Route::post('payrolls/update/{id}', [PayrollController::class, 'update'])->name('payrolls.update');



Route::get('recipients', [RecipientController::class, 'index'])->name('recipients.index');
Route::post('recipients/store', [RecipientController::class, 'store'])->name('recipients.store');
Route::get('recipients/show/{id}', [RecipientController::class, 'show'])->name('recipients.show');
Route::get('recipients/edit/{id}', [RecipientController::class, 'edit'])->name('recipients.edit');
Route::get('recipients/destroy/{id}', [RecipientController::class, 'destroy'])->name('recipients.destroy');
Route::get('recipients/create', [RecipientController::class, 'create'])->name('recipients.create');
Route::post('recipients/update/{id}', [RecipientController::class, 'update'])->name('recipients.update');


Route::get('units', [UnitController::class, 'index'])->name('units.index');
Route::post('units/store', [UnitController::class, 'store'])->name('units.store');
Route::get('units/show/{id}', [UnitController::class, 'show'])->name('units.show');
Route::post('units/show/{id}', [UnitController::class, 'show']);
Route::get('units/edit/{id}', [UnitController::class, 'edit'])->name('units.edit');
Route::get('units/destroy/{id}', [UnitController::class, 'destroy'])->name('units.destroy');
Route::get('units/create', [UnitController::class, 'create'])->name('units.create');
Route::post('units/update/{id}', [UnitController::class, 'update'])->name('units.update');

Route::get('units/delete_object/{id}/{object_type}', [UnitController::class, 'delete_object'])->name('units.delete_object');


Route::get('units/add_unit', [UnitController::class, 'add_unit'])->name('units.add_unit');
Route::post('units/add_unit', [UnitController::class, 'add_unit']);


Route::get('notes', [NoteController::class, 'index'])->name('notes.index');
Route::post('notes', [NoteController::class, 'index']);
Route::post('notes/store', [NoteController::class, 'store'])->name('notes.store');
Route::get('notes/show/{id}', [NoteController::class, 'show'])->name('notes.show');
Route::get('notes/edit/{id}', [NoteController::class, 'edit'])->name('notes.edit');
Route::get('notes/destroy/{id}', [NoteController::class, 'destroy'])->name('notes.destroy');
Route::get('notes/create', [NoteController::class, 'create'])->name('notes.create');
Route::post('notes/update/{id}', [NoteController::class, 'update'])->name('notes.update');

Route::get('/salahyat/{id}', [UserController::class, 'salahyat'])->name('salahyat');

Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('notifications', [NotificationController::class, 'index']);
Route::get('notifications/show/{id}', [NotificationController::class, 'show'])->name('notifications.show');

Route::get('payments/get_late_payments', [PaymentController::class, 'get_late_payments'])->name('payments.get_late_payments');
Route::post('payments/get_late_payments', [PaymentController::class, 'get_late_payments']);
Route::get('payments/print/{id}', [PaymentController::class, 'print'])->name('payments.print');
Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
Route::post('payments', [PaymentController::class, 'index']);
Route::post('payments/store', [PaymentController::class, 'store'])->name('payments.store');
Route::get('payments/show/{id}', [PaymentController::class, 'show'])->name('payments.show');
Route::post('payments/show/{id}', [PaymentController::class, 'show']);
Route::get('payments/edit/{id}', [PaymentController::class, 'edit'])->name('payments.edit');
Route::get('payments/destroy/{id}', [PaymentController::class, 'destroy'])->name('payments.destroy');
Route::get('payments/create', [PaymentController::class, 'create'])->name('payments.create');
Route::post('payments/update/{id}', [PaymentController::class, 'update'])->name('payments.update');

Route::get('sarfs/get_units/{id}', [SarfController::class, 'get_units'])->name('sarfs.get_units');
Route::get('units/get_centers/{id}', [UnitController::class, 'get_centers'])->name('units.get_centers');
Route::get('units/get_center2/{id}', [UnitController::class, 'get_center2'])->name('units.get_center2');
Route::get('units/get_units/{id}', [UnitController::class, 'get_units'])->name('units.get_units');

Route::get('sarfs', [SarfController::class, 'index'])->name('sarfs.index');
Route::post('sarfs', [SarfController::class, 'index']);
Route::post('sarfs/store', [SarfController::class, 'store'])->name('sarfs.store');
Route::get('sarfs/show/{id}', [SarfController::class, 'show'])->name('sarfs.show');
Route::post('sarfs/show/{id}', [SarfController::class, 'show']);
Route::get('sarfs/edit/{id}', [SarfController::class, 'edit'])->name('sarfs.edit');
Route::get('sarfs/destroy/{id}', [SarfController::class, 'destroy'])->name('sarfs.destroy');
Route::get('sarfs/create/{ohda_id?}', [SarfController::class, 'create'])
    ->name('sarfs.create');
Route::post('sarfs/update/{id}', [SarfController::class, 'update'])->name('sarfs.update');

Route::get('sarfs/print/{id}', [SarfController::class, 'print'])->name('sarfs.print');
Route::post('allfiles/add_files', [FilesController::class, 'add_files'])->name('allfiles.add_files');
Route::post('allfiles/delete_file', [FilesController::class, 'delete_file'])->name('allfiles.delete_file');

Route::post('allfiles/update_files', [FilesController::class, 'update_files'])->name('allfiles.update_files');




Route::get('ohdas', [OhdaController::class, 'index'])->name('ohdas.index');
Route::post('ohdas/store', [OhdaController::class, 'store'])->name('ohdas.store');
Route::get('ohdas/show/{id}', [OhdaController::class, 'show'])->name('ohdas.show');
Route::post('ohdas/show/{id}', [OhdaController::class, 'show']);
Route::get('ohdas/edit/{id}', [OhdaController::class, 'edit'])->name('ohdas.edit');
Route::get('ohdas/destroy/{id}', [OhdaController::class, 'destroy'])->name('ohdas.destroy');
Route::get('ohdas/create', [OhdaController::class, 'create'])->name('ohdas.create');
Route::post('ohdas/update/{id}', [OhdaController::class, 'update'])->name('ohdas.update');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
});
Route::get('/delete_file/{id}', function ($id) {
    $file = All_file::find($id);
    if ($file->delete()) {
        return 1;
    } else {
        return 0;
    }
});

Route::get('/sarf/{sarf}/attachments', function (\App\Models\Sarf $sarf) {
    return view('reports.sarf_attachments', compact('sarf'));
})->name('sarf.attachments');

Route::get('/test-send-email', [TestEmailController::class, 'send']);

