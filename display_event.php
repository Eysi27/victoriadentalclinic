<?php
require 'database_connection.php';

$display_query = "
SELECT
    event_id,
    event_name,
    event_start_date,
    event_end_date,
    event_time
FROM calendar_event_master
ORDER BY event_start_date ASC, event_time ASC
";

$results = mysqli_query($con, $display_query);

$data_arr = array();

if (mysqli_num_rows($results) > 0) {

	while ($row = mysqli_fetch_assoc($results)) {

		// Build the start datetime
		$start = new DateTime(
			date('Y-m-d', strtotime($row['event_start_date'])) .
			' ' .
			$row['event_time']
		);

		// Appointment duration = 30 minutes
		$end = clone $start;
		$end->modify('+30 minutes');

		$eventName = trim($row['event_name']);

		$event = array();
		$event['event_id'] = $row['event_id'];
		$event['title'] = "\n" . $eventName;
		$event['start'] = $start->format('Y-m-d\TH:i:s');
		$event['end'] = $end->format('Y-m-d\TH:i:s');
		$event['url'] = '#';

		if (in_array($eventName, ['Closed', 'Fully Booked', 'Holiday-Closed'])) {

			$event['color'] = '#dc3545';

		} else {

			$dentist = '';

			if (preg_match('/Dentist:\s*(.+)/i', $eventName, $matches)) {
				$dentist = strtoupper(trim($matches[1]));
			}

			if (strpos($dentist, 'JAO') !== false) {
				$event['color'] = 'blue';
			} elseif (strpos($dentist, 'CARYL') !== false) {
				$event['color'] = '#4E1F6E';
			} elseif (strpos($dentist, 'KIM') !== false) {
				$event['color'] = '#F62477';
			} elseif (strpos($dentist, 'DANTE') !== false) {
				$event['color'] = 'green';
			} elseif (strpos($dentist, 'VEM') !== false) {
				$event['color'] = 'orange';
			} else {
				$event['color'] = 'blue-green';
			}

		}

		$data_arr[] = $event;
	}

	echo json_encode(array(
		"status" => true,
		"msg" => "success",
		"data" => $data_arr
	));

} else {

	echo json_encode(array(
		"status" => false,
		"msg" => "No events found.",
		"data" => array()
	));

}