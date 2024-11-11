@props([
    'disabled' => false,    // チェックボックスが無効かどうか
    'checked' => false,     // チェックボックスが初期状態でチェックされているか
    'value' => null,        // チェックボックスの値
    'name' => null,         // チェックボックスのname属性
    'label' => null,        // チェックボックスのラベル
])

<div class="form-check">
    <input
        type="checkbox"
        name="{{ $name }}"
        value="{{ $value }}"
        id="{{ $name }}"
        @checked($checked)
        @disabled($disabled)
        {{ $attributes->merge(['class' => 'form-check-input']) }}>

    @if($label)
        <label class="form-check-label" for="{{ $name }}">
            {{ $label }}
        </label>
    @endif
</div>
