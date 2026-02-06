/* http://keith-wood.name/calendars.html
   Arabic (Egypt) localisation for calendars datepicker for jQuery.
   Mahmoud Khaled -- mahmoud.khaled@badrit.com
   NOTE: monthNames are the new months names */
(function($) {
	'use strict';
	$.calendarsPicker.regionalOptions['ar-EG'] = {
		renderer: $.calendarsPicker.defaultRenderer,
		prevText: '➤ السابق',
		prevStatus: 'عرض شهر سابق',
		prevJumpText: '<<',
		prevJumpStatus: 'عرض سنة سابقة',
		nextText: 'التالي ⮜',
		nextStatus: 'عرض الشهر القادم',
		nextJumpText: '>>',
		nextJumpStatus: 'عرض سنة قادمة',
		currentText: 'اليوم',
		currentStatus: 'عرض الشهر الحالي',
		todayText: '◉ اليوم',
		todayStatus: 'عرض الشهر الحالي',
		clearText: 'مسح',
		clearStatus: 'امسح التاريخ الحالي',
		closeText: 'إغلاق',
		closeStatus: 'إغلاق بدون حفظ',
		yearStatus: 'عرض سنة أخرى',
		monthStatus: 'عرض شهر آخر',
		weekText: 'أسبوع',
		weekStatus: 'أسبوع السنة',
		dayStatus: 'اختر DD, MM d',
		defaultStatus: 'اختر يوم',
		isRTL: true
	};
	$.calendarsPicker.setDefaults($.calendarsPicker.regionalOptions['ar-EG']);
})(jQuery);
