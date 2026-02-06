<?php

use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

function get_count_notificatios()
{

    return Notification::where('user_id', Auth::user()->id)
        ->where('status', 0)->get()->count();
}
function get_my_notificatios()
{

    return Notification::where('user_id', Auth::user()->id)

        ->orderByDesc('id')
        ->limit(5)
        ->get();
}
function dateDiff($date1,$date2){
    $diff = strtotime($date2)- strtotime($date1) ;
    return round($diff/86400) ;

}

function formatPaymentDiff($date)
{
    $today = Carbon::today();
    $target = Carbon::parse($date);

    $diffDays = $today->diffInDays($target, false); // false = يسمح بالسالب

    if ($diffDays === 0) {
        return 'اليوم';
    }

    $prefix = $diffDays > 0 ? 'باقي' : 'فات عليه';
    $days = abs($diffDays);

    if ($days < 7) {
        return "$prefix $days يوم";
    }

    if ($days < 30) {
        $weeks = floor($days / 7);
        return "$prefix $weeks أسبوع";
    }

    $months = floor($days / 30);
    return "$prefix $months شهر";
}
function send_mail(
    array|string $to,
    string $subject = 'تنبيه من موقع إدارة العقارات',
    string $message = '',
    bool $isHtml = false,
    array $attachments = []
) {
    try {
        $to = is_array($to) ? $to : [$to];

        Mail::send([], [], function ($msg) use ($to, $subject, $message, $isHtml, $attachments) {

            $msg->to($to)->subject($subject);

            if ($isHtml) {
                $msg->html($message);
            } else {
                $msg->text($message);
            }

            foreach ($attachments as $file) {
                /*
                 * $file يمكن أن يكون:
                 * - مسار ملف: storage_path('app/file.pdf')
                 * - أو ['path' => '', 'name' => '']
                 */
                if (is_array($file)) {
                    $msg->attach($file['path'], [
                        'as' => $file['name'] ?? null,
                    ]);
                } else {
                    $msg->attach($file);
                }
            }
        });

    } catch (\Throwable $e) {
        Log::error('Mail Error: '.$e->getMessage());
        return false;
    }

    return true;
}
