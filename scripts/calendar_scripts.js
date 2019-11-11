function load_calendar(cal_id) {

    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById(cal_id);

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            defaultDate: '2019-09-12',
            navLinks: true, // can click day/week names to navigate views
            businessHours: true, // display business hours
            editable: true,
            events: [
                // get events from database
            ]
        });

        calendar.render();
    });
}

function addEventToCal(cal_id, event) {

}