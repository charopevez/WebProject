<!DOCTYPE html>
<html>
<head>
    @include('customIncludes.header')
</head>
<body>
    @include('customIncludes.menu')
    @include('customIncludes.searchbox')
    @yield('content')
{{--@include('customIncludes.footer')--}}
</body>
</html>
