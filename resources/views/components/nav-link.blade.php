@props(['active', 'as' => 'a'])

@php
$classes = ($active ?? false)
? 'tw-inline-flex tw-items-center tw-px-1 tw-pt-1 tw-border-b-2 tw-border-primary2 tw-text-sm tw-font-medium
tw-leading-5 tw-text-white focus:tw-outline-none focus:tw-border-primary2 tw-transition tw-duration-150
tw-ease-in-out'
: 'tw-inline-flex tw-items-center tw-px-1 tw-pt-1 tw-border-b-2 tw-border-transparent tw-text-sm tw-font-medium
tw-leading-5 tw-text-white hover:tw-border-primary2 focus:tw-outline-none
focus:tw-text-primary2 focus:tw-border-primary2 tw-transition tw-duration-150 tw-ease-in-out';
@endphp

@if ($as == 'a')
    <a {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@elseif ($as =="form")
    <form {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </form>
@endif
