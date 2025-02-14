<x-app-layout>
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Edit Hotel Details</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="needs-validation" novalidate="" method="POST"
                                action="{{ route('hotel.update',['hotel'=> $hotel->id]) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Name</label>
                                    <input type="text" class="form-control" name="name" id="validationCustom01"
                                        value="{{ $hotel->name }}" required="">
                                </div>
                                <div class="mb-3">
                                    <label for="example-textarea" class="form-label">Address</label>
                                    <textarea class="form-control" name="address" id="example-textarea" rows="5" require="">{{ $hotel->address }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">Place</label>
                                    <input type="text" class="form-control" name="place" id="validationCustom03"
                                        value="{{ $hotel->place }}" required="">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">City</label>
                                    <div class="form-floating">
                                        <select class="form-select" id="floatingSelect" name="city"
                                            aria-label="Floating label select example">
                                            <option selected disabled>Select City</option>
                                            @foreach ($popularCities as $city)
                                                <option value="{{ $city->id }}"
                                                    {{ old('city', $hotel->city_id) == $city->id ? 'selected' : '' }}>
                                                    {{ $city->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">State</label>
                                    <input type="text" class="form-control" name="state" id="validationCustom03"
                                        value="{{ $hotel->state }}" required="">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="policies">Policies</label>
                                    <div id="snow-editor-input" style="height: 300px;">{!! $hotel->policies!!}</div>
                                    <input type="hidden" class="form-control" name="policies" id="policies-content">
                                    <div class="invalid-feedback">
                                        Please provide Policies.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">Available Room Count</label>
                                    <input type="text" class="form-control" id="validationCustom03" required=""
                                        value="{{ $hotel->avaialable_room_count }}" name="avaialable_room_count">
                                </div>
                                <div class="mb-3">
                                    <label for="rating">Rating</label>
                                    <div class="rating">
                                        <input type="radio" id="star5" name="rating" value="5"
                                            {{ old('rating', $hotel->rating) == 5 ? 'checked' : '' }} />
                                        <label for="star5" title="5 stars">&#9733;</label>

                                        <input type="radio" id="star4" name="rating" value="4"
                                            {{ old('rating', $hotel->rating) == 4 ? 'checked' : '' }} />
                                        <label for="star4" title="4 stars">&#9733;</label>

                                        <input type="radio" id="star3" name="rating" value="3"
                                            {{ old('rating', $hotel->rating) == 3 ? 'checked' : '' }} />
                                        <label for="star3" title="3 stars">&#9733;</label>

                                        <input type="radio" id="star2" name="rating" value="2"
                                            {{ old('rating', $hotel->rating) == 2 ? 'checked' : '' }} />
                                        <label for="star2" title="2 stars">&#9733;</label>

                                        <input type="radio" id="star1" name="rating" value="1"
                                            {{ old('rating', $hotel->rating) == 1 ? 'checked' : '' }} />
                                        <label for="star1" title="1 star">&#9733;</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">Upload an Image</label>
                                    <input type="file" class="form-control" id="validationCustom03"
                                        name="image" required="">
                                    @if ($hotel->image)
                                        <div class="image-container">
                                            <img src="{{ asset('storage/' . $hotel->image) }}" alt="Hotel Image" id="uploaded-image" width="300px;">
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
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        var quill_input = new Quill('#snow-editor-input', {
            theme: 'snow',
            placeholder: 'Write Policies here...',
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
            console.log(content);

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
