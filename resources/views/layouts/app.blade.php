<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ URL::asset('/assets/image/home/SMUSTAgentlogo.png') }}">


    <title>SMUST-Agent</title>


    <!-- Meta Description for SEO -->
    <meta name="description"
        content="SMUST-Agent ให้บริการฝากขายและเช่าทรัพย์สินออนไลน์ในประเทศไทย ค้นหาและเปรียบเทียบทรัพย์สินที่ดีที่สุดสำหรับการขายหรือเช่าได้ที่นี่">

    <!-- Meta Keywords for SEO -->
    <meta name="keywords"
        content="SMUST, ฝากทรัพย์, ขายบ้าน, เช่าบ้าน, อสังหาริมทรัพย์, ซื้อขายบ้าน, ขายคอนโด, อสังหาฯ, ฝากขายบ้าน, ตัวแทนอสังหา,นายหน้า">

    <!-- Open Graph Meta Tags for Social Sharing -->
    <meta property="og:title"
        content="SMUST-Agent - บริการฝากขายและเช่าทรัพย์สินออนไลน์ แพลตฟอร์มรวมอสังหาริมทรัพย์ และนายหน้าฝีมือดี พร้อมช่วยคุณหาทรัพย์ที่ตรงใจ ">
    <meta property="og:description"
        content="SMUST-Agent ให้บริการฝากขายและเช่าทรัพย์สินในประเทศไทย ค้นหาทรัพย์สินที่เหมาะสมกับคุณ แพลตฟอร์มรวมอสังหาริมทรัพย์ และนายหน้าฝีมือดี พร้อมช่วยคุณหาทรัพย์ที่ตรงใจ">
    <meta property="og:image" content="{{ URL::asset('/assets/image/home/SMUSTAgentlogo.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags for Sharing -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title"
        content="SMUST-Agent - บริการฝากขายและเช่าทรัพย์สินในประเทศไทย  แพลตฟอร์มรวมอสังหาริมทรัพย์ และนายหน้าฝีมือดี พร้อมช่วยคุณหาทรัพย์ที่ตรงใจ">
    <meta name="twitter:description"
        content="SMUST-Agent บริการฝากขายและเช่าทรัพย์สิน ค้นหาบ้านและทรัพย์สินที่ดีที่สุด แพลตฟอร์มรวมอสังหาริมทรัพย์ และนายหน้าฝีมือดี พร้อมช่วยคุณหาทรัพย์ที่ตรงใจ">
    <meta name="twitter:image" content="{{ URL::asset('/assets/image/home/SMUSTAgentlogo.png') }}">

    <!-- Fonts and Stylesheets -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ URL::asset('/assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/assets/css/css.css') }}" rel="stylesheet">

    <!-- Fonts -->

    {{-- <link rel="dns-prefetch" href="//fonts.bunny.net"> --}}
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- fonts --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link href="{{ URL::asset('/assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/assets/css/css.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">




</head>

<body>
    <div id="app">

        <main>
            @yield('content')
        </main>



        <script>
            function goBack() {
                window.history.back();
            }
        </script>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="{{ URL::asset('/assets/js/javascript.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
</body>

</html>
