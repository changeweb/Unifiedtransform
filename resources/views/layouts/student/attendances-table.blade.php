    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.css" integrity="sha256-AVsv7CEpB2Y1F7ZjQf0WI8SaEDCycSk4vnDRt0L2MNQ=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/moment/main.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/core/main.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/4.2.0/daygrid/main.min.js" integrity="sha256-FT1eN+60LmWX0J8P25UuTjEEE0ZYvpC07nnU6oFKFuI=" crossorigin="anonymous"></script>
    
    <?php
    if(count($attendances) > 0){
      $events = array();
      foreach ($attendances as $attendance){
        if($attendance->present == 1){
          $events[] = ['title'=> "Present", 'start' => $attendance->created_at, 'end' => $attendance->updated_at, 'color'=>'green'];
        } else if($attendance->present == 2){
          $events[] = ['title'=> "Escaped", 'start' => $attendance->created_at, 'end' => $attendance->updated_at, 'color'=>'orange'];
        } else {
          $events[] = ['title'=> "Absent", 'start' => $attendance->created_at, 'end' => $attendance->updated_at, 'color'=>'red'];
        }
      }
    } ?>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('attendanceCalendar');
        var attEvents = <?php if(sizeof($events) > 0){echo json_encode($events);} else {echo [];} ?>;
      
        var calendar = new FullCalendar.Calendar(calendarEl, {
          plugins: [ 'dayGrid' ],
          events: attEvents,
        });
        calendar.render();
      });
    </script>
    <div class="col-md-8">
      <h5>@lang('Attendance List of Full Semester')</h5>
      <div id="attendanceCalendar"></div>
    </div>
<?php
//   } else {
//     echo @json( __('No Related Data Found!'));
//   }
// } else {
//   echo @json( __('No Related Data Found!'));
// }
?>
