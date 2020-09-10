<!DOCTYPE html>
<html>
   <head>
      @include('includes.header')

   </head>


   <body>
      @include('includes.searchform')
      @yield('content')
      @include('includes.footer')
   </body>

</html>