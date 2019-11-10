function load_calendar(cal_id, events) {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    today = yyyy + '-' + mm + '-' + dd;

    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById(cal_id);

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            defaultDate: today,
            navLinks: true, // can click day/week names to navigate views
            businessHours: true, // display business hours
            editable: true,
            events: [
                // get events from database
                // events.forEach(element => {
                //     element
                // })
                // {
                //     title: 'Business Lunch',
                //     start: '2019-11-03T13:00:00',
                //     end: '2019-11-07T13:00:00',
                //     constraint: 'businessHours'
                // },
                // {
                //     title: 'Meeting',
                //     start: '2019-11-13T11:00:00',
                //     constraint: 'availableForMeeting', // defined below
                //     color: '#257e4a'
                // },
            ]
        });

        events.forEach(element => {
            calendar.addEvent(element)
        })

        calendar.render();
    });
}

function addEventToCal(cal_id, event) {

}