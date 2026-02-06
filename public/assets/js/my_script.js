'use strict';
//
// let picker = new Datepicker();
// let pickElm = picker.getElement();
// let pLeft = 200;
// let pWidth = 300;
// pickElm.style.position = 'absolute';
// pickElm.style.left = pLeft + 'px';
// pickElm.style.top = '172px';
// picker.attachTo(document.body);


var validate_and_loadFile = function (event, id) {

	const fileInput = document.getElementById(id);
	const file = fileInput.files[0];


	const allowedTypes = ['image/jpeg', 'application/pdf'];

	if (file) {

		if (!allowedTypes.includes(file.type)) {
			alert("فقط المسموح به الملفات من النوع  pdf & jpg !");

			fileInput.value = '';
		}
		else
			var output = document.getElementById(id+'_view');


				  if (output.hasAttribute("hidden")) {
					output.removeAttribute("hidden");
				}
				output.src = URL.createObjectURL(event.target.files[0]);
				output.onload = function () {
				URL.revokeObjectURL(output.src)  ;
		}
	}


};



function validateFile(event, id) {
	const fileInput = document.getElementById(id);
	const file = fileInput.files[0];


	const allowedTypes = ['image/jpeg', 'application/pdf'];

	if (file) {

		if (!allowedTypes.includes(file.type)) {
			alert("فقط المسموح به الملفات من النوع  pdf & jpg !");

			fileInput.value = '';
		}
	}
}
function fn_update_file(row)
{
    $('#title').val(row['title']) ;
    $('#file_id').val(row['id']) ;

    $('#editFile').modal('show');
}

function fn_update_OpAdd(row)
{

console.log(row.sarf);
    $('#operation_id').val(row['id']) ;
    $('#add_receved_by').val(row.sarf['receved_by']) ;
    $('#add_s_desc').val(row.sarf['s_desc']) ;
    $('#add_masder').val(row['masder']).trigger('change') ;
    $('#add_payment_type').val(row.sarf['payment_type']).trigger('change')    ;
    $('#add_p_dateh').val(row.sarf['p_dateh']) ;
    $('#add_p_date').val(row.sarf['p_date']) ;
    $('#add_amount').val(row['amount']) ;

    $('#editOpAdd').modal('show');
}

function fn_add_file_row(div_id) {
    var randomIndex = Math.floor(Math.random() * 9999);

    var new_row =
		'<tr id="tr_'+randomIndex+'"><td><input type="text"   name="title[]" class="form-control" required /></td><td><input type="file" name="file[]"   class="form-control"></td> <td> <a href="#" onclick="del_row('+randomIndex+') ; return false ; " class="btn btn-sm btn-danger delete-record"><i class="fa-solid fa-trash-can pe-2"></i> حذف</a></td></tr>';
	$('#' + div_id).append(new_row);
	$('.btn-save-files').show();

}
function del_row(id)
{
      $('#tr_'+ id).remove();
}
function fn_delete_file(id) {
    if (id != '' && id > 0) {

        Swal.fire({
            title: 'هل أنت متأكد؟',
            text: 'لن يمكنك التراجع عن هذا الإجراء!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'نعم، احذف',
            cancelButtonText: 'إلغاء'
        }).then((result) => {

            if (result.isConfirmed) {
                $.ajax({
                    url: '/delete_file/' + id,
                    type: 'GET',
                    success: function (response) {
                        if (response == 1) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "تم الحذف بنجاح",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $('#tfile' + id).remove();
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr);
                        Swal.fire('خطأ', 'حدث خطأ أثناء الحذف', 'error');
                    }
                });
            }

        });
    }
}

function fn_delete_object(id, object_type, row_id) {

    if (!id || id <= 0 || !object_type) return;

    Swal.fire({
        title: 'هل أنت متأكد؟',
        text: 'لن يمكنك التراجع عن هذا الإجراء!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'نعم، احذف',
        cancelButtonText: 'إلغاء'
    }).then((result) => {

        if (result.isConfirmed) {

            let url = '/units/delete_object/' + id + '/' + object_type;

            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    if (response == 1) {
                        Swal.fire({
                            icon: "success",
                            title: "تم الحذف بنجاح",
                            timer: 750,
                            showConfirmButton: false
                        });


                        if(object_type=='payment')
                        {
                            window.location.href = window.location.href ;
                        }
                        else {
                            $('#' + row_id).fadeOut(300, function () {
                                $(this).remove();
                            });
                            $('.' + row_id).fadeOut(300, function () {
                                $(this).remove();
                            });
                        }

                    }
                },
                error: function () {
                    Swal.fire('خطأ', 'حدث خطأ أثناء الحذف', 'error');
                }
            });
        }
    });
}



function onlyNumbers(e) {
	var c = e.which ? e.which : e.keyCode;
	if (c < 48 || c > 57) {
		return false;
	}
}
function numberValidation(e) {
	e.target.value = e.target.value.replace(/[^\d]/g, '');
	return false;
}

function cdid(gdid) {
	var gdf = gdid;
	var hdf = gdid + 'h';
	console.log(gdf);
	console.log(hdf);




	/*
		let elements = document.querySelectorAll('.cal_con input:last-child');

		for (let elem of elements) {
			console.log(elem.classList);
			elem.classList.add('w3-hide');
			break;
		  }

	*/











	picker.onPicked = function () {
		let elgd = document.getElementById(gdf);
		let elhd = document.getElementById(hdf);
		//let elhd=document.getElementsByClassName(hdf);
		console.log(elgd);
		console.log(elhd);
		if (picker.getPickedDate() instanceof Date) {
			elgd.value = picker.getPickedDate().getDateString();
			elhd.value = picker.getOppositePickedDate().getDateString();
		} else {
			elhd.value = picker.getPickedDate().getDateString();
			elgd.value = picker.getOppositePickedDate().getDateString();
		}
		console.log(elgd.value);
		console.log(elhd.value);
	};
	return hdf;
};
function openSidebar() {
	document.getElementById("mySidebar").style.display = "block"
}

