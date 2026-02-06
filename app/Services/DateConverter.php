<?php

namespace App\Services;

use Carbon\Carbon;

class DateConverter
{
    /**
     * تحويل الميلادي إلى هجري
     */
    public static function toHijri($gregorianDate)
    {
        $date = Carbon::parse($gregorianDate)->toHijri();

        return [
            'input'   => $gregorianDate,
            'short'   => $date->format('Y-m-d'),
            'full'    => $date->isoFormat('dddd, D MMMM YYYY'),
        ];
    }

    /**
     * تحويل الهجري إلى ميلادي
     */
    public static function toGregorian($hijriDate)
    {
        [$y, $m, $d] = explode('-', $hijriDate);

        $date = Carbon::createFromHijri($y, $m, $d);

        return [
            'input'   => $hijriDate,
            'short'   => $date->format('Y-m-d'),
            'full'    => $date->isoFormat('dddd, D MMMM YYYY'),
        ];
    }
}
