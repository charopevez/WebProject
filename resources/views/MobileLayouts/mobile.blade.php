<!DOCTYPE html>
<html>
<head>
    @include('MobileIncludes.header')
</head>
<body>
    @include('MobileIncludes.menu')
    @include('MobileIncludes.searchbox')
    @yield('content')
{{--@include('MobileIncludes.searchbox')--}}
</body>
</html>
