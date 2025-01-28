@props(['value'])

<label {{ $attributes->merge(['class' => 'tw-block tw-font-medium tw-text-sm tw-text-tertiary1']) }}>
    {{ $value ?? $slot }}
</label>
