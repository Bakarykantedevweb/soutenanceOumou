<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from smarthr.co.in/demo/html/template/index by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 11 Jan 2026 20:12:59 GMT -->

<head>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | SmartHR - Advanced Bootstrap 5 Multipurpose Admin Dashboard Template for HRM, Payroll & CRM
    </title>

    <meta name="description"
        content="SmartHR - An advanced Bootstrap 5 admin dashboard template for HRM and CRM. Ideal for managing employee records, payroll, attendance, recruitment, and team performance with an intuitive and responsive design. Perfect for HR teams and business managers looking to streamline workforce management.">
    <meta name="keywords"
        content="HR dashboard template, HRM admin template, Bootstrap 5 HR dashboard, workforce management dashboard, employee management system, payroll dashboard, HR analytics, admin dashboard, CRM admin template, human resources management, HR admin template, team management dashboard, recruitment dashboard, employee attendance system, performance management, HR CRM, HR dashboard HTML, Bootstrap HR template, employee engagement, HR software, project management dashboard">
    <meta name="author" content="Dreams Technologies">
    <meta name="robots" content="index, follow">

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/apple-touch-icon.png') }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/x-icon">

    <!-- Theme Script js -->
    <script src="{{ asset('assets/js/theme-script.js') }}"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Feather CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icons/feather/feather.css') }}">

    <!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/tabler-icons/tabler-icons.min.css') }}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">

    <!-- Bootstrap Tagsinput CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">

    <!-- Summernote CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-lite.min.css') }}">

    <!-- Daterangepikcer CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/@simonwep/pickr/themes/nano.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

	
</head>

<body>

    <div id="global-loader">
        <div class="page-loader"></div>
    </div>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        @include('layouts.header')
        <!-- /Header -->

        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- /Sidebar -->
        <!-- Page Wrapper -->
        <div class="page-wrapper">
            <div class="content">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')

            </div>

            <div class="footer d-sm-flex align-items-center justify-content-between border-top bg-white p-3">
                <p class="mb-0">{{ date('Y') }} Bakary KANTE &copy; SAN-DIA Imprim.</p>
                <p>Designed &amp; Developed By <a href="javascript:void(0);" class="text-primary">Dreams</a></p>
            </div>

        </div>
        <!-- /Page Wrapper -->
    </div>
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Feather Icon JS -->
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>

    <!-- Slimscroll JS -->
    <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>

    <!-- Apex Chart JS -->
    <script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexchart/chart-data.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('assets/plugins/chartjs/chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/chartjs/chart-data.js') }}"></script>

    <!-- Datetimepicker JS -->
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- Daterangepicker JS -->
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <!-- Summernote JS -->
    <script src="{{ asset('assets/plugins/summernote/summernote-lite.min.js') }}"></script>

    <!-- Bootstrap Tagsinput JS -->
    <script src="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>

    <!-- Select2 JS -->
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

    <!-- Color Picker JS -->
    <script src="{{ asset('assets/plugins/@simonwep/pickr/pickr.es5.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/todo.js') }}"></script>
    <script src="{{ asset('assets/js/theme-colorpicker.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

    @stack('scripts')
</body>


<!-- Mirrored from smarthr.co.in/demo/html/template/index by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 11 Jan 2026 20:15:32 GMT -->

</html>
