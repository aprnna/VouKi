<button {{ $attributes->merge(['type' => 'submit', 'class' => 'tw-inline-flex tw-items-center tw-px-4 tw-py-2
    tw-bg-gray-800 tw-border tw-border-transparent tw-rounded-md tw-font-semibold tw-text-xs tw-text-white tw-uppercase
    tw-tracking-widest tw-hover:bg-gray-700 tw-focus:bg-gray-700 tw-active:bg-gray-900 tw-focus:outline-none
    tw-focus:ring-2 tw-focus:ring-indigo-500 tw-focus:ring-offset-2 tw-transition tw-ease-in-out tw-duration-150']) }}>
    {{ $slot }}
</button>