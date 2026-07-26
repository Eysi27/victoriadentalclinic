<?php
require 'database_connection.php';
$display_query = "select event_id,event_name,event_start_date,event_end_date from calendar_event_master";
$results = mysqli_query($con, $display_query);
$count = mysqli_num_rows($results);
if ($count > 0) {
	$data_arr = array();
	$i = 1;
	while ($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
		$eventName = trim($data_row['event_name']);
		$data_arr[$i]['event_id'] = $data_row['event_id'];
		$data_arr[$i]['title'] = $data_row['event_name'];
		$data_arr[$i]['start'] = date("Y-m-d", strtotime($data_row['event_start_date']));
		$data_arr[$i]['end'] = date("Y-m-d", strtotime($data_row['event_end_date']));
		// $data_arr[$i]['color'] = '#'.substr(uniqid(),-6); // 'green'; pass colour name
		if (in_array($eventName, ['Closed', 'Fully Booked', 'Holiday-Closed'])) {
			$data_arr[$i]['color'] = '#dc3545'; // Red
		} else {

			$dentist = '';

			if (preg_match('/Dentist:\s*(.+)/i', $eventName, $matches)) {
				$dentist = strtoupper(trim($matches[1]));
			}

			if (str_contains($dentist, 'JAO')) {
				$data_arr[$i]['color'] = "blue";
			} else if (str_contains($dentist, 'CARYL')) {
				$data_arr[$i]['color'] = "#4E1F6E";  //violet
			} else if (str_contains($dentist, 'KIM')) {
				$data_arr[$i]['color'] = "#F62477"; //pink
			} else if (str_contains($dentist, 'DANTE')) {
				$data_arr[$i]['color'] = "green";
			} else if (str_contains($dentist, 'VEM')) {
				$data_arr[$i]['color'] = "orange";
			} else {
				$data_arr[$i]['color'] = "dark-gray";
			}

		}
		$data_arr[$i]['url'] = '#';
		$i++;
	}

	$data = array(
		'status' => true,
		'msg' => 'successfully!',
		'data' => $data_arr
	);
} else {
	$data = array(
		'status' => false,
		'msg' => 'Error!'
	);
}

function getDarkRandomColor()
{
	$r = mt_rand(0, 150);
	$g = mt_rand(0, 150);
	$b = mt_rand(0, 150);

	return sprintf("#%02X%02X%02X", $r, $g, $b);
}
echo json_encode($data);
?>