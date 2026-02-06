/**
 * Treeview (jquery)
 */

'use strict';

$(function() {
    $('#jstree-basic').jstree();

    $('#jstree-basic').on("select_node.jstree", function (e, data) {
        var node = data.node;
        var $li  = $("#" + node.id);
        var editUrl  = $li.data("edit-url");
        var dbId     = $li.data("db-id");
        var iban     = $li.data("iban");
        var maindata = $li.data("main-data");
        var tree = $('#jstree-basic').jstree(true);
        var parentText = "";
        var parentDbId = "";
        var parentDbIdText ="";
        var numChildrenText = "";
        var ibanText = "";
        var addSupCenterText = "";

        // خاص بالعناصر الفرعية
        if(node.parent !== "#") {
            var parentNode = tree.get_node(node.parent);
            parentText = parentNode.text;
            var $parentLi = $("#" + parentNode.id);
            parentDbId = $parentLi.data("db-id");
            parentDbIdText = `
                        
                        `;
        }
     // خاص بالعناصر الرئيسية
        if(node.parent === "#") {
            numChildrenText = `
                        <div class="col-md-6 p-0 float-start mb-1">
                            <div class="col-md-4 border rounded text-center fw-bold bg-light float-start p-1 me-1 mb-1 h-100">   عدد العماير       </div>
                            <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">${node.children.length}</div>
                        </div>
                    `;
            ibanText= `
                        <div class="col-md-6 p-0 float-start mb-1">
                            <div class="col-md-4 border rounded text-center fw-bold bg-light float-start p-1 me-1 mb-1 h-100">الحساب البنكي</div>
                            <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">${iban}</div>
                        </div>
                    `;
                    addSupCenterText= `
                                <a href='#'  data-maindata='${JSON.stringify(maindata).replace(/"/g, '&quot;')}' class='btn btn-sm btn-primary btn-add-sub'>
                                    <i class="fa-solid fa-notes-medical px-2"></i> إضافة   عمارة
                                </a>
                            `;
        }

        $("#details").html(`

    <div class="col-12 col-sm-12 col-lg-12 mb-4">
      <div class="card border">
        <div class="card-body">
                <div class="card-header">
                    <strong> ${node.text} </strong>
                    <div class="float-end">
                        ${addSupCenterText || ''}
                        <a href='${editUrl}' class='btn btn-sm btn-secondary'><i class="fa-solid fa-circle-info px-2"></i> المزيد من العملومات</a>
                    </div>
                </div>
          <div class="col-md-12 float-start">
              <div class="col-md-6 p-0 float-start mb-1">
                <div class="col-md-4 border rounded text-center fw-bold bg-light float-start p-1 me-1 mb-1 h-100">الاسم</div>
                <div class="col-md-7 border rounded float-start p-1 me-1 mb-1 h-100">${node.text}</div>
              </div>
              
              
             
             
                
                ${parentDbIdText || ''}
                ${numChildrenText || ''}
            </div>
          </div>
        </div>
      </div>
          `);

    });
});

// التعامل مع زر "إضافة مركز فرعي"
$(document).on("click", ".btn-add-sub", function (e) {
    e.preventDefault();

    // قراءة الـ data
    var maindata = $(this).data("maindata");

    // استدعاء الدالة
    fn_creat_new_center(maindata);
});
