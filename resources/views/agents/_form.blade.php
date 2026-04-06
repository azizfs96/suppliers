@php
    $brandRows = old('brands');
    if (! is_array($brandRows)) {
        $brandRows = isset($agent) && is_array($agent->brands) && count($agent->brands) > 0
            ? $agent->brands
            : [''];
    }
    if (count($brandRows) === 0) {
        $brandRows = [''];
    }
@endphp
<div>
    <label for="name" class="ui-label">اسم الوكيل <span class="font-normal text-rose-400">*</span></label>
    <input id="name" name="name" type="text" value="{{ old('name', isset($agent) ? $agent->name : '') }}" required
        class="ui-input ui-input--muted">
    @error('name')
        <p class="mt-2 text-sm font-medium text-rose-400">{{ $message }}</p>
    @enderror
</div>
<div data-brand-repeater>
    <span class="ui-label">ماركات الوكيل</span>
    <p class="mb-3 text-xs text-zinc-500">أضف كل ماركة في حقل منفصل، ويمكنك إضافة أكثر من ماركة.</p>
    <div data-brand-rows class="space-y-2">
        @foreach ($brandRows as $i => $brand)
            <div data-brand-row class="flex flex-row items-stretch gap-2">
                <input type="text" name="brands[]" value="{{ $brand }}"
                    class="ui-input ui-input--muted min-w-0 flex-1" placeholder="مثال: سامسونج" autocomplete="off"
                    aria-label="ماركة {{ $i + 1 }}">
                <button type="button" data-brand-remove
                    class="ui-btn-secondary shrink-0 rounded-xl px-3 py-2 text-xs text-rose-400 hover:border-rose-500/40 hover:bg-rose-950/40">
                    حذف
                </button>
            </div>
        @endforeach
    </div>
    <button type="button" data-brand-add
        class="ui-btn-secondary mt-3 w-full rounded-xl border-dashed border-[#d4ff3f]/35 bg-[#d4ff3f]/5 text-zinc-200 hover:border-[#d4ff3f]/55 hover:bg-[#d4ff3f]/10 sm:w-auto">
        + إضافة ماركة أخرى
    </button>
    <template data-brand-row-template>
        <div data-brand-row class="flex flex-row items-stretch gap-2">
            <input type="text" name="brands[]" value=""
                class="ui-input ui-input--muted min-w-0 flex-1" placeholder="اسم الماركة" autocomplete="off"
                aria-label="ماركة جديدة">
            <button type="button" data-brand-remove
                class="ui-btn-secondary shrink-0 rounded-xl px-3 py-2 text-xs text-rose-400 hover:border-rose-500/40 hover:bg-rose-950/40">
                حذف
            </button>
        </div>
    </template>
    @error('brands')
        <p class="mt-2 text-sm font-medium text-rose-400">{{ $message }}</p>
    @enderror
</div>

@php
    $invType = old('inventory_system_type', isset($agent) ? ($agent->inventory_system_type ?? '') : '');
    $invNote = old('inventory_system_note', isset($agent) ? (string) ($agent->inventory_system_note ?? '') : '');
