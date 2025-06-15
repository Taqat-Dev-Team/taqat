@extends('layouts.front')
@section('title')
@endsection

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h1 class="card-label">عرض مواعيد الحجز</h1>
            </div>

        </div>
        <div class="card-body">
            <div id="calendar"></div>


        </div>
    </div>

    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Add Event</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="eventForm">
                        @csrf
                        <div class="form-group">
                            <label for="eventTitle">Event Title</label>
                            <input type="text" class="form-control" id="eventTitle" placeholder="Enter event title"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="eventTime">Select Time</label>
                            <input type="time" class="form-control" id="eventTime" required>
                        </div>
                        <input type="hidden" id="eventDate">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveEvent">Save Event</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="eventDetailsModal" tabindex="-1" aria-labelledby="eventDetailsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventDetailsLabel">تفاصيل الحجز</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <p><strong>العنوان:</strong> <span id="modalTitle"></span></p>
                    <p><strong>الاسم:</strong> <span id="modalName"></span></p>
                    <p><strong>من:</strong> <span id="modalFrom"></span></p>
                    <p><strong>إلى:</strong> <span id="modalTo"></span></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['dayGrid', 'interaction'],
                initialView: 'dayGridMonth',

                eventClick: function(info) {
                    const event = info.event;
                    const start = new Date(event.start);
                    const end = new Date(event.end);

                    const from = start.toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    const to = end.toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    });

                    document.getElementById('modalTitle').textContent = event.title;
                    document.getElementById('modalName').textContent = event.extendedProps.name ||
                        'غير متوفر';
                    document.getElementById('modalFrom').textContent = from;
                    document.getElementById('modalTo').textContent = to;

                    $('#eventDetailsModal').modal('show');
                }, // ✅ هنا كانت الفاصلة مفقودة

                events: '{{ route('front.appointments.getData') }}',
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                }
            });



            calendar.render();


        });
    </script>
@endsection
