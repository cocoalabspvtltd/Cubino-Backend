<x-app-layout>
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->


        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                
                            </div>
                            <h4 class="page-title">Welcome!</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xxl-3 col-sm-6">
                        <div class="card widget-flat text-bg-pink">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="ri-eye-line widget-icon"></i>
                                </div>
                                <h6 class="text-uppercase mt-0" title="Customers">Todays Booking</h6>
                                <h2 class="my-2">2</h2>

                            </div>
                        </div>
                    </div> <!-- end col-->

                    <div class="col-xxl-3 col-sm-6">
                        <div class="card widget-flat text-bg-purple">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="ri-wallet-2-line widget-icon"></i>
                                </div>
                                <h6 class="text-uppercase mt-0" title="Customers">Hotels</h6>
                                <h2 class="my-2">4</h2>

                            </div>
                        </div>
                    </div> <!-- end col-->

                    <div class="col-xxl-3 col-sm-6">
                        <div class="card widget-flat text-bg-info">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="ri-shopping-basket-line widget-icon"></i>
                                </div>
                                <h6 class="text-uppercase mt-0" title="Customers">Users</h6>
                                <h2 class="my-2">7</h2>

                            </div>
                        </div>
                    </div> <!-- end col-->

                    <div class="col-xxl-3 col-sm-6">
                        <div class="card widget-flat text-bg-primary">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="ri-group-2-line widget-icon"></i>
                                </div>
                                <h6 class="text-uppercase mt-0" title="Customers">Users</h6>
                                <h2 class="my-2">7</h2>

                            </div>
                        </div>
                    </div> <!-- end col-->
                </div>

                {{-- <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-widgets">
                                    <a href="javascript:;" data-bs-toggle="reload"><i class="ri-refresh-line"></i></a>
                                    <a data-bs-toggle="collapse" href="#weeklysales-collapse" role="button"
                                        aria-expanded="false" aria-controls="weeklysales-collapse"><i
                                            class="ri-subtract-line"></i></a>
                                    <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                                </div>
                                <h5 class="header-title mb-0">Weekly Sales Report</h5>

                                <div id="weeklysales-collapse" class="collapse pt-3 show">
                                    <div dir="ltr">
                                        <div id="revenue-chart" class="apex-charts"
                                            data-colors="#3bc0c3,#1a2942,#d1d7d973"></div>
                                    </div>

                                    <div class="row text-center">
                                        <div class="col">
                                            <p class="text-muted mt-3">Current Week</p>
                                            <h3 class=" mb-0">
                                                <span>$506.54</span>
                                            </h3>
                                        </div>
                                        <div class="col">
                                            <p class="text-muted mt-3">Previous Week</p>
                                            <h3 class=" mb-0">
                                                <span>$305.25 </span>
                                            </h3>
                                        </div>
                                        <div class="col">
                                            <p class="text-muted mt-3">Conversation</p>
                                            <h3 class=" mb-0">
                                                <span>3.27%</span>
                                            </h3>
                                        </div>
                                        <div class="col">
                                            <p class="text-muted mt-3">Customers</p>
                                            <h3 class=" mb-0">
                                                <span>3k</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col-->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-widgets">
                                    <a href="javascript:;" data-bs-toggle="reload"><i
                                            class="ri-refresh-line"></i></a>
                                    <a data-bs-toggle="collapse" href="#yearly-sales-collapse" role="button"
                                        aria-expanded="false" aria-controls="yearly-sales-collapse"><i
                                            class="ri-subtract-line"></i></a>
                                    <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                                </div>
                                <h5 class="header-title mb-0">Yearly Sales Report</h5>

                                <div id="yearly-sales-collapse" class="collapse pt-3 show">
                                    <div dir="ltr">
                                        <div id="yearly-sales-chart" class="apex-charts"
                                            data-colors="#3bc0c3,#1a2942,#d1d7d973"></div>
                                    </div>
                                    <div class="row text-center">
                                        <div class="col">
                                            <p class="text-muted mt-3 mb-2">Quarter 1</p>
                                            <h4 class="mb-0">$56.2k</h4>
                                        </div>
                                        <div class="col">
                                            <p class="text-muted mt-3 mb-2">Quarter 2</p>
                                            <h4 class="mb-0">$42.5k</h4>
                                        </div>
                                        <div class="col">
                                            <p class="text-muted mt-3 mb-2">All Time</p>
                                            <h4 class="mb-0">$102.03k</h4>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h4 class="fs-22 fw-semibold">69.25%</h4>
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> US Dollar
                                            Share</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div id="us-share-chart" class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div> <!-- end card-->
                    </div> <!-- end col-->

                </div> --}}
                <!-- end row -->


                <!-- end row -->

            </div>
            <!-- container -->

        </div>
        <!-- content -->
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
</x-app-layout>
