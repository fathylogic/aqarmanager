// assets/vendor/libs/UmmalquraGregorianDatepicker/js/HijriGorgScript.js

const dateFormat = 'yyyy-mm-dd';
let gregCal = null;
let umqCal = null;

$(function () {
    gregCal = $.calendars.instance('gregorian', 'ar-EG');
    umqCal = $.calendars.instance('ummalqura');

    function safeConvert(fromCal, toCal, jd) {
        try {
            const date = toCal.fromJD(jd);
            if (date && date.year() > 0) {
                return toCal.formatDate(dateFormat, date);
            }
        } catch (e) {}
        return null;
    }

    // دالة إظهار الخطأ
    function showGroupError($group, message) {
        const $label = $group.prev('.form-label');
        $label.next('.group-error').remove();
        $group.find('input').removeClass('is-invalid');

        if (!$label.parent().hasClass('d-flex')) {
            $label.wrap('<div class="d-flex justify-content-between align-items-center w-100"></div>');
        }

        $('<small/>', {
            class: 'group-error text-danger ms-2',
            text: message
        }).insertAfter($label);

        $group.find('input').addClass('is-invalid');
    }

    function clearGroupError($group) {
        const $label = $group.prev('.form-label');
        $label.next('.group-error').remove();
        $group.find('input').removeClass('is-invalid');

        const $wrapper = $label.parent();
        if ($wrapper.hasClass('d-flex') && $wrapper.children().length === 1) {
            $label.unwrap();
        }
    }

    // دالة التحقق من التواريخ (لكل مجموعة على حدة)
    function validateDates($currentInput, $otherInput, isGregorian) {
        const currentVal = $currentInput.val().trim();
        const otherVal = $otherInput.val().trim();

        if (!currentVal || !otherVal) return true;

        try {
            const calCurrent = isGregorian ? gregCal : umqCal;
            const calOther = isGregorian ? gregCal : umqCal;

            const dateCurrent = calCurrent.parseDate(dateFormat, currentVal);
            const dateOther = calOther.parseDate(dateFormat, otherVal);

            if (!dateCurrent || !dateOther) return true;

            const jdCurrent = dateCurrent.toJD();
            const jdOther = dateOther.toJD();

            const groupType = $currentInput.closest('.calendar-group').data('group');
            const isStart = groupType === 'start';

            const isValid = isStart ? (jdCurrent <= jdOther) : (jdCurrent >= jdOther);

            if (!isValid) {
                const msg = isStart
                    ? 'تاريخ البداية لا يمكن أن يكون بعد تاريخ النهاية!'
                    : 'تاريخ النهاية لا يمكن أن يكون قبل تاريخ البداية!';

                const $group = $currentInput.closest('.calendar-group');
                showGroupError($group, msg);

                $currentInput.val('');
                const $paired = isGregorian
                    ? $currentInput.closest('.calendar-group').find('.hijri-date')
                    : $currentInput.closest('.calendar-group').find('.gregorian-date');
                $paired.val('');

                return false;
            } else {
                clearGroupError($currentInput.closest('.calendar-group'));
            }
        } catch (e) {
            console.error('خطأ في التحقق:', e);
        }
        return true;
    }

    // دالة تهيئة التقويم (تعمل على أي عناصر) دا المهم هنا يامحمد ياغامدي
    window.initDatepickers = function ($container = $('body')) {
        if (!gregCal || !umqCal) {
            setTimeout(() => initDatepickers($container), 100);
            return;
        }

        $container.find('.calendar-group').each(function () {
            const $group = $(this);
            const groupType = $group.data('group') || '';
            const rangeGroup = $group.data('range-group') || '';
            const defaultView = $group.data('default-view') || 'gregorian';
            const $gIn = $group.find('.gregorian-date');
            const $hIn = $group.find('.hijri-date');
            const $gRow = $group.find('.field-row').first();
            const $hRow = $group.find('.field-row').last();
            const $sw = $group.find('.calendar-switch');
            const $swH = $group.find('.calendar-switch-hijri');
            const $lbl = $group.find('.switch-label');
            const $lblH = $group.find('.switch-label-hijri');

            if ($gIn.data('calendarsPicker') || $hIn.data('calendarsPicker')) {
                return;
            }

            // Datepicker ميلادي
            $gIn.calendarsPicker({
                calendar: gregCal,
                dateFormat: dateFormat,
                showOnFocus: true,
                changeMonth: true,
                changeYear: true,
                yearRange: '1990:2090',
                regional: 'ar-EG',
                onSelect: function (dates) {
                    if (dates?.[0]) {
                        const val = safeConvert(gregCal, umqCal, dates[0]);
                        if (val) $hIn.val(val);
                        if ($group.is('[data-validate="range"]')) {
                            const oppositeType = groupType === 'start' ? 'end' : 'start';
                            const $otherGroup = $(`.calendar-group[data-group="${oppositeType}"][data-range-group="${rangeGroup}"]`);
                            const $otherGIn = $otherGroup.find('.gregorian-date');
                            validateDates($gIn, $otherGIn, true);
                        }
                    }
                }
            });

            // Datepicker هجري
            $hIn.calendarsPicker({
                calendar: umqCal,
                dateFormat: dateFormat,
                showOnFocus: true,
                changeMonth: true,
                changeYear: true,
                yearRange: '1410:1513',
                regional: 'ar-EG',
                onSelect: function (dates) {
                    if (dates?.[0]) {
                        const val = safeConvert(umqCal, gregCal, dates[0]);
                        if (val) $gIn.val(val);
                        if ($group.is('[data-validate="range"]')) {
                            const oppositeType = groupType === 'start' ? 'end' : 'start';
                            const $otherGroup = $(`.calendar-group[data-group="${oppositeType}"][data-range-group="${rangeGroup}"]`);
                            const $otherHIn = $otherGroup.find('.hijri-date');
                            validateDates($hIn, $otherHIn, false);
                        }
                    }
                }
            });

            // Switch
            $sw.add($swH).on('change', function () {
                const isHijri = this.checked;
                $gRow.toggleClass('hidden', isHijri);
                $hRow.toggleClass('hidden', !isHijri);
                $sw.add($swH).prop('checked', isHijri);
                $lbl.add($lblH).text(isHijri ? 'هجري' : 'هجري');
            });

            // تحويل عند الكتابة
            $gIn.add($hIn).on('input change', function () {
                const $this = $(this);
                const val = $this.val().trim();
                if (!val) return;

                const isGreg = $this.hasClass('gregorian-date');
                const targetInput = isGreg ? $hIn : $gIn;

                try {
                    const date = (isGreg ? gregCal : umqCal).parseDate(dateFormat, val);
                    if (date) {
                        const jd = date.toJD();
                        const converted = safeConvert(isGreg ? gregCal : umqCal, isGreg ? umqCal : gregCal, jd);
                        if (converted) targetInput.val(converted);
                        setTimeout(() => {
                            validateDates($this, isGreg ? $otherGIn : $otherHIn, isGreg);
                        }, 100);
                    }
                } catch (e) {}
            });

            // التهيئة الافتراضية بناءً على default_view
            const isHijriDefault = defaultView === 'hijri';
            $gRow.toggleClass('hidden', isHijriDefault);
            $hRow.toggleClass('hidden', !isHijriDefault);
            $sw.add($swH).prop('checked', isHijriDefault);
            $lbl.add($lblH).text(isHijriDefault ? 'هجري' : 'هجري');

            // === التحويل التلقائي عند تحميل الصفحة إذا كان هناك value ===
            setTimeout(() => {
                $group.find('.gregorian-date, .hijri-date').each(function () {
                    const $this = $(this);
                    const val = $this.val().trim();
                    if (!val) return;

                    const isGreg = $this.hasClass('gregorian-date');
                    const targetInput = isGreg ? $group.find('.hijri-date') : $group.find('.gregorian-date');

                    if (targetInput.val().trim() === '') {
                        try {
                            const date = (isGreg ? gregCal : umqCal).parseDate(dateFormat, val);
                            if (date) {
                                const jd = date.toJD();
                                const converted = safeConvert(isGreg ? gregCal : umqCal, isGreg ? umqCal : gregCal, jd);
                                if (converted) targetInput.val(converted);
                            }
                        } catch (e) {}
                    }
                });
            }, 400);
        });
    };

    // تنفيذ عند التحميل الأولي
    initDatepickers();

    // التحقق دائما من ارسال عناصر جديد زي الحقول يعني ياغامدي
    const observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (mutation) {
            mutation.addedNodes.forEach(function (node) {
                if (node.nodeType === 1) {
                    if ($(node).hasClass('calendar-group') || $(node).find('.calendar-group').length) {
                        initDatepickers($(node));
                    }
                }
            });
        });
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
});


    // ======================================================
