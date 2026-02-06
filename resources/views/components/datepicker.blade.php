@props([
    'label' => '',
    'multiple' => false,
    'name_g' => 'datepicker-' . uniqid(),
    'name_h' => 'datepicker-' . uniqid(),
    'id_g' => null,
    'id_h' => null,
    'start_name_g' => 'datepicker-' . uniqid(),
    'start_name_h' => 'datepicker-' . uniqid(),
    'end_name_g' => 'datepicker-' . uniqid(),
    'end_name_h' => 'datepicker-' . uniqid(),
    'start_id_g' => null,
    'start_id_h' => null,
    'end_id_g' => null,
    'end_id_h' => null,
    'start_h' => '',
    'start_g' => '',
    'end_h' => '',
    'end_g' => '',
    'group' => 'group-' . uniqid(),
    'col' => 6,
    'default_view' => 'gregorian', // يتم التحكم به على مستوى المشروع كامل اي منهم الاساسي gregorian او hijri
])
@if($multiple)
    <div class="col-md-{{ $col }}">
      @if($label!="x")  <label class="form-label"><span>تاريخ بداية</span> <span>{{ $label }}</span></label> @endif
        <div class="calendar-group" data-group="start"  data-validate="range" data-range-group="{{ $group }}" data-default-view="{{ $default_view }}">
            <div class="field-row gregorian-row input-group gap-0 {{ $default_view === 'hijri' ? 'hidden' : '' }}">
                <input value="{{ $start_g }}" type="text" class="gregorian-date form-control" name="{{ $start_name_g }}" id="{{ $start_id_g ?? $start_name_g }}" placeholder="ميلادي" autocomplete="off">
                <div class="ios-switch-container">
                    <span class="switch-label">هجري</span>
                    <label class="ios-switch">
                        <input type="checkbox" class="calendar-switch">
                        <span class="ios-slider"></span>
                    </label>
                </div>
            </div>

            <div class="field-row hijri-row input-group gap-0 {{ $default_view === 'gregorian' ? 'hidden' : '' }}">
                <input value="{{ $start_h }}" type="text" class="hijri-date form-control" name="{{ $start_name_h }}" id="{{ $start_id_h ?? $start_name_h }}" placeholder="هجري" autocomplete="off">
                <div class="ios-switch-container">
                    <span class="switch-label-hijri">ميلادي</span>
                    <label class="ios-switch">
                        <input type="checkbox" class="calendar-switch-hijri" {{ $default_view === 'hijri' ? 'checked' : '' }}>
                        <span class="ios-slider"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-{{ $col }}">
        @if($label!="x")
        <label class="form-label"><span>تاريخ نهاية</span> <span>{{ $label }}</span></label> @endif
        <div class="calendar-group" data-group="end" data-validate="range" data-range-group="{{ $group }}" data-default-view="{{ $default_view }}">
            <div class="field-row align-items-center input-group gap-0 {{ $default_view === 'hijri' ? 'hidden' : '' }}">
                <input value="{{ $end_g }}" type="text" class="gregorian-date form-control" name="{{ $end_name_g }}" id="{{ $end_id_g ?? $end_name_g }}" placeholder="ميلادي" autocomplete="off" readonly>
                <div class="ios-switch-container">
                    <span class="switch-label">هجري</span>
                    <label class="ios-switch">
                        <input type="checkbox" class="calendar-switch">
                        <span class="ios-slider"></span>
                    </label>
                </div>
            </div>
            <div class="field-row hijri-row align-items-center input-group gap-0 {{ $default_view === 'gregorian' ? 'hidden' : '' }}"">
            <input value="{{ $end_h }}" type="text" class="hijri-date form-control" name="{{ $end_name_h }}" id="{{ $end_id_h ?? $end_name_h }}" placeholder="هجري" autocomplete="off" readonly>
            <div class="ios-switch-container">
                <span class="switch-label-hijri">ميلادي</span>
                <label class="ios-switch">
                    <input type="checkbox" class="calendar-switch-hijri" {{ $default_view === 'hijri' ? 'checked' : '' }}>
                    <span class="ios-slider"></span>
                </label>
            </div>
        </div>
    </div>
    </div>


@else



    <div class="col-md-{{ $col }}">
        @if($label!="x")
        <label class="form-label"><span>تاريخ</span> <span>{{ $label }}</span></label> @endif
        <div class="calendar-group" data-group=""  data-validate="" data-range-group="" data-default-view="{{ $default_view }}">
            <div class="field-row gregorian-row input-group gap-0 {{ $default_view === 'hijri' ? 'hidden' : '' }}"">
            <input value="{{ $start_g }}" type="text" class="gregorian-date form-control" name="{{ $name_g }}" id="{{ $id_g ?? $name_g }}" placeholder="ميلادي" autocomplete="off">
            <div class="ios-switch-container">
                <span class="switch-label">هجري</span>
                <label class="ios-switch">
                    <input type="checkbox" class="calendar-switch">
                    <span class="ios-slider"></span>
                </label>
            </div>
        </div>

        <div class="field-row hijri-row input-group gap-0 {{ $default_view === 'gregorian' ? 'hidden' : '' }}">
            <input value="{{ $start_h }}" type="text" class="hijri-date form-control" name="{{ $name_h }}" id="{{ $id_h ?? $name_h }}" placeholder="هجري" autocomplete="off">
            <div class="ios-switch-container">
                <span class="switch-label-hijri">ميلادي</span>
                <label class="ios-switch">
                    <input type="checkbox" class="calendar-switch-hijri" {{ $default_view === 'hijri' ? 'checked' : '' }}>
                    <span class="ios-slider"></span>
                </label>
            </div>
        </div>
    </div>
    </div>
@endif


{{--  datepicker use

<x-datepicker
    multiple="true"
    default_view="gregorian"
    start_name_g="contract_start_g"
    start_name_h="contract_start_h"
    start_id_g=""
    start_id_h=""
    end_name_g="contract_end_g"
    end_name_h="contract_end_h"
    end_id_g="contract-end-g"
    end_id_h="contract-end-h"
    start_h="{{ \App\Classes\Hijri::date('Y/m/d') }}"
    end_h="{{ \App\Classes\Hijri::date('Y/m/d') }}"
    label="العقد"
/>
<x-datepicker
    name_g="test_g"
    name_h="test_h"
    id_g="test-g"
    id_h="test-h"
    start_h="{{ \App\Classes\Hijri::date('Y/m/d') }}"
    label="العقد"
    col="12"
    default_view="gregorian"
/>
--}}
