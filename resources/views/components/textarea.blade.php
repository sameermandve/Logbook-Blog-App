@props(['disabled' => false])

<textarea @disabled($disabled) {{ $attributes->class('bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 p-2.5') }}>{{ $slot }}</textarea>