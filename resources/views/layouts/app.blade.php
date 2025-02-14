<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from techzaa.in/velonic/layouts/auth-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Dec 2024 05:56:56 GMT -->

<head>
    <meta charset="utf-8" />
    <title>Register | Cubino</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Quill css -->
    <link href="{{ asset('assets/vendor/quill/quill.core.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet" type="text/css" />

    <!-- Theme Config Js -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg">

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')
        @livewire('sidebar-menu')

        <!-- Page Content -->
        <main>
            <div class="wrapper">
            <div class="content-page">
            {{ $slot }}
            </div>
            </div>
        </main>
    </div>

    <footer class="footer footer-alt fw-medium">
        <span class="text-dark-emphasis">
            <script>document.write(new Date().getFullYear())</script> © Cocoalabs pvt Ltd
        </span>
    </footer>

    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

      <!-- Quill Editor js -->
      <script src="{{ asset('assets/vendor/quill/quill.min.js')}}"></script>

      <!-- Quill Demo js -->
      <script src="{{ asset('assets/js/pages/quilljs.init.js')}}"></script>

       <!-- Dropzone File Upload js -->
       <script src="{{ asset('assets/vendor/dropzone/min/dropzone.min.js')}}"></script>

       <!-- File Upload Demo js -->
       <script src="{{ asset('assets/js/pages/fileupload.init.js')}}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
</body>

</html>
