<x-app-layout>

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h3 class="page-title">Booking List</h3>

                        <br>
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
                                        <th>Hotel Name</th>
                                        <th>Room</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Check-In</th>
                                        <th>Check-Out</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $booking)
                                        <tr>
                                        <tr>
                                            <input type="hidden" name="booking-id" class="booking-id"
                                                value={{ $booking->id }}>
                                            <td>{{ $booking->room->hotel->name }}</td>
                                            <th>Classic</th>
                                            <td>{{ \Carbon\Carbon::parse($booking->start_date)->format('Y-m-d') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($booking->end_date)->format('Y-m-d') }}</td>
                                            <td>
                                                @if ($booking->status == 'cancelled')
                                                    <span class="badge bg-danger">{{ ucfirst($booking->status) }}</span>
                                                @elseif($booking->status == 'confirmed')
                                                    <span
                                                        class="badge bg-success">{{ ucfirst($booking->status) }}</span>
                                                @else
                                                    <span
                                                        class="badge bg-secondary">{{ ucfirst($booking->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($booking->status == 'cancelled')

                                                <button class="btn btn-primary disabled"
                                                data-booking-id="{{ $booking->id }}">Check In</button>

                                                @elseif($booking->is_checked_in)
                                                    Checked In at
                                                    {{ \Carbon\Carbon::parse($booking->checked_in_at)->format('Y-m-d H:i') }}
                                                @else
                                                    <button class="btn btn-primary check-in-btn"
                                                        data-booking-id="{{ $booking->id }}">Check In</button>
                                                @endif
                                            </td>
                                            <td>
                                                @if($booking->status == 'cancelled')
                                                <button class="btn btn-primary disabled" data-booking-id="{{ $booking->id }}">Check Out</button>

                                               @elseif($booking->is_checked_out)
                                                    Checked Out at
                                                    {{ \Carbon\Carbon::parse($booking->checked_out_at)->format('Y-m-d H:i') }}
                                                @else
                                                <button class="btn btn-primary check-out-btn" data-booking-id="{{ $booking->id }}">Check Out</button>

                                                @endif
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.check-in-btn', function() {
            var bookingId = $(this).data('booking-id');
            $.ajax({
                url: '/booking/' + bookingId + '/check-in',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    booking: bookingId,
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        var checkInCell = $('[data-booking-id="' + bookingId + '"]').closest('td');
                    var checkOutCell = checkInCell.next('td'); // The next cell is Check-Out

                    var checkedInDate = new Date(response.checked_in_at).toLocaleString();

                    // Replace Check-In button with Checked-In info
                    checkInCell.html('<span>Checked In at ' + checkedInDate + '</span>');

                    // Enable Check-Out button
                    checkOutCell.html(
                        '<button class="btn btn-primary check-out-btn" data-booking-id="' +
                        bookingId +
                        '">Check Out</button>'
                    );
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    alert('Something went wrong. Please try again later.');
                }
            });
        });

        $(document).on('click', '.check-out-btn', function() {
            var bookingId = $(this).data('booking-id');
            $.ajax({
                url: '/booking/' + bookingId + '/check-out',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    booking: bookingId,
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message); // Display success message
                        var checkOutCell = $('[data-booking-id="' + bookingId + '"]').closest('td');
                    var checkedOutDate = new Date(response.checked_out_at).toLocaleString();

                    // Replace Check-Out button with Checked-Out info
                    checkOutCell.html('<span>Checked Out at ' + checkedOutDate + '</span>');
                    } else {
                        alert(response.message); // Display error message
                    }
                },
                error: function(xhr) {
                    alert('Something went wrong. Please try again later.');
                }
            });
        });
    </script>
</x-app-layout>
