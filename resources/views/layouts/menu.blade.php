<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/home" class="app-brand-link">
              <span class="app-brand-logo demo">
                  <img width="20" src="{{ $root }}/assets/img/branding/logo2.svg"/>
              </span>
            <span class="app-brand-text demo menu-text fw-bold"> إدارة العقارات</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner border">

        <!--  Pages -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle ">
                <i class="menu-icon fa-solid fa-city fa-xl"></i>
                <div class="tajawal-bold" data-i18n="ادارة المراكز الرئيسية">ادارة المراكز الرئيسية</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/home" class="menu-link">
                        <i class="menu-ico fa-solid fa-building"></i>
                        <div data-i18n="المراكز الرئيسية">المراكز الرئيسية</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('units.index') }}" class="menu-link">
                        <i class="menu-ico fa-solid fa-sack-dollar"></i>
                        <div data-i18n="الشقق">الشقق</div>
                    </a>
                </li>
                <li class="menu-item ">
                    <a href="{{ route('employees.index') }}" class="menu-link">
                        <i class="menu-ico fa-solid fa-user-tie"></i>
                        <div data-i18n="الموظفين">الموظفين</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('renters.index') }}" class="menu-link">
                        <i class="menu-ico fa-solid fa-users"></i>
                        <div data-i18n="المستأجرين">المستأجرين</div>
                    </a>
                </li>
            </ul>
        </li>


        <!--  Pages -->

        <li class="menu-item  ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">

                <i class="menu-icon fa-solid fa-clipboard-list"></i>
                <div class="tajawal-bold" data-i18n="  ادارة العقود ">   ادارة العقود </div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item ">
                    <a href="{{ route('contracts.create') }}" class="menu-link">
                        <i class="menu-ico  fa-solid fa-file-circle-plus"></i>
                        <div data-i18n="اضافة عقد ">اضا فة عقد </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('contracts.index') }}" class="menu-link">
                        <i class="menu-ico fa-solid fa-file-signature"></i>
                        <div data-i18n="العقود المسجلة">   العقود المسجلة </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('contracts.contract_arch') }}" class="menu-link">
                        <i class="menu-ico fa-solid fa-file-signature"></i>
                        <div data-i18n="أرشيف العقود ">   أرشيف العقود  </div>
                    </a>
                </li>

            </ul>
        </li>
        <!--  Pages -->




        <li class="menu-item  ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon fa-solid fa-vault px-1"></i>
                <div class="tajawal-bold" data-i18n="ادارة الاموال">ادارة الاموال</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item  ">
                    <a href="{{ route('ohdas.index') }}" class="menu-link">
                        <i class="menu-ico fa-solid fa-wallet"></i>
                        <div data-i18n="العهدة">العهدة</div>
                    </a>
                </li>
                <li class="menu-item ">
                    <a href="{{ route('sarfs.index') }}" class="menu-link">
                        <i class="menu-ico fa-solid fa-file-invoice-dollar"></i>
                        <div data-i18n="المصروفات">المصروفات</div>
                    </a>
                </li>

                <li class="menu-item  ">
                    <a href="{{ route('payrolls.index') }}" class="menu-link">
                        <i class="menu-ico fa-solid fa-wallet"></i>
                        <div data-i18n="المرتبات">المرتبات</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('payments.index') }}" class="menu-link">
                        <i class="menu-ico fa-solid fa-money-bill-trend-up"></i>
                        <div data-i18n="الايرادات">الايرادات</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('payments.get_late_payments') }}" class="menu-link">
                        <i class="menu-ico fa-solid fa-clock-rotate-left"></i>


                        <div data-i18n="دفعات حان وقتها">دفعات حان وقتها</div>
                    </a>
                </li>

            </ul>
        </li>

        <li class="menu-item  ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-ico fa-solid fa-file-export"></i>
                <div class="tajawal-bold" data-i18n="التقارير">التقارير</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{route('reports.payrolls_rpt')}}" class="menu-link">
                        <i class="menu-ico fa-solid fa-file-export"></i>
                        <div data-i18n="تقارير الرواتب ">تقارير الرواتب </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('reports.ohda_rpt')}}" class="menu-link">
                        <i class="menu-ico fa-solid fa-file-export"></i>
                        <div data-i18n="تقارير المصروفات والعهدة ">تقارير المصروفات والعهدة </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="menu-ico fa-solid fa-file-export"></i>
                        <div data-i18n="تقارير الايرادات ">تقارير الايرادات </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="menu-ico fa-solid fa-file-export"></i>
                        <div data-i18n="تقارير المراكز">تقارير المراكز</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <i class="menu-ico fa-solid fa-file-export"></i>
                        <div data-i18n="تقارير المستأجرين">تقارير المستأجرين</div>
                    </a>
                </li>


            </ul>
        </li>
        @if ($current_user->is_admin)
            <li class="menu-item  ">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon fa-solid fa-sliders"></i>
                    <div class="tajawal-bold" data-i18n="اعدادات عامة"> اعدادات عامة</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item ">
                        <a href="{{ route('users.index') }}" class="menu-link">
                            <i class="menu-ico  fa-solid fa-user-gear"></i>
                            <div data-i18n="المستخدمين">المستخدمين</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('recipients.index') }}" class="menu-link">
                            <i class="menu-ico fa-solid fa-user-group"></i>
                            <div data-i18n="المستفيدين">المستفيدين</div>
                        </a>
                    </li>

                </ul>
            </li>
        @endif
    </ul>
    </li>


    </ul>
    </li>
    </ul>


    <div class="col-md-12 text-center">
        <img width="150" src="{{ $root }}/assets/img/branding/logo2.svg"/>
    </div>
    <div class="col-md-12 text-center">

        <DIV class="col-md-12 border">
            <div class="py-2" id="dayname"></div>
        </DIV>
        <div class="col-md-12 border">
            <h6 id="date" class="date d-none"></h6>
            <div class="py-2" id="monthname"></div>
        </div>
        <div class="col-md-12" style="background-color: #489164;">
            <h6 id="time" class="py-2" style="color:  #ffffff;;"></h6>
        </div>
    </div>
</aside>
