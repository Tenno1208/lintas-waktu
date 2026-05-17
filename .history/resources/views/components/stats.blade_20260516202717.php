@props(['mountains'])

@php
$totalMountains = $mountains->count();
$totalMdpl = $mountains->sum('height');
$highestPoint = $mountains->max('height') ?? 0;
@endphp