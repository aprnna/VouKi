@props(['completed'=>false, 'title', 'last'=>false])

@if($completed)
<li class="tw-relative tw-w-full tw-mb-6">
  <div class="tw-flex tw-items-center">
    <div
      class="tw-z-10 tw-flex tw-items-center tw-justify-center tw-w-6 tw-h-6 tw-bg-blue-600 tw-rounded-full tw-ring-0 tw-ring-white  sm:tw-ring-8  tw-shrink-0">
      <svg class="tw-w-2.5 tw-h-2.5 tw-text-blue-100 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 16 12">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M1 5.917 5.724 10.5 15 1.5" />
      </svg>
    </div>
    @if(!$last)
    <div class="tw-flex tw-w-full tw-bg-gray-200 tw-h-0.5"></div>
    @endif
  </div>
  <div class="tw-mt-3">
    <h3 class="tw-font-medium tw-text-gray-900 ">{{ $title }}</h3>
  </div>
</li>
@else
<li class="tw-relative tw-w-full tw-mb-6">
  <div class="tw-flex tw-items-center">
    <div
      class="tw-z-10 tw-flex tw-items-center tw-justify-center tw-w-6 tw-h-6 tw-bg-gray-200 tw-rounded-full tw-ring-0 tw-ring-white sm:tw-ring-8  tw-shrink-0">
      <svg class="tw-w-2.5 tw-h-2.5 tw-text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 16 12">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M1 5.917 5.724 10.5 15 1.5" />
      </svg>
    </div>
  </div>
  <div class="tw-mt-3">
    <h3 class="tw-font-medium tw-text-gray-900">{{ $title }}</h3>
  </div>
</li>
@endif