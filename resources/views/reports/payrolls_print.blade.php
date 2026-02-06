<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقرير الرواتب</title>
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
            font-size: 14px;
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
</head>
<body>
<div class="print-container">
    <!-- Print Button -->
    <div class="no-print" style="text-align: center;">
        <button class="btn-print" onclick="window.print()">طباعة التقرير</button>
        <button class="btn-print" style="background-color: #f44336;" onclick="window.close()">إغلاق</button>
    </div>

    <!-- Header -->
    <div class="header">
        <h1>تقرير الرواتب</h1>
        <div class="header-info">
            <div>
                <strong>نوع التقرير:</strong>
                @if($report_type === 'year')
                    سنوي
                @else
                    شهري
                @endif
            </div>
            <div>
                <strong>الفترة:</strong>
                @if($report_type === 'year')
                    عام {{ $year }}
                @else
                    {{ $month }}/{{ $year }}
                @endif
            </div>
            <div>
                <strong>تاريخ الطباعة:</strong>
                {{ date('Y/m/d H:i') }}
            </div>
            <div>
                <strong>المستخدم:</strong>
                {{ $current_user->name }}
            </div>
        </div>
    </div>

    @if($result && $result->count() > 0)
        <!-- Payroll Table -->
        <table class="report-table">
            <thead>
            <tr>
                <th>#</th>
                <th>اسم الموظف</th>
                <th>رقم الهوية</th>
                <th>الوظيفة</th>
                <th>الشهر/السنة</th>
                <th>الراتب الأساسي</th>

                <th>الخصومات</th>
                <th>صافي الراتب</th>
                <th>صافي الراتب (نصاً)</th>
                <th>تاريخ الدفع</th>
                <th>تاريخ الدفع (هجري)</th>


                <th>  توقيع المستلم </th>
            </tr>
            </thead>
            <tbody>
            @php
                $total_basic = 0;
                $total_allowances = 0;
                $total_deductions = 0;
                $total_net = 0;
            @endphp

            @foreach($result as $index => $payroll)
                @php
                    $total_basic += $payroll->basic_salary;

                    $total_deductions += $payroll->deductions;
                    $total_net += $payroll->net_salary;
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="text-right">{{ $payroll->employee->name ?? 'غير محدد' }}</td>
                    <td>{{ $payroll->employee->id_no ?? '-' }}</td>
                    <td class="text-right">{{ $payroll->employee->job ?? '-' }}</td>
                    <td>{{ $payroll->salary_year_month }}</td>
                    <td>{{ number_format($payroll->basic_salary, 2) }}</td>

                    <td>{{ number_format($payroll->deductions, 2) }}</td>
                    <td><strong>{{ number_format($payroll->net_salary, 2) }}</strong></td>
                    <td class="text-right">{{ $payroll->net_salary_txt }}</td>
                    <td>{{ $payroll->p_date }}</td>
                    <td>{{ $payroll->p_dateh }}</td>
                    <td>

                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr style="background-color: #e0e0e0; font-weight: bold;">
                <td colspan="5" class="text-right"><strong>الإجمالي</strong></td>
                <td>{{ number_format($total_basic, 2) }}</td>

                <td>{{ number_format($total_deductions, 2) }}</td>
                <td><strong>{{ number_format($total_net, 2) }}</strong></td>
                <td colspan="5"></td>
            </tr>
            </tfoot>
        </table>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-totals">
                <div>
                    <strong>إجمالي الرواتب الأساسية:</strong>
                    {{ number_format($total_basic, 2) }} ريال
                </div>

                <div>
                    <strong>إجمالي الخصومات:</strong>
                    {{ number_format($total_deductions, 2) }} ريال
                </div>
                <div>
                    <strong>إجمالي صافي الرواتب:</strong>
                    {{ number_format($total_net, 2) }} ريال
                </div>
            </div>

            <div class="footer-info">
                <p>عدد الموظفين: {{ $result->count() }}</p>
                <p>تم إنشاء هذا التقرير بواسطة: {{ $current_user->name }} - {{ date('Y/m/d H:i:s') }}</p>
            </div>
        </div>
    @else
        <div style="text-align: center; padding: 50px; font-size: 18px; color: #666;">
            <p>لا توجد بيانات لعرضها</p>
        </div>
    @endif
</div>

<script>
    // Auto print on load (optional)
    // window.onload = function() { window.print(); }
</script>
</body>
</html>
