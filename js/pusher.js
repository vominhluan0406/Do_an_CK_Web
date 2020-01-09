// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('135cee8f6453c6fc2267', {
    cluster: 'ap1',
    forceTLS: true
});

var channel = pusher.subscribe('my-channel');
// channel.bind('my-event', function (data) {
//     alert(JSON.stringify(data));
// });