<x-app-layout>
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Create Hotel</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="needs-validation" novalidate="" method="POST"
                                action="{{ route('hotel.store') }}" enctype="multipart/form-data">
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
                                    <label for="example-textarea" class="form-label">Address</label>
                                    <textarea class="form-control" name="address" id="example-textarea" rows="5" require=""></textarea>
                                    <div class="invalid-feedback">
                                        Please provide a valid address.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">Place</label>
                                    <input type="text" class="form-control" name="place" id="validationCustom03"
                                        required="">
                                    <div class="invalid-feedback">
                                        Please provide a valid Place.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">City</label>
                                    <div class="form-floating">
                                        <select class="form-select" id="floatingSelect" name="city"
                                            aria-label="Floating label select example">
                                            <option selected="">Select City</option>
                                            @foreach ($popularCities as $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="floatingSelect">Works with selects</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">State</label>
                                    <input type="text" class="form-control" name="state" id="validationCustom03"
                                        required="">
                                    <div class="invalid-feedback">
                                        Please provide a valid state.
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="policies">Policies</label>
                                    <div id="snow-editor-input" style="height: 300px;"></div>
                                    <input type="hidden" class="form-control" name="policies" id="policies-content">
                                    <div class="invalid-feedback">
                                        Please provide Policies.
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">Available Room Count</label>
                                    <input type="text" class="form-control" id="validationCustom03" required=""
                                        name="avaialable_room_count">
                                    <div class="invalid-feedback">
                                        Please provide a valid value.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">Booked Count</label>
                                    <input type="text" class="form-control" id="validationCustom03" required=""
                                        name="booked_count">
                                    <div class="invalid-feedback">
                                        Please provide a valid value.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="rating">Rating</label>
                                    <div class="rating">
                                        <input type="radio" id="star5" name="rating" value="5" /><label
                                            for="star5" title="5 stars">&#9733;</label>
                                        <input type="radio" id="star4" name="rating" value="4" /><label
                                            for="star4" title="4 stars">&#9733;</label>
                                        <input type="radio" id="star3" name="rating" value="3" /><label
                                            for="star3" title="3 stars">&#9733;</label>
                                        <input type="radio" id="star2" name="rating" value="2" /><label
                                            for="star2" title="2 stars">&#9733;</label>
                                        <input type="radio" id="star1" name="rating" value="1" /><label
                                            for="star1" title="1 star">&#9733;</label>
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
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        var quill_input = new Quill('#snow-editor-input', {
            theme: 'snow', // Snow theme
            placeholder: 'Write Policies here...',
            modules: {
                toolbar: [
                    [{ font: [] }, { size: [] }],
                    ['bold', 'italic', 'underline', 'strike'],

                    
                    [{ color: [] }, { background: [] }],
                    [{ script: 'sub' }, { script: 'super' }],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    [{ align: [] }],
                    ['link', 'image', 'video'],
                    ['clean']
                ]
            }
        });

        quill_input.on('text-change', function() {
            var content = quill_input.root.innerHTML;

            document.getElementById('policies-content').value = content;
        });

        document.querySelector('form').addEventListener('submit', function() {

            var content = quill_input.root.innerHTML;

            if (!content.trim()) {
                alert("Please fill in the Policies.");
                return false;
            }
        });

        document.getElementById('close-image-btn')?.addEventListener('click', function() {
            // Remove the image and button from the DOM
            document.getElementById('uploaded-image').remove();
            document.getElementById('close-image-btn').remove();
        });
    </script>
</x-app-layout>
