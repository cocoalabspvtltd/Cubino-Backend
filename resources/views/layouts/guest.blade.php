<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from techzaa.in/velonic/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Dec 2024 05:56:56 GMT -->

<head>
    <meta charset="utf-8" />
    <title>Login | Cubino</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}">

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/js/config.js')}}"></script>

    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg position-relative">

    {{ $slot }}


    @livewireScripts
    <footer class="footer footer-alt fw-medium">
        <span class="text-dark">
            <script>
                document.write(new Date().getFullYear())
            </script> © Cocoalabs pvt Ltd
        </span>
    </footer>
    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js')}}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.min.js')}}"></script>
</body>

</html>