@endphp
<div class="space-y-3" data-inventory-system>
    <div>
        <span class="ui-label">نظام إدارة المنتجات / المخزون <span class="font-normal text-rose-400">*</span></span>
        <p class="mt-1 text-xs text-zinc-500">اختر خياراً واحداً. حقل اسم النظام أو التفاصيل اختياري حيث يظهر.</p>
    </div>
    <div class="space-y-3 rounded-xl border border-zinc-700/60 bg-zinc-900/40 p-4">
        <label class="flex cursor-pointer items-start gap-3 text-sm text-zinc-200">
            <input type="radio" name="inventory_system_type" value="erp" class="mt-1 size-4 shrink-0 rounded-full border-zinc-600 bg-zinc-800 text-[#d4ff3f] focus:ring-[#d4ff3f]/30"
                {{ $invType === 'erp' ? 'checked' : '' }} @if (! isset($agent)) required @endif>
            <span><span class="font-medium text-zinc-100">١- نظام ERP</span><span class="mt-0.5 block text-xs text-zinc-500">يمكنك كتابة اسم النظام إن وُجد (اختياري).</span></span>
        </label>
        <label class="flex cursor-pointer items-start gap-3 text-sm text-zinc-200">
            <input type="radio" name="inventory_system_type" value="excel" class="mt-1 size-4 shrink-0 rounded-full border-zinc-600 bg-zinc-800 text-[#d4ff3f] focus:ring-[#d4ff3f]/30"
                {{ $invType === 'excel' ? 'checked' : '' }}>
            <span class="font-medium text-zinc-100">٢- Excel</span>
        </label>
        <label class="flex cursor-pointer items-start gap-3 text-sm text-zinc-200">
            <input type="radio" name="inventory_system_type" value="cloud" class="mt-1 size-4 shrink-0 rounded-full border-zinc-600 bg-zinc-800 text-[#d4ff3f] focus:ring-[#d4ff3f]/30"
                {{ $invType === 'cloud' ? 'checked' : '' }}>
            <span><span class="font-medium text-zinc-100">٣- نظام سحابي للمخزون</span><span class="mt-0.5 block text-xs text-zinc-500">يمكنك كتابة اسم النظام إن وُجد (اختياري).</span></span>
        </label>
        <label class="flex cursor-pointer items-start gap-3 text-sm text-zinc-200">
            <input type="radio" name="inventory_system_type" value="accounting" class="mt-1 size-4 shrink-0 rounded-full border-zinc-600 bg-zinc-800 text-[#d4ff3f] focus:ring-[#d4ff3f]/30"
                {{ $invType === 'accounting' ? 'checked' : '' }}>
            <span><span class="font-medium text-zinc-100">٤- نظام محاسبي</span><span class="mt-0.5 block text-xs text-zinc-500">يمكنك كتابة اسم النظام إن وُجد (اختياري).</span></span>
        </label>
        <label class="flex cursor-pointer items-start gap-3 text-sm text-zinc-200">
            <input type="radio" name="inventory_system_type" value="none" class="mt-1 size-4 shrink-0 rounded-full border-zinc-600 bg-zinc-800 text-[#d4ff3f] focus:ring-[#d4ff3f]/30"
                {{ $invType === 'none' ? 'checked' : '' }}>
            <span class="font-medium text-zinc-100">٥- لا يوجد نظام</span>
        </label>
        <label class="flex cursor-pointer items-start gap-3 text-sm text-zinc-200">
            <input type="radio" name="inventory_system_type" value="other" class="mt-1 size-4 shrink-0 rounded-full border-zinc-600 bg-zinc-800 text-[#d4ff3f] focus:ring-[#d4ff3f]/30"
                {{ $invType === 'other' ? 'checked' : '' }}>
            <span><span class="font-medium text-zinc-100">٦- أخرى</span><span class="mt-0.5 block text-xs text-zinc-500">اكتب التفاصيل هنا إن رغبت (اختياري).</span></span>
        </label>
    </div>
    <div data-inventory-note-wrap class="{{ in_array($invType, ['erp', 'cloud', 'accounting', 'other'], true) ? '' : 'hidden' }}">
        <label for="inventory_system_note" class="ui-label">اسم النظام أو تفاصيل إضافية <span class="font-normal text-zinc-500">(اختياري)</span></label>
        <input id="inventory_system_note" type="text" name="inventory_system_note" value="{{ $invNote }}" data-inventory-note
            class="ui-input ui-input--muted" placeholder="مثال: اسم البرنامج أو وصف مختصر" maxlength="500" autocomplete="off">
        @error('inventory_system_note')
            <p class="mt-2 text-sm font-medium text-rose-400">{{ $message }}</p>
        @enderror
    </div>
    @error('inventory_system_type')
        <p class="text-sm font-medium text-rose-400">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="sales_rep_name" class="ui-label">اسم مندوب المبيعات</label>
    <input id="sales_rep_name" name="sales_rep_name" type="text" value="{{ old('sales_rep_name', isset($agent) ? $agent->sales_rep_name : '') }}"
        class="ui-input ui-input--muted">
    @error('sales_rep_name')
        <p class="mt-2 text-sm font-medium text-rose-400">{{ $message }}</p>
    @enderror
</div>
<div>
    <label for="phone" class="ui-label">رقم التواصل</label>
    <input id="phone" name="phone" type="tel" dir="ltr" value="{{ old('phone', isset($agent) ? $agent->phone : '') }}" placeholder="05xxxxxxxx"
        class="ui-input ui-input--muted text-left">
    @error('phone')
        <p class="mt-2 text-sm font-medium text-rose-400">{{ $message }}</p>
    @enderror
</div>
<div>
    <label for="location" class="ui-label">الموقع</label>
    <textarea id="location" name="location" rows="3" placeholder="عنوان، رابط خرائط، أو وصف الموقع"
        class="ui-textarea ui-textarea--muted">{{ old('location', isset($agent) ? $agent->location : '') }}</textarea>
    @error('location')
        <p class="mt-2 text-sm font-medium text-rose-400">{{ $message }}</p>
    @enderror
</div>
<button type="submit" class="ui-btn-primary mt-2">
    {{ $submit }}
</button>
