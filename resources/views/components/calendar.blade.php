
<div style="width: 80%;margin: auto" id='calendar' class="font-georgia"></div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');

        const calendar = new FullCalendar.Calendar(calendarEl, {
            // initialView: 'listWeek',
            initialView: 'dayGridMonth',
            height: 'auto',
            events: '/api/calendarevent',
            eventContent: function(arg) {
                const imageUrl = arg.event.extendedProps.image_url;
                let customHtml = `<img src="${imageUrl}" style="width:100%; height:70px; object-fit:cover;" />`;
                return { html: customHtml };
            },
        });
        calendar.render();
    });
</script>

<style>
    #fc-dom-1 {
        font-size: 100%;
    }
</style>
