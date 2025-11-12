@props(['disabled' => false, 'name' => null, 'id' => null])

<input @disabled($disabled) type="file" name="{{ $name }}" id="{{ $id ?? $name }}" {{ $attributes->class('block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none') }}>