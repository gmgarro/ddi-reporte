@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Calendario General de Tareas</h2>
    <div id="calendar"></div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    let calendar = new FullCalendar.Calendar(
        document.getElementById('calendar'), {
            initialView: 'dayGridMonth',
            locale: 'es',
            events: '{{ url("admin/calendario/eventos") }}'
        }
    );

    calendar.render();
});
</script>
@endpush
