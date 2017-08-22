<?php
/*  Copyright 2008  Kieran O'Shea  (email : kieran@kieranoshea.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Should we allow the feed to go out?
$sql = "SELECT config_value FROM " . WP_CALENDAR_CONFIG_TABLE . " WHERE config_item='enable_feed'";
$feed_yes = $wpdb->get_var($sql);
if ($feed_yes == 'true') {

  // Head up the file
  $ical_result = "BEGIN:VCALENDAR
VERSION:2.0
METHOD:PUBLISH
PRODID:-//wordpress.org/plugins calendar//EN
CALSCALE:GREGORIAN
";

  // Hard code future days to protect server load
  $future_days = 30;
  $day_count = 0;
  while ($day_count < $future_days+1)
  {
    // Craft our days into the future with the current one as a reference, get the eligible event on that day
    list($y,$m,$d) = explode("-",date("Y-m-d",mktime($day_count*24,0,0,date("m"),date("d"),date("Y"))));
    $events = grab_events($y,$m,$d,null);
    usort($events, "time_cmp");

    // Iterate through the events list and define a iCalendar VEVENT for each
    foreach($events as $event) {
      if ($event->event_time == '00:00:00') {
        $start = date('Ymd',mktime($day_count*24,0,0,date("m"),date("d"),date("Y")));
        $end = date('Ymd',mktime(($day_count+1)*24,0,0,date("m"),date("d"),date("Y")));;
      } else {
        // A little fudge on the end time here; we assume all events are 1 hour as end time isn't a field in calendar
        $start = date('Ymd',mktime($day_count*24,0,0,date("m"),date("d"),date("Y")))."T".date('His',strtotime($event->event_time))."Z";
        $end = date('Ymd',mktime($day_count*24,0,0,date("m"),date("d"),date("Y")))."T".date('His',strtotime($event->event_time)+3600)."Z";
      }
      $ical_result .= "BEGIN:VEVENT
DTSTART:".$start."
DTEND:".$end."
SUMMARY:".$event->event_title."
DESCRIPTION:".$event->event_desc."
UID:".$event->event_id."@".$_SERVER['SERVER_NAME']."
SEQUENCE:0
DTSTAMP:".date("YmdTHisZ")."
END:VEVENT
"; // Note the UID definition; event id is unique per install, each install has it's own domain (in theory)
    }
    $day_count++;
  }

  // Tail of the file, the mime type and return
  $ical_result .= "END:VCALENDAR";
  header("Content-type: text/calendar", true);
  header('Content-Disposition: attachment; filename="calendar.ics"');
  echo $ical_result;
}
?>