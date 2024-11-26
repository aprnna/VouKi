@props(['event', 'value'])

<option {{ $event == $value ? 'selected' : '' }} value={{ $value }}>{{ $slot }}</option>
