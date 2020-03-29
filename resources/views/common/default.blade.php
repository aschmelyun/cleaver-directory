<!DOCTYPE html>
<html lang="en-US">
@include('common.partials.head')
<body class="{{ $bodyClasses ?? '' }}">
<div class="h-screen antialiased">
    @include('common.partials.header')
    @yield('content')
    @include('common.partials.footer')
</div>
</body>
</html>