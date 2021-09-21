@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-r-0 border-l-0 border-t-0 border-b-1']) !!}>

