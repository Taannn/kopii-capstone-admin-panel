@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-latte focus:border-coffee-brown focus:ring-coffee-brown rounded-md shadow-sm']) !!}>
