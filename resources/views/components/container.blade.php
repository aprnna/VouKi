<div {{ $attributes->merge(['class' => 'tw-max-w-7xl tw-mx-auto sm:tw-px-6 lg:px-8 pb-6 tw-z-0 tw-opacity-0
    tw-translate-y-10 tw-duration-500 tw-ease-in-out tw-delay-150']) }}>
    {{ $slot }}
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const elements = document.querySelectorAll('.tw-opacity-0');
        elements.forEach((element, index) => {
            setTimeout(() => {
                element.classList.remove('tw-opacity-0', 'tw-translate-y-10');
            }, index * 150);
        });
    });
</script>