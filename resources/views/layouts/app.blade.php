<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Novaly">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Vinayaga Traders</title>
    <!-- assets package -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <!-- google fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

</head>

<body>

    <!-- header starts -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ url('dashboard') }}" class="logo d-flex align-items-center">
                <span class="d-none d-lg-block text-white">Vinayaga Traders</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"
                        style="background: var(--green-100);">
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->name }}</h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ url('logout') }}">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header> <!-- header ends -->

    <!-- sidebar starts -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="{{ Request::is('dashboard') ? 'nav-link' : 'nav-link collapsed' }}"
                    href="{{ url('dashboard') }}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Request::is('customers*') ? 'nav-link' : 'nav-link collapsed' }}"
                    href="{{ route('customers.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Customers</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Request::is('products*') ? 'nav-link' : 'nav-link collapsed' }}"
                    href="{{ url('products') }}">
                    <i class="bi bi-grid"></i>
                    <span>Products</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="{{ Request::is('orders*') ? 'nav-link' : 'nav-link collapsed' }}"
                    href="{{ route('orders.index') }}">
                    <i class="bi bi-grid"></i>
                    <span>Orders</span>
                </a>
            </li>
        </ul>
    </aside> <!-- sidebar starts -->

    @yield('content')


    <div class="modal fade" id="verticalycentered" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-exclamation-triangle-fill"></i> Warning</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this record? Your record will be deleted permanently.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dismiss" data-bs-dismiss="modal">Close</button>
                    <form id="delete-form" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete" data-bs-dismiss="modal">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- footer starts -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>Vinayaga Traders</span></strong>. All Rights Reserved
        </div>
    </footer> <!-- footer ends -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    <!-- assets package -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        $(document).ready(function () {

            // Select2 Script
            $('.js-select').select2();

            // Delete Modal Script
            $(document).on("click", "#delete-record", function () {
                var url = $(this).data('id');
                console.log(url)
                $('#delete-form').attr('action', url);
            });

            $(document).on("click", "#delete-modal-cancel, #delete-modal-ok", function () {
                $("#delete-modal").addClass('hidden');
            });

            // Orders - Product Variant Dropdown Dependent Script
            $(document).on('change', '.productdrop', function () {
                var $append = $(this).parents('.multipleQueue').find('.variantdrop');
                $.get('/getvariant/' + this.value, function (data) {
                    $append.html(data);
                });
                $price = $(this).parents('.multipleQueue').find('.variantdrop :selected').attr('data-price');
                $total = $price * $(this).parents('.multipleQueue').find('.variant-qty').val();
                $(this).parents('.multipleQueue').find('.variant-price').attr('value', $total);
                orderTotalAmount();
            });

            $(document).on('change', '.variantdrop', function () {
                $price = $(this).parents('.multipleQueue').find('.variantdrop :selected').attr('data-price');
                $total = $price * $(this).parents('.multipleQueue').find('.variant-qty').val();
                $(this).parents('.multipleQueue').find('.variant-price').attr('value', $total);
                orderTotalAmount();
            });

            $(document).on('change', '.variant-qty', function () {
                $price = $(this).parents('.multipleQueue').find('.variantdrop :selected').attr('data-price');
                $total = $price * $(this).parents('.multipleQueue').find('.variant-qty').val();
                $(this).parents('.multipleQueue').find('.variant-price').attr('value', $total);
                orderTotalAmount();
            });

            // Multiple Input Script
            $('#add-q').on('click', function () {
                $('#product-q').append($('#clone-q').html());
            });

            // Hide Paid Amount Input if Fully Paid
            $(document).on('change', '#fully-paid', function () {
                if (this.value == 1) {
                    $('#paid-column').hide();
                } else {
                    $('#paid-column').show();
                }
                orderTotalAmount();
            });
            // Orders Total Amount Calculation
            $(document).on('change', '#deliver-charge', function () {
                orderTotalAmount();
            });
            $(document).on('change', '#extra-charge', function () {
                orderTotalAmount();
            });
            $(document).on('change', '#paid-amount', function () {
                orderTotalAmount();
            });
            function orderTotalAmount() {
                var price_total = 0;
                $('.variant-price').each(function (i, obj) {
                    price_total = +price_total + +this.value;
                });
                var deliver = $('#deliver-charge').val();
                var extra = $('#extra-charge').val();
                var paid = $('#paid-amount').val();
                var final = +deliver + +extra + +price_total;
                $('#total-amount').attr('value', final);
            }

            // Print Order Form
            $(document).on('click', '.order-info-print', function () {
                console.log('print logic here ..');
            });

            // Check Customer Record
            $(document).on('change', '.check-customer', function () {
                var $show = $('#show-customer-record');
                $.get('/getcustomerhistory/' + this.value, function (data) {
                    $show.html(data);
                });
            });
        });

    </script>
</body>

</html>