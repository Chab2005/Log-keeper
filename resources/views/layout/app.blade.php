<!DOCTYPE HTML/>
<html>
    @php
        $title = "";
    @endphp
    <head>
        <title>LOG KEEPER @if(!empty($title))- {{ $title }}@endif</title>
    <head/>

    @include('components.header')

    <body>
        @yield('content')
    </body>


    @include('components.footer')

</html>

