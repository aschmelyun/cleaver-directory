<!DOCTYPE html>
<html lang="en-US">
@include('common.partials.head')
<body class="{{ $bodyClasses ?? '' }}">
@include('common.partials.header')
<div class="min-h-screen">
    @yield('content')
</div>
@include('common.partials.footer')
</body>
</html>