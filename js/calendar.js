$(document).ready(function () {
    //fetch_event
    var calendar = $('#calendar').fullCalendar({
        editable:false,
        events: "actions/action_event.php",
        displayEventTime: true,
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        selectable: true,
        selectHelper: true,
        // add_event
        select: function (start, end, allDay) {
            var title = prompt('Informations rendes vous :');

            if (title) {
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
                var action = 1;

                $.ajax({
                    url: 'actions/action_event.php',
                    data: 'title=' + title + '&start=' + start + '&end=' + end + '&action=' + action,
                    type: "POST",
                    success: function (data) {
                        displayMessage("Added Successfully");
                    }
                });
                calendar.fullCalendar('renderEvent',
                    {
                        title: title,
                        start: start,
                        end: end,
                        allDay: allDay
                    },
                    true
                );
            }
            calendar.fullCalendar('unselect');
        },

        editable: true,
        // update_event  and drop
        eventDrop: function (event, delta) {
            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
            var action = 2;
            $.ajax({
                url: 'actions/action_event.php',
                data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id + '&action=' + action,
                type: "POST",
                success: function (response) {
                    displayMessage("Updated Successfully");
                }
            });
        },

// delete_event
        eventClick: function (event) {
            var deleteMsg = confirm("Voulez-vous vraiment supprimer le rendez vous ?");
            if (deleteMsg) {
                var action = 3;
                $.ajax({
                    type: "POST",
                    url: "actions/action_event.php",
                    data: "&id=" + event.id + '&action=' + action,

                    success: function (response) {
                        if (parseInt(response) > 0) {
                            $('#calendar').fullCalendar('removeEvents', event.id);
                            displayMessage("Deleted Successfully");
                        }
                    }
                });
            }
        }

    });
});

function displayMessage(message) {
    $(".response").html("<div class='success'>" + message + "</div>");
    setInterval(function () {
        $(".success").fadeOut();
    }, 2000);
}