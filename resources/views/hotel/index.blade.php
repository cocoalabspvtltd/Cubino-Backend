<x-app-layout>
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

             <!-- start page title -->
             <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h3 class="page-title">Hotels</h3>

                    <div class="d-flex justify-content-end align-items-center gap-2">
                        <a class="btn btn-soft-info" href="{{ route('hotel.create')}}"> <i class=" ri-add-line fs-18 me-1 lh-1"></i> Add Hotels</a>
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
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Place</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Policies</th>
                                        <th>Rating</th>
                                        <th>Available room Count</th>
                                        <th>Booked Count</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($hotels as $item)
                                    <tr>
                                        <td class="table-user">
                                            <img src="{{ asset('storage/'.$item->image) }}" alt="table-user"
                                                class="me-2" style="width: 120px; height:100px;">
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->place }}</td>
                                        <td>{{ $item->city }}</td>
                                        <td>{{ $item->state }}</td>
                                        <td>{!! $item->policies !!}</td>
                                        <td>{{ $item->rating }}</td>
                                        <td>{{ $item->avaialable_room_count }}</td>
                                        <td>{{ $item->booked_count }}</td>
                                        

                                        <td>
                                            <a href="{{ route('hotel.edit',['hotel' => $item->id])}}" class="text-reset fs-16 px-1"> <i
                                                    class="ri-pencil-line"></i></a>
                                            <a href="{{ route('hotel.destroy',['hotel' => $item->id])}}" class="text-reset fs-16 px-1"> <i
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