function closeSidebar() {
	document.getElementById("mySidebar").style.display = "none"
}

function dropdown(el) {
	if (el.className.indexOf('expanded') == -1) {
		el.className = el.className.replace('collapsed', 'expanded');
	} else {
		el.className = el.className.replace('expanded', 'collapsed');
	}
}

function selectLang(el) {
	el.children[0].checked = true;
	picker.setLanguage(el.children[0].value)
}

function setFirstDay(fd) {
	picker.setFirstDayOfWeek(fd)
}

function setYear() {
	let el = document.getElementById('valYear');
	picker.setFullYear(el.value)
}

function setMonth() {
	let el = document.getElementById('valMonth');
	picker.setMonth(el.value)
}

function updateWidth(el) {
	pWidth = parseInt(el.value);
	if (!fixWidth()) {
		document.getElementById('valWidth').value = pWidth;
		picker.setWidth(pWidth)
	}
}

function pickDate(ev) {
	ev = ev || window.event;
	let el = ev.target || ev.srcElement;
	pLeft = ev.pageX;
	fixWidth();
	pickElm.style.top = ev.pageY + 'px';
	picker.setHijriMode(el.className == 'hijrDate');
	picker.show();
	el.blur();
}

function gotoToday() {
	picker.today()
}

function setTheme() {
	let el = document.getElementById('txtTheme');
	let n = parseInt(el.value);
	if (!isNaN(n)) picker.setTheme(n);
	else picker.setTheme(el.value)
}

function newTheme() {
	picker.setTheme()
}

function fixWidth() {
	let docWidth = document.body.offsetWidth;
	let isFixed = false;
	if (pLeft + pWidth > docWidth) pLeft = docWidth - pWidth;
	if (docWidth >= 992 && pLeft < 200) pLeft = 200;
	else if (docWidth < 992 && pLeft < 0) pLeft = 0;
	if (pLeft + pWidth > docWidth) {
		pWidth = docWidth - pLeft;
		picker.setWidth(pWidth);
		document.getElementById('valWidth').value = pWidth;
		document.getElementById('sliderWidth').value = pWidth;
		isFixed = true
	}
	pickElm.style.left = pLeft + 'px';
	return isFixed
}




document.addEventListener("DOMContentLoaded", function (event) {
	/*const elements = document.querySelectorAll('.hijrDate');

		elements.forEach((element) => {
			element.classList.add('w3-hide');

});*/

});
function showcon(sh) {
	var ghdate = sh;
	var hjdate = sh;

	document.getElementById(ghdate).style.display = 'block';
	document.getElementById(hjdate).style.display = 'none';
}


function gdcon(showdiv) {
	var willshowdiv = showdiv;
	var willhidediv = showdiv + 'h';

	//alert(willshowdiv);

	document.getElementById(willshowdiv).style.display = 'block';
	document.getElementById(willhidediv).style.display = 'none';
	document.getElementsByClassName(willhidediv)[0].style.display = 'block';
	document.getElementsByClassName(willshowdiv)[0].style.display = 'none';
}

function hjowcon(showdiv) {


	var willshowdiv = showdiv + 'h';
	var willhidediv = showdiv;

	//alert(willshowdiv);



	document.getElementById(willshowdiv).style.display = 'block';
	document.getElementById(willhidediv).style.display = 'none';
	document.getElementsByClassName(willshowdiv)[0].style.display = 'none';
	document.getElementsByClassName(willhidediv)[0].style.display = 'block';


}



// مسار الصفحات

const path = window.location.pathname;

const translations = {
	"home": "الرئيسية",
	"employees": "الموظفين",
	"edit": "تعديل",
	"payrolls": "المرتبات",
	"centers": "المراكز الرئيسية",
	"renters": "المستأجرين",
	"sarfs": "المصروفات",
	"payments": "الايرادات",
	"users": " المستخدمين",
	"recipients": "المستفيدين",
	"create": "إنشاء",
	"show": "عرض",
	"maincenters": "المراكز الرئيسية",
	"addPayroll": " إضافة راتب"
};

if (path !== "/" && path !== "/home" && path !== "/index" && path !== "/index.php") {
	const parts = path.split('/').filter(p => p);

	let breadcrumb = '<a href="/"><i class="fa-solid fa-house"></i> الرئيسية</a>';
	let link = '';

	parts.forEach((part, index) => {
		link += '/' + part;
		let label = translations[part] || part; // لو مالهاش ترجمة يسيبها زي ما هي
		breadcrumb += ' / <a href="' + link + '" >' + label + '</a>';
	});

	document.getElementById('breadcrumb').innerHTML = breadcrumb;
} else {
	document.getElementById('breadcrumb').style.display = "none";
}




// تفعيل فتح الراوبط في القائمة الجانبيه

document.addEventListener("DOMContentLoaded", function () {
	const currentUrl = window.location.pathname;

	const menuLinks = document.querySelectorAll('.menu-sub .menu-link');

	menuLinks.forEach(link => {
		if (!link.href || link.getAttribute('href') === '#') return;

		const linkPath = new URL(link.href).pathname;

		if (currentUrl.startsWith(linkPath)) {
			const subItem = link.closest('.menu-item');
			subItem.classList.add('active');

			const mainItem = subItem.closest('ul.menu-sub')?.closest('.menu-item');
			if (mainItem) {
				mainItem.classList.add('active', 'open');
			}
		}
	});
});
