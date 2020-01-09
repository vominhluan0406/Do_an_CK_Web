<?php
  require __DIR__ . '/vendor/autoload.php';

  $options = array(
    'cluster' => 'ap1',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    '135cee8f6453c6fc2267',
    '2d19e37a22f17fd40590',
    '927858',
    $options
  );

  // $data['message'] = 'hello world';
  // $pusher->trigger('my-channel', 'my-event', $data);
?>