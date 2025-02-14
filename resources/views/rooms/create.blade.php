<x-app-layout>
    <style>
        #imagePreview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        #imagePreview img {
            max-width: 150px;
            height: auto;
            border: 1px solid #ddd;
            padding: 5px;
        }
    </style>
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Add Rooms</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="needs-validation" method="POST"
                                action="{{ route('rooms.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">Hotel</label>
                                    <div class="form-floating">
                                        <select class="form-select" id="floatingSelect" name="hotel_id"
                                            aria-label="Floating label select example">
                                            <option selected="">Select Hotel</option>
                                            @foreach ($hotels as $hotel)
                                                <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="example-textarea" class="form-label">About</label>
                                    <textarea class="form-control" name="description" id="example-textarea" rows="5" ></textarea>
                                    <div class="invalid-feedback">
                                        Please provide a valid data.
                                    </div>
                                </div>
                                <!-- Policies Editor -->
                                <div class="mb-3">
                                    <label class="form-label" for="aminities">Aminities</label>
                                    <div id="snow-editor-input" style="height: 300px;"></div>
                                    <input type="hidden" class="form-control" name="aminities" id="aminities-content">
                                    <div class="invalid-feedback">
                                        Please provide Policies.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">Price</label>
                                    <input type="text" class="form-control" id="validationCustom03" required=""
                                        name="price">
                                    <div class="invalid-feedback">
                                        Please provide a valid value.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">Guest Limit</label>
                                    <input type="text" class="form-control" id="validationCustom03" required=""
                                        name="guest_limit">
                                    <div class="invalid-feedback">
                                        Please provide a valid value.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">Upload Room Images</label>
                                    <input type="file" class="form-control" id="validationCustom03" name="room_images[]" required multiple onchange="previewImages()">
                                    <div class="invalid-feedback">
                                        Please upload image.
                                    </div>
                                </div>

                                <!-- Image Preview Container -->
                                <div id="imagePreview" class="row"></div>



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
        // // Initialize the first editor
        var quill_input = new Quill('#snow-editor-input', {
            theme: 'snow', // Snow theme
            placeholder: 'Write facilities here...',
            modules: {
                toolbar: [
                    [{
                        font: []
                    }, {
                        size: []
                    }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{
                        color: []
                    }, {
                        background: []
                    }],
                    [{
                        script: 'sub'
                    }, {
                        script: 'super'
                    }],
                    [{
                        list: 'ordered'
                    }, {
                        list: 'bullet'
                    }],
                    [{
                        align: []
                    }],
                    ['link', 'image', 'video'],
                    ['clean']
                ]
            }
        });

        quill_input.on('text-change', function() {
            var content = quill_input.root.innerHTML;

            document.getElementById('aminities-content').value = content;
        });

        document.querySelector('form').addEventListener('submit', function() {

            var content = quill_input.root.innerHTML;

            if (!content.trim()) {
                alert("Please fill in the Aminities.");
                return false;
            }
        });

        function previewImages() {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = ''; // Clear previous previews

            const files = document.getElementById('validationCustom03').files;

            if (files) {
                Array.from(files).forEach(function(file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;  // Set image source to preview

                        preview.appendChild(img);  // Append the image to the preview container
                    };

                    reader.readAsDataURL(file);  // Convert file to Data URL for preview
                });
            }
        }

    </script>


</x-app-layout>
