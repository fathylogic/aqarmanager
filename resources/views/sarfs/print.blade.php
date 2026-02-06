<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="utf-8">
    <title></title>

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="/assets/vendor/libs/paper-css/paper.css"/>

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>@page {
            size: A5 landscape
        }</style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A5 landscape">
<div class="controls-container">
    <button onclick="window.print()">طباعة 🖨</button>
</div>

<!-- Each sheet element should have the class "sheet" -->
<!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
<section class="sheet padding-5mm">

    <!-- Write HTML just like a web page -->
    <article>

        <div class="all_paper">
            <div class="paper_header">
                <div class="paper_title">
                    <span>وصية أوقاف إبراهيم صدقي محمد سعيد أفندي</span>
                </div>
                <div class="payment_number">
                    رقم : <span id="p_sereal"> {{ $ser }} </span>
                </div>
            </div>

            <div class="payment_date">
                <div class="hijri_date">
                    التاريخ : <span id="p_actual_dateh"> {{$row->p_dateh}}  هـ </span>
                </div>

                <div class="payment_name">
        <span class=" p-2"> سند صرف
        </span>
                </div>
                <div class="gorg_date">
                    Date : <span id="p_actual_date">{{$row->p_date}} </span>
                </div>

            </div>

            <div class="payment_amount">
                <div class="payment_amountH">
                    # <span id="p_amount">{{ $row->amount }}</span> <span style="font-size: 25px;"
                                                                          class="icon-saudi_riyal_new"></span>
                </div>
            </div>

            <div class="payer">
                <div class="payer_name_title">
                    <span> استلمنا نحن  : </span>
                </div>
                <div class="payer_name">
                    <span id="p_emp">
                        @if ($row->pay_role_id != '')
                            {{ $row->payrool->employee->name }}
                        @else
                            {{ $row->receved_by }}
                        @endif

                        </span>
                </div>
            </div>

            <div class="payment_amount_text">
                <div class="payment_amount_text_title">
                    <span> مبلغ وقدره </span>
                </div>
                <div class="payment_amount_text_">
                    <span id="p_amount_txt"> {{ $row->amount_txt }}  </span>
                </div>
            </div>

            <div class="payment_about">
                <div class="payment_about_title">
                    <span> وذلك نظير : </span>
                </div>
                <div class="payment_about_text">
                    <span id="p_note"> {{$row->s_desc}}</span>
                </div>
            </div>

            <div class="payment_signature">
                <div class="signature_text">
                    <span> توقيع المستلم</span>
                </div>
            </div>

        </div>
    </article>

</section>

</body>

</html>

