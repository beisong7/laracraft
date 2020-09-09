<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ env('APP_NAME', '') }} {{ !empty($title)?" | ".ucwords($title):""  }} | CMS  </title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/shared.css') }}" rel="stylesheet">

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

    @yield('other_css')

</head>
<body id="page-top">

    <div id="wrapper">

        @include('admin.layouts.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('admin.layouts.topbar')

                @yield('content')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; {{ env('SITE_DOMAIN', '') }} {{ date('Y') }}</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>

    @include('admin.layouts.footer')

    <!-- Bootstrap core JavaScript-->

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    {{--<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>--}}

    <!-- Page level custom scripts -->
    {{--<script src="{{ asset('admin/js/demo/chart-area-demo.js') }}"></script>--}}
    {{--<script src="{{ asset('admin/js/demo/chart-pie-demo.js') }}"></script>--}}

    @yield('other_js')

    <script type="text/javascript">
        function deleteThis(link) {
            var answer = prompt("Are you sure you want to delete this selection?");
            if (answer === "yes") {
                console.log('you said yes')
                window.location.href = link;
            }else{
                console.log('you said no')
            }
        }


        function shwimg(elem){
            // get the image to show selected image
            // var i = document.getElementById('imgInp');
            var cimg = elem.siblings('.childimg').children('img');
            var oImg = $('.single_img');
            // console.log(cimg);

            // console.log(cimg);

            //
            // var filetoload = $("#imgInp")[0];
            var filetoload = elem[0];

            // initiate the file reader object
            var reader = new FileReader();
            // read the contents of image file
            reader.readAsDataURL(filetoload.files[0]);
            reader.onload = function(e){
                // set the image source
                let srcs = e.target.result;

                cimg.attr('src', srcs);
                oImg.attr('src', srcs);

                // try to add result to another input
                // jQuery('#imgurl').val(e.target.result);
            }
            // another way to get the source of a file
            //=======================================//
            //display selected image into the image tag
            //document.getElementById('thepicture').src = window.URL.createObjectURL(i.files[0]);
        }

    </script>

</body>
</html>
