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

                        <h4 class="page-title">Update Rooms Details</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="needs-validation" method="POST"
                                action="{{ route('rooms.update', ['room' => $room->id]) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">Hotel</label>
                                    <div class="form-floating">
                                        <select class="form-select" id="floatingSelect" name="hotel_id"
                                            aria-label="Floating label select example">
                                            <option value="" disabled>Select Hotel</option>
                                            @foreach ($hotels as $hotel)
                                                <option value="{{ $hotel->id }}"
                                                    {{ $hotel->id == $selectedHotelId ? 'selected' : '' }}>
                                                    {{ $hotel->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="example-textarea" class="form-label">About</label>
                                    <textarea class="form-control" name="description" id="example-textarea" rows="5" require="">{{ $room->description }}</textarea>

                                </div>
                                <!-- Policies Editor -->
                                <div class="mb-3">
                                    <label class="form-label" for="aminities">Aminities</label>
                                    <div id="snow-editor-input" style="height: 300px;">{!! $room->aminities !!}</div>
                                    <input type="hidden" class="form-control" name="aminities" id="aminities-content">

                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">Price</label>
                                    <input type="text" class="form-control" id="validationCustom03" required=""
                                        name="price" value={{ $room->price }}>

                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">Guest Limit</label>
                                    <input type="text" class="form-control" id="validationCustom03" required=""
                                        name="guest_limit" value={{ $room->guest_limit }}>

                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">Upload Images</label>
                                    <input type="file" class="form-control" id="validationCustom03" name="image[]"
                                        multiple >
                                        <div class="image-container" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                            @php
                                            $roomImages = json_decode($room->room_images, true); // Decode JSON to array
                                        @endphp
                                                @foreach($roomImages as $image)
                                                    <div class="image-preview" style="text-align: center;">
                                                        <img src="{{ asset('storage/' . $image) }}" alt="Image" id="uploaded-image" style="width: 150px; height: 150px; object-fit: cover;">
                                                         <button type="button" class="btn btn-danger btn-sm" id="close-image-btn"><i class="ri-close-circle-fill"></i> Close
                                            </button>
                                                    </div>
                                                @endforeach

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

        document.getElementById('close-image-btn')?.addEventListener('click', function() {
            // Remove the image and button from the DOM
            document.getElementById('uploaded-image').remove();
            document.getElementById('close-image-btn').remove();
        });
    </script>


</x-app-layout>
