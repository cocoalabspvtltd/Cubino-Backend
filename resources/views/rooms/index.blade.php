<x-app-layout>
    <style>
        .snapstack {
            display: flex;
            /* Align snaps horizontally */
            flex-wrap: wrap;
            /* Allow wrapping to the next line if needed */
            justify-content: center;
            /* Center the content inside the container */
            align-items: center;
            /* Align items vertically */
            gap: 10px;
            /* Space between the snaps */
            max-width: 100%;
            /* Limit width to fit inside the table cell */
            overflow: hidden;
            /* Hide any overflow content */
        }

        .snapstack:hover .snap:not(:hover) {
            opacity: 0.6s;
            transition: all 0.2s ease;
        }

        .snap {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .snap--1 {
            z-index: 10;
            transform: rotate(-45deg);
        }

        .snap--2 {
            transform: rotate(-30deg);
            z-index: 20;
        }

        .snap--3 {
            transform: rotate(-15deg);
            z-index: 30;
        }

        .snap--4 {
            transform: rotate(0deg);
            z-index: 40;
        }

        .snap--5 {
            transform: rotate(15deg);
            z-index: 50;
        }

        .snap--6 {
            transform: rotate(30deg);
            z-index: 60;
        }

        .snap:hover {
            transform: rotate(0) scale(1.3);
            transition: all 0.5s ease;
            z-index: 100;
        }

        .snap:hover>.snap__caption {
            z-index: 110;
        }

        .snap__frame {
            width: 50px;
            /* Set a fixed size for the frames */
            height: 50px;
            /* Set a fixed size for the frames */
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            /* Make the frames circular */
            overflow: hidden;
        }

        .snap__frame--blue {
            background-color: #00cee2;
        }

        .snap__frame--purple {
            background-color: #9b73f3;
        }

        .snap__frame--red {
            background-color: #ff6e57;
        }

        .snap__frame--orange {
            background-color: #ff8c42;
        }

        .snap__frame--yellow {
            background-color: #fccc39;
        }

        .snap__frame--green {
            background-color: #7ddf64;
        }

        .snap__img {
            width: 100%;
            /* Ensure the image fits inside the frame */
            height: 100%;
            /* Ensure the image fits inside the frame */
            object-fit: cover;
            /* Ensure the image is cropped proportionally */
        }

        .snap__img {
            width: 100%;
            /* Ensure the image fits inside the frame */
            height: 100%;
            /* Ensure the image fits inside the frame */
            object-fit: cover;
            /* Ensure the image is cropped proportionally */
        }
    </style>
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h3 class="page-title">Rooms</h3>

                        <div class="d-flex justify-content-end align-items-center gap-2">
                            <a class="btn btn-soft-info" href="{{ route('rooms.create') }}"><i
                                    class=" ri-add-line fs-18 me-1 lh-1"></i>Add Rooms</a>
                        </div><br>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Hotel</th>
                                        <th>Description</th>
                                        <th>Aminities</th>
                                        <th>Price</th>
                                        <th>Guest Limit</th>
                                       
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($rooms as $item)
                                        <tr>
                                            <td class="table-user">
                                                <div class="snapstack">
                                                    <div class="snapstack">
                                                        @php
                                                            $roomImages = json_decode($item->room_images, true); // Decode JSON to array
                                                        @endphp
                                                        @forelse ($roomImages as $image)
                                                            <div class="snap">
                                                                <div class="snap__frame">
                                                                    <img src="{{ asset('storage/'.$image) }}" alt="Room Image"
                                                                        class="snap__img">
                                                                </div>

                                                            </div>
                                                        @empty
                                                            <div class="snap">
                                                                <div class="snap__frame">
                                                                    <img src="{{ asset('images/default-room.jpg') }}"
                                                                        alt="Default Room" class="snap__img">
                                                                </div>
                                                                <span class="snap__caption">No Images</span>
                                                            </div>
                                                        @endforelse
                                                    </div>
                                            </td>
                                            <td>{{ $item->hotel_id }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ Str::limit(strip_tags($item->aminities), 80, ' (more)') }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->guest_limit }}</td>

                                            <td>
                                                <a href="{{route('rooms.edit',['room' =>$item->id])}}" class="text-reset fs-16 px-1"> <i
                                                        class="ri-pencil-line"></i></a>
                                                <a href="javascript: void(0);" class="text-reset fs-16 px-1"> <i
                                                        class="ri-delete-bin-2-line"></i></a>
                                            </td>
                                        </tr>

                                    @empty
                                        <p>No Recodrs found</p>
                                    @endforelse

                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div>
        </div>
    </div>
</x-app-layout>
