<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
    <style>
        .container-fluid {
            background-color: black;
            padding: 0;
        }

        .flex {
            display: flex;
            background-color: #f0f0f0;
            width: 100%;
        }

        .search {
            padding: 5px;
        }

        .right {
            text-align: right;
            width: 50%;
        }

        .text-left {
            width: 50%;
            padding: 7px;
        }

        .border-none {
            border: none;
            padding: 4px 5px;
        }

        #pageloader {
            background: rgba(255, 255, 255, 0.8);
            position: fixed;
            display: none;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
        }

        #pageloader i {
            left: 50%;
            margin-left: -32px;
            margin-top: -32px;
            position: absolute;
            top: 40%;
        }

        .fa-spinner {
            z-index: 9999;
            position: fixed;
            -webkit-transform: translateZ(0);
        }

        .align {
            display: flex;
            width: 100%;
            justify-content: center;
            gap: 3px;
            padding: 3px;
        }

        .col1 {
            width: 94%;
        }

        .col2 {
            width: 6%;
        }

        .direct-chat-messages {
            height: 74vh;
        }

        .fa-facebook-messenger {
            font-size: 23px;
            position: relative;
        }
        .none{
            position: absolute;
            display: none;
            top: 0;
            right: 1px;
        }

        .fa-circle {
            position: absolute;
            top: 0;
            right: 9px;
            margin-top: 5px;
            color: red;
            font-size: 15px;
            display: none;
        }
        .text{
            position: absolute;
            top: 0;
            margin-top: 2px;
            right: 13px;
            color: white;
            font-size: small;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Preloader -->
        <!-- <div id="pageloader">
            <i class="fa fa-spinner fa-spin fa-5x fa-fw text-primary"></i><span class="sr-only">Loading...</span>
        </div> -->
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" role="button">
                        <i class="fa-brands fa-facebook-messenger"></i>
                        <div class="none">
                            <i class="fa-solid fa-circle"></i>
                            <div class="text"></div>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('emp.logout')}}" class="btn btn-secondary btn-small">
                        logout
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    @if(auth()->user())
                    <div class="image">
                        <img src="{{ asset('profile/'.auth()->user()->image) }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ ucfirst(auth()->user()->name) }}</a>
                    </div>
                    @endif
                </div>
                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <a href="{{route('emp.index')}}" class="nav-link active">
                        Users
                    </a>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!---content--->

        @yield('content')
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</body>
<script>
    $(document).ready(function() {

        setInterval(function() {
            var receiver_id = $('#receiver_id').val();
            $.ajax({
                url: '{{ route("unread-message-count") }}',
                method: "GET",
                success: function(data) {
                    if (data.unreadMessageCount > 0) {
                        $('.none').show();
                        $('.fa-circle').show();
                        $('.text').html(data.unreadMessageCount);

                    } else {
                        $('.none').hide();
                        $('fa-solid .fa-circle').hide();
                    }
                }
            })
        }, 1000);

        setTimeout(() => {
            $('#alert').remove();
        }, 3000);
        //image change preview
        $('#uploadImage').change(function(e) {
            file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $("#edit_image")
                        .attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
        $("form").on("submit", function(e) {
            $("#pageloader").fadeIn();
        }); //submit
        //delete
        $('.confirm-button').click(function(event) {
            event.preventDefault();
            var url = $(this).data('href');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.value) {
                    window.location.href = url;
                }
            });

        });
    });
</script>

</html>