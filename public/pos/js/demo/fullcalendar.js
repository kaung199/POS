
// Misc-FullCalendar.js
// ====================================================================
// This file should not be included in your project.
// This is just a sample how to initialize plugins or components.
//
// - Designbudy.com -



$(document).ready(function() {


	// Calendar
	// =================================================================
	// Require Full Calendar
	// -----------------------------------------------------------------
	// http://fullcalendar.io/
	// =================================================================


	// initialize the external events
	// -----------------------------------------------------------------
	$('#demo-external-events .fc-event').each(function() {
		// store data so the calendar knows to render an event upon drop
		$(this).data('event', {
			title: $.trim($(this).text()), // use the element's text as the event title
			stick: true, // maintain when user navigates (see docs on the renderEvent method)
			className : $(this).data('class')
		});


		// make the event draggable using jQuery UI
		$(this).draggable({
			zIndex: 99999,
			revert: true,      // will cause the event to go back to its
			revertDuration: 0  //  original position after the drag
		});
	});


	// Initialize the calendar
	// -----------------------------------------------------------------
	$('#demo-calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		editable: true,
		droppable: true, // this allows things to be dropped onto the calendar
		drop: function() {
			// is the "remove after drop" checkbox checked?
			if ($('#drop-remove').is(':checked')) {
				// if so, remove the element from the "Draggable Events" list
				$(this).remove();
			}
		},
		defaultDate: '2016-06-12',
        selectable: true,
        selectHelper: true,
        select: function(start, end) {
				var title = prompt('Event Title:');
				var eventData;
				if (title) {
					eventData = {
						title: title,
						start: start,
						end: end
					};
					$('#demo-calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
				}
				$('#demo-calendars').fullCalendar('unselect');
	    },
		eventLimit: true, // allow "more" link when too many events
		events: [
			{
				title: 'Happy Hour',
				start: '2016-06-05',
				end: '2016-06-07',
				className: 'purple'
			},
			{
				title: 'Birthday Party',
				start: '2016-06-15',
				end: '2016-06-17',
				className: 'mint'
			},
			{
				title: 'All Day Event',
				start: '2016-06-15',
				className: 'warning'
			},
			{
				title: 'Meeting',
				start: '2016-06-20T10:30:00',
				end: '2016-06-20T12:30:00',
				className: 'danger'
			},
			{
				title: 'All Day Event',
				start: '2016-07-01',
				className: 'warning'
			},
			{
				title: 'Long Event',
				start: '2016-07-07',
				end: '2016-07-10',
				className: 'purple'
			},
			{
				id: 999,
				title: 'Repeating Event',
				start: '2016-07-09T16:00:00'
			},
			{
				id: 999,
				title: 'Repeating Event',
				start: '2016-07-16T16:00:00',
				className: 'success'
			},
			{
				title: 'Conference',
				start: '2016-07-11',
				end: '2016-07-13',
				className: 'dark'
			},
			{
				title: 'Meeting',
				start: '2016-07-12T10:30:00',
				end: '2016-07-12T12:30:00'
			},
			{
				title: 'Lunch',
				start: '2016-07-12T12:00:00',
				className: 'pink'
			},
			{
				title: 'Meeting',
				start: '2016-07-12T14:30:00'
			},
			{
				title: 'Happy Hour',
				start: '2016-07-12T17:30:00'
			},
			{
				title: 'Dinner',
				start: '2016-07-12T20:00:00'
			},
			{
				title: 'Birthday Party',
				start: '2016-07-13T07:00:00'
			},
			{
				title: 'Click for Google',
				url: 'http://google.com/',
				start: '2016-07-28'
			}
		]
	});

});
