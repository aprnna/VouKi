@props(['step'])

<ol {{ $attributes->merge(['class' => 'tw-flex tw-items-center']) }}>
  @switch($step)
  @case(1)
  <x-progress-item title="Create Event" />
  <x-progress-item title="Create Question" />
  <x-progress-item last title="Actived Event" />
  @break
  @case(2)
  <x-progress-item completed title="Create Event" />
  <x-progress-item title="Create Question" />
  <x-progress-item last title="Actived Event" />
  @break
  @case(3)
  <x-progress-item completed title="Create Event" />
  <x-progress-item completed title="Create Question" />
  <x-progress-item last title="Actived Event" />
  @break
  @case(4)
  <x-progress-item completed title="Create Event" />
  <x-progress-item completed title="Create Question" />
  <x-progress-item last completed title="Actived Event" />
  @break
  @default
  @endswitch
</ol>