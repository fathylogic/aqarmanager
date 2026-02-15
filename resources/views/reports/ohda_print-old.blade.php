<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقرير العهدة</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 1cm;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            direction: rtl;
            text-align: right;
            background: white;
        }

        .print-container {
            width: 100%;
            padding: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #333;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }

        .header-info {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-size: 16px;
        }

        .header-info div {
            padding: 5px 10px;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 12px;
        }

        .report-table th,
        .report-table td {
            border: 1px solid #333;
            padding: 8px;
            text-align: center;
        }

        .report-table th {
            background-color: #f0f0f0;
            font-weight: bold;
            color: #333;
        }

        .report-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .report-table tbody tr:hover {
            background-color: #f0f0f0;
        }

        .text-right {
            text-align: right !important;
        }

        .text-left {
            text-align: left !important;
        }

        .footer {
            margin-top: 30px;
            border-top: 2px solid #333;
            padding-top: 15px;
        }

        .footer-totals {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: bold;
        }

        .footer-totals div {
            padding: 10px;
            background-color: #f0f0f0;
            border: 1px solid #333;
            border-radius: 5px;
        }

        .footer-info {
            text-align: center;
            font-size: 11px;
            color: #666;
            margin-top: 20px;
        }

        .no-print {
            margin-bottom: 20px;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                padding: 0;
            }

            .print-container {
                padding: 0;
            }

            .page-break {
                page-break-after: always;
            }
        }

        .btn-print {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-print:hover {
            background-color: #45a049;
        }

        .status-paid {
            color: green;
            font-weight: bold;
        }

        .status-unpaid {
            color: red;
            font-weight: bold;
        }
    </style>
    <style>
        @page {
            size: A4 landscape;
            margin: 1cm;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            direction: rtl;
            text-align: right;
            background: white;
        }

        .print-container {
            width: 100%;
            padding: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #333;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 22px;
            color: #333;
            margin-bottom: 10px;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        .report-table th,
        .report-table td {
            border: 1px solid #333;
            padding: 6px;
            text-align: center;
        }

        .report-table th {
            background-color: #f0f0f0;
        }

        .text-right {
            text-align: right !important;
        }

        .footer {
            margin-top: 20px;
            border-top: 2px solid #333;
            padding-top: 15px;

        }

        .footer-totals {
            display: flex;
            justify-content: space-around;
            font-weight: bold;
            font-size: 14px;
        }

        .footer-totals div {
            padding: 10px;
            background-color: #f0f0f0;
            border: 1px solid #333;
            border-radius: 5px;
        }

        .page-break {
            page-break-after: always;
        }

        .no-print {
            margin-bottom: 20px;
            text-align: center;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

@php
    use Carbon\Carbon;

Carbon::setLocale('ar');



    /**
     * تقسيم العمليات حسب الشهر
     */
    $groupedByMonth = $result->groupBy(function ($item) {
        return Carbon::parse($item->sarf->p_date)->format('Y-m');
    });

    /**
     * الرصيد الافتتاحي العام (قبل أول شهر)
     */
    $openingBalance = $selectedOhda->raseed ?? 0;
     $original_balance =  $selectedOhda->start_amount ;
  $balance =  $result[0]->last_amount ;
@endphp

<div class="print-container">



    <!-- Print Button -->
    <div class="no-print" style="text-align: center;">
        <button class="btn-print" onclick="window.print()">طباعة التقرير</button>
        <button class="btn-print" style="background-color: #f44336;" onclick="window.close()">إغلاق</button>
        <div class="footer">
            <div class="footer-totals">
                <div>  الرصيد الافتتاحي للعهدة : {{$original_balance}} ريال</div>


            </div>
        </div>

    </div>

    @if($groupedByMonth->count() > 0)

        @foreach($groupedByMonth as $month => $operations)

            @php
                $monthCarbon = Carbon::createFromFormat('Y-m', $month);
                $currentMonthName = $monthCarbon->translatedFormat('F Y');
                $previousMonthName = $monthCarbon->copy()->subMonth()->translatedFormat('F Y');

                $total_sarf = 0;
                $total_come = 0;

                // رصيد افتتاحي الشهر
                $monthOpeningBalance = $openingBalance;

            @endphp

                <!-- Header -->
            <div class="header">
                <h1><br>
                    تقرير  {{ $selectedOhda->purpose }}
                    لشهر  {{ $currentMonthName }}
                    @if($currentMonthName !='يناير 2026')
                    مع   ما تبقى من عهدة شهر {{ $previousMonthName }}
                    @endif
                </h1>
            </div>

            <!-- Table -->
            <table class="report-table">
                <thead>
                <tr>
                    <th>التسلسل</th>
                    <th>نوع العملية</th>
                    <th>المبلغ</th>
                    <th>الرصيد قبل العملية</th>

                    <th>الرصيد بعد العملية</th>
                    <th>التاريخ</th>
                    <th>البيان</th>
                    <th>المستلم</th>
                    <th class="no-print">المرفقات</th>

                </tr>
                </thead>

                <tbody>
                @foreach($operations as $index => $operation)
                    @php
                        if($operation->op_type == '+')
                            $total_come += $operation->amount;
                        else
                            $total_sarf += $operation->amount;

                        $openingBalance = $operation->last_amount ?? $openingBalance;
                    @endphp

                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $operation->op_type == '+' ? 'إضافة' : 'صرف' }}</td>
                        <td style="color: {{ $operation->op_type == '+' ? 'green' : 'red' }}">
                            {{ number_format($operation->amount, 2) }}
                        </td>
                        <td><strong>{{ number_format($operation->last_amount, 2) }}</strong></td>

                        <td style="color: {{ $operation->op_type == '+' ? 'green' : 'red' }}">
                            {{ $operation->op_type == '+' ? number_format($operation->amount + $operation->last_amount, 2) :  number_format($operation->last_amount - $operation->amount , 2) }}

                        </td>
                        <td>{{ $operation->sarf->p_date }}</td>
                        <td class="text-right">{{ $operation->sarf->s_desc ?? '-' }}
                        @if($operation->sarf->pay_role_id !='') {{$operation->sarf->receved_by ?? '-'}}@endif
                        </td>
                        <td class="text-right">{{ $operation->sarf->receved_by ?? '-' }}</td>
                        <td class="no-print">
                            @if($operation->sarf->img || $operation->sarf->files->count())
                            <a href="{{ route('sarf.attachments', $operation->sarf->id) }}"
                               target="_blank"
                               class="btn-print"
                               style="font-size:12px;padding:5px 10px;">
                                عرض المرفقات
                            </a>
                            @endif
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>

            <!-- Footer -->
            <div class="footer">
                <div class="footer-totals">
                    <div>إجمالي الوارد: {{ number_format($total_come, 2) }} ريال</div>
                    <div>إجمالي المنصرف: {{ number_format($total_sarf, 2) }} ريال</div>
                    @php
                  $balance   = $balance + $total_come - $total_sarf  ;
                    @endphp
                    <div>الرصيد المرحّل: {{ number_format($balance , 2) }} ريال</div>

                </div>
            </div>

            @if(!$loop->last)
                <div class="page-break"></div>
            @endif

        @endforeach

    @else
        <p style="text-align:center; padding:50px">لا توجد بيانات</p>
    @endif

</div>

</body>
</html>
