<x-app-layout>
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Add City</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="needs-validation" novalidate="" method="POST"
                                action="{{ route('cities.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Name</label>
                                    <input type="text" class="form-control" name="name" id="validationCustom01"
                                        required="">
                                    <div class="invalid-feedback">
                                        Please enter the Name.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">Upload an Image</label>
                                    <input type="file" class="form-control" id="validationCustom03"
                                        name="image" required="">
                                    <div class="invalid-feedback">
                                        Please upload image.
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Submit form</button>
                            </form>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div>
            <!-- end row -->

        </div> <!-- container -->
    </div>
    <script>
        document.getElementById('close-image-btn')?.addEventListener('click', function() {
            // Remove the image and button from the DOM
            document.getElementById('uploaded-image').remove();
            document.getElementById('close-image-btn').remove();
        });
    </script>
</x-app-layout>
