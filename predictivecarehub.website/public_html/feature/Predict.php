<?php
$current_month = date('m');
$current_year = date('Y');
$sql = "SELECT * FROM predictive_information WHERE month='$current_month' AND year='$current_year'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    return;
} else {
    // data last month

    if ($current_month == 1) {
        $last_month = "SELECT * FROM predictive_information WHERE month=12 AND year=$current_year-1";
        $last_month_result = mysqli_query($conn, $last_month);
    } else {
        $last_month = "SELECT * FROM predictive_information WHERE month=$current_month-1 AND year=$current_year";
        $last_month_result = mysqli_query($conn, $last_month);
    }

    if (mysqli_num_rows($last_month_result) < 1) {
        return;
    }

    $last_year = "SELECT * FROM predictive_information WHERE month=12 AND year=$current_year-1";
    $last_year_result = mysqli_query($conn, $last_year);

    if (mysqli_num_rows($last_year_result) < 1) {
        return;
    }

    $admin_id;
    $disease = array();
    $prec_prev = array();
    $year;

    $dataArray;
    while ($row = mysqli_fetch_assoc($last_month_result)) {
        $dataArray = json_decode($row['data']);
        $admin_id = $row['admin_id'];
    }

    // getting previous data
    for ($i = 0; $i < count($dataArray); $i++) {
        $disease[] = $dataArray[$i]->disease;
        $prec_prev[] = $dataArray[$i]->prec_prev;
    }

    //lastyear data
    $lastYearArray;
    while ($row = mysqli_fetch_assoc($last_year_result)) {
        $lastYearArray = json_decode($row['data']);
    }

    $dataset = array();
    $information_data = array();

    for ($i = 0; $i < count($dataArray); $i++) {
        $current = $dataArray[$i]->previous;
        $latest = $dataArray[$i]->current;
        $previous = $lastYearArray[$i]->previous;

        $previous_data;
        if ($current_month == 1) {
            $previous_data =  $latest;
        } else {
            $previous_data =  $current;
        }

        $current_data = calculateMovingAverage($previous, $current, $latest, $current_month);
        $information_data[] = array(
            'disease' => $disease[$i],
            'current' => $current_data,
            'previous' => $previous_data,
            'prec_prev' => $prec_prev[$i]
        );
    }

    $data = json_encode($information_data);


    mysqli_query($conn, "UPDATE predictive_information SET selected=0");

    $insert = "INSERT INTO predictive_information (admin_id, month, year, data, selected ) VALUES ('$admin_id', '$current_month', '$current_year', '$data', 1)";
    mysqli_query($conn, $insert);
}

function calculateMovingAverage($previous, $current, $latest, $current_month)
{
    $windowSize = 3;
    $result = [];
    $start = $current_month;

    $sum = 0;

    if ($current_month < 3) {
        if ($current_month == 1) {
            $sum += $latest[0];
            $sum += $current[11];
            $sum += $current[10];
        } else if ($current_month == 2) {
            $sum += $current[1];
            $sum += $current[0];
            $sum += $previous[11];
        }
    } else {
        $sum += $current[$start - 1];
        $sum += $current[$start - 2];
        $sum += $current[$start - 3];
    }

    $average = $sum / $windowSize;

    foreach ($latest as $items) {
        if ($current_month == 1) {
            $result[] = 0;
        } else {
            $result[] = $items;
        }
    }

    $result[$start - 1] = (int)$average; // Convert to integer
    return $result;
}
?>