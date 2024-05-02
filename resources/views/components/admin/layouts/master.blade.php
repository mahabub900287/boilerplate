@props([
    'classes' => 'account-pages',
])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>{{ config('settings.site_title', 'My Fitness Booking') }}</title>

    <link rel="shortcut icon" href="{{ asset(config('settings.favicon', 'assets/admin/images/favicon.ico')) }}">

    <x-admin.includes.styles>
        <x-slot name="topStyle">
            {{ $topStyle ?? '' }}
        </x-slot>

        <x-slot name="bottomStyle">
            {{ $bottomStyle ?? '' }}
        </x-slot>
    </x-admin.includes.styles>

</head>

<body class="{{ $classes }}">

    @if ($slot->isNotEmpty())
        {{ $slot ?? '' }}
    @endif



    <x-admin.includes.scripts>
        <x-slot name="topScript">
            {{ $topScript ?? '' }}
        </x-slot>

        <x-slot name="bottomScript">
            {{ $bottomScript ?? '' }}
        </x-slot>

    </x-admin.includes.scripts>

    <x-notify.notify></x-notify.notify>

</body>

</html>
