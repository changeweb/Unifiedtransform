
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css"/>
  <?php
    if(count($attendances) > 0){
      $events = array();
      foreach ($attendances as $attendance){
        if($attendance->present == 1){
          $events[] = \Calendar::event("Present",false,$attendance->created_at,$attendance->updated_at,0,['color'=>'green']);
        } else if($attendance->present == 2){
          $events[] = \Calendar::event("Escaped",false,$attendance->created_at,$attendance->updated_at,0,['color'=>'orange']);
        } else {
          $events[] = \Calendar::event("Absent",false,$attendance->created_at,$attendance->updated_at,0,['color'=>'red']);
        }
      }
      if(sizeof($events) > 0){
        $calendar = \Calendar::addEvents($events);
  ?>
  <div class="col-md-8">
    <h5>@lang('Attendance List of Full Semester')</h5>
    {!! $calendar->calendar() !!}
  </div>
    {!! $calendar->script() !!}
<?php
  } else {
    echo @json( __('No Related Data Found!'));
  }
} else {
  echo @json( __('No Related Data Found!'));
}
?>