// حقلين منفصلين: شهر + سنة (مع Modal)
// الشهر: يظهر الاسم، value = رقم الشهر (1-12)
// السنة: value = السنة
// تحديد الاختيار السابق بلون مختلف
// ======================================================
    $(function () {
        const gregCal = $.calendars.instance('gregorian', 'ar-EG');
        const monthNames = gregCal.local.monthNames;

        let currentMonthTarget = null;
        let currentYearTarget = null;

        // إنشاء Modal الشهر
        if (!$('#globalMonthModal').length) {
            $('body').append(`
            <div class="modal fade" id="globalMonthModal" tabindex="-1">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">اختر الشهر</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row row-cols-3 g-3" id="globalMonthsGrid"></div>
                        </div>
                    </div>
                </div>
            </div>
        `);
        }

        // إنشاء Modal السنة
        if (!$('#globalYearModal').length) {
            $('body').append(`
            <div class="modal fade" id="globalYearModal" tabindex="-1">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">اختر السنة</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row row-cols-5 g-3" id="globalYearsGrid"></div>
                        </div>
                    </div>
                </div>
            </div>
        `);
        }

        const $monthModal = $('#globalMonthModal');
        const $yearModal = $('#globalYearModal');
        const $monthsGrid = $('#globalMonthsGrid');
        const $yearsGrid = $('#globalYearsGrid');

        // ملء الأشهر (مرة واحدة)
        $monthsGrid.empty();
        monthNames.forEach((name, i) => {
            const monthNum = i + 1;
            $monthsGrid.append(`
            <div class="col">
                <button type="button" class="btn btn-outline-primary w-100 month-choice" data-month="${monthNum}">
                    ${name}
                </button>
            </div>
        `);
        });

        // ملء السنوات عند الفتح
        function populateYears(min, max) {
            $yearsGrid.empty();
            for (let y = max; y >= min; y--) {
                $yearsGrid.append(`
                <div class="col">
                    <button type="button" class="btn btn-outline-primary w-100 year-choice" data-year="${y}">
                        ${y}
                    </button>
                </div>
            `);
            }
        }

        // فتح Modal الشهر
        $(document).on('click', '.month-input .month-display, .month-input .month-open-btn', function () {
            currentMonthTarget = $(this).closest('.month-input');

            // تحديد الشهر المختار سابقًا
            const currentMonthVal = currentMonthTarget.find('.month-hidden').val(); // القيمة الرقمية
            $monthsGrid.find('.month-choice').removeClass('btn-primary').addClass('btn-outline-primary');
            if (currentMonthVal) {
                $monthsGrid.find(`.month-choice[data-month="${currentMonthVal}"]`)
                    .removeClass('btn-outline-primary').addClass('btn-primary');
            }

            $monthModal.modal('show');
        });

        // فتح Modal السنة
        $(document).on('click', '.year-input .year-display, .year-input .year-open-btn', function () {
            currentYearTarget = $(this).closest('.year-input');
            const min = currentYearTarget.data('min-year') || 1900;
            const max = currentYearTarget.data('max-year') || 2030;
            populateYears(min, max);

            // تحديد السنة المختارة سابقًا
            const currentYearVal = currentYearTarget.find('.year-hidden').val();
            $yearsGrid.find('.year-choice').removeClass('btn-primary').addClass('btn-outline-primary');
            if (currentYearVal) {
                $yearsGrid.find(`.year-choice[data-year="${currentYearVal}"]`)
                    .removeClass('btn-outline-primary').addClass('btn-primary');
            }

            $yearModal.modal('show');
        });

        // اختيار الشهر
        $monthsGrid.on('click', '.month-choice', function () {
            const monthNum = $(this).data('month');
            const monthName = monthNames[monthNum - 1];

            // عرض الاسم في الحقل المرئي
            currentMonthTarget.find('.month-display').val(monthName);
            // حفظ الرقم في الحقل المخفي (value = رقم الشهر)
            currentMonthTarget.find('.month-hidden').val(monthNum);

            // تحديد الزر في الـ Modal
            $monthsGrid.find('.month-choice').removeClass('btn-primary').addClass('btn-outline-primary');
            $(this).removeClass('btn-outline-primary').addClass('btn-primary');

            const modalInstance = bootstrap.Modal.getInstance($monthModal[0]);
            if (modalInstance) modalInstance.hide();
        });

        // اختيار السنة
        $yearsGrid.on('click', '.year-choice', function () {
            const year = $(this).data('year');

            // عرض السنة في الحقل المرئي
            currentYearTarget.find('.year-display').val(year);
            // حفظ السنة في الحقل المخفي
            currentYearTarget.find('.year-hidden').val(year);

            // تحديد الزر في الـ Modal
            $yearsGrid.find('.year-choice').removeClass('btn-primary').addClass('btn-outline-primary');
            $(this).removeClass('btn-outline-primary').addClass('btn-primary');

            const modalInstance = bootstrap.Modal.getInstance($yearModal[0]);
            if (modalInstance) modalInstance.hide();
        });
    });





