<x-app-layout>
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Edit city</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="needs-validation" novalidate="" method="POST"
                                action="{{ route('cities.update',['city'=>$city->id]) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Name</label>
                                    <input type="text" class="form-control" name="name" id="validationCustom01" value="{{ $city->name}}"
                                        required="">
                                    <div class="invalid-feedback">
                                        Please enter the Name.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">Upload an Image</label>
                                    <input type="file" class="form-control" id="validationCustom03"
                                        name="image" required="">
                                        @if ($city->image)
                                        <div class="image-container">
                                            <img src="{{ asset('storage/' . $city->image) }}" alt="Hotel Image" id="uploaded-image" width="300px;">
                                            <button type="button" class="btn btn-danger btn-sm" id="close-image-btn"><i class="ri-close-circle-fill"></i> Close
                                            </button>
                                        </div>
                                    @endif
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
