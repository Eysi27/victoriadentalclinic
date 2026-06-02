<?php
require_once('databaseService.php');
session_start();
$service = new ServiceClass();

$clientid = urldecode($_POST['id']);
$result = $service->process($clientid);

class ServiceClass
{

    private $conn;
    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    //DO NOT INCLUDE THIS CODE
    public function process($clientid)
    {


        $query = "select * from toothremarks where clientid=:a";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':a', $clientid);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $tooth = $row['tooth'];
                $toothData[$tooth] = [
                    'image' => $row['image'],
                    'remarks' => $row['remarks']
                ];
            }
        }

        $query = "SELECT * FROM toothremarks WHERE clientid = :a";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':a', $clientid);
        $stmt->execute();

        $toothData = [];

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $tooth = $row['tooth'];
                $toothData[$tooth] = [
                    'image' => $row['image'],
                    'remarks' => $row['remarks']
                ];
            }
        }

        echo '<div class="text-center"><strong>UPPER</strong></div>';
        echo '<div class="tooth-arch">';

        // Column 1: Tooth 18–11
        echo '<div class="tooth-column">';
        foreach (range(18, 11) as $toothNumber) {
            $imgSrc = 'dentalcharts/tooth_1.png';
            $remark = '-';

            if (isset($toothData[$toothNumber])) {
                $imgSrc = 'data:image/png;base64,' . base64_encode($toothData[$toothNumber]['image']);
                $remark = htmlspecialchars($toothData[$toothNumber]['remarks']);
            }

            echo '
    <div class="tooth" data-tooth="' . $toothNumber . '" data-remarks="' . $remark . '">
        <div class="remark-display">' . $remark . '</div>
        <img src="' . $imgSrc . '" alt="Tooth ' . $toothNumber . '">
        <label>' . $toothNumber . '</label>
    </div>';
        }
        echo '</div>';

        // Column 2: Tooth 21–28
        echo '<div class="tooth-column">';
        foreach (range(21, 28) as $toothNumber) {
            $imgSrc = 'dentalcharts/tooth_1.png';
            $remark = '-';

            if (isset($toothData[$toothNumber])) {
                $imgSrc = 'data:image/png;base64,' . base64_encode($toothData[$toothNumber]['image']);
                $remark = htmlspecialchars($toothData[$toothNumber]['remarks']);
            }

            echo '
    <div class="tooth" data-tooth="' . $toothNumber . '" data-remarks="' . $remark . '">
        <div class="remark-display">' . $remark . '</div>
        <img src="' . $imgSrc . '" alt="Tooth ' . $toothNumber . '">
        <label>' . $toothNumber . '</label>
    </div>';
        }
        echo '</div>'; // End column 2

        echo '</div>'; // End .tooth-arch

        // Assuming $toothData is already fetched and ready from earlier
// Same logic applies here

        echo '<div class="tooth-arch" style="margin-top: 40px;">';

        // Column 1: 55 to 51
        echo '<div class="tooth-column">';
        foreach (range(55, 51) as $toothNumber) {
            $imgSrc = 'dentalcharts/tooth_1.png';
            $remark = '-';

            if (isset($toothData[$toothNumber])) {
                $imgSrc = 'data:image/png;base64,' . base64_encode($toothData[$toothNumber]['image']);
                $remark = htmlspecialchars($toothData[$toothNumber]['remarks']);
            }

            echo '
    <div class="tooth" data-tooth="' . $toothNumber . '" data-remarks="' . $remark . '">
        <div class="remark-display">' . $remark . '</div>
        <img src="' . $imgSrc . '" alt="Tooth ' . $toothNumber . '">
        <label>' . $toothNumber . '</label>
    </div>';
        }
        echo '</div>';

        // Column 2: 61 to 65
        echo '<div class="tooth-column">';
        foreach (range(61, 65) as $toothNumber) {
            $imgSrc = 'dentalcharts/tooth_1.png';
            $remark = '-';

            if (isset($toothData[$toothNumber])) {
                $imgSrc = 'data:image/png;base64,' . base64_encode($toothData[$toothNumber]['image']);
                $remark = htmlspecialchars($toothData[$toothNumber]['remarks']);
            }

            echo '
    <div class="tooth" data-tooth="' . $toothNumber . '" data-remarks="' . $remark . '">
        <div class="remark-display">' . $remark . '</div>
        <img src="' . $imgSrc . '" alt="Tooth ' . $toothNumber . '">
        <label>' . $toothNumber . '</label>
    </div>';
        }
        echo '</div>';

        echo '</div>'; // Close .tooth-arch

        // Footer row for LEFT/RIGHT label
        echo '
<div class="row">
    <div class="col-lg-6 text-left">
        <strong>RIGHT</strong>
    </div>
    <div class="col-lg-6 text-right">
        <strong>LEFT</strong>
    </div>
</div>';

        echo '<div class="tooth-arch" style="margin-top: 40px;">';

        // Column 1: 85 to 81
        echo '<div class="tooth-column">';
        foreach ([85, 84, 83, 82, 81] as $toothNumber) {
            $imgSrc = 'dentalcharts/tooth_1.png';
            $remark = '-';

            if (isset($toothData[$toothNumber])) {
                $imgSrc = 'data:image/png;base64,' . base64_encode($toothData[$toothNumber]['image']);
                $remark = htmlspecialchars($toothData[$toothNumber]['remarks']);
            }

            echo '
    <div class="tooth" data-tooth="' . $toothNumber . '" data-remarks="' . $remark . '">
        <div class="remark-display">' . $remark . '</div>
        <img src="' . $imgSrc . '" alt="Tooth ' . $toothNumber . '">
        <label>' . $toothNumber . '</label>
    </div>';
        }
        echo '</div>';

        // Column 2: 71 to 75
        echo '<div class="tooth-column">';
        foreach ([71, 72, 73, 74, 75] as $toothNumber) {
            $imgSrc = 'dentalcharts/tooth_1.png';
            $remark = '-';

            if (isset($toothData[$toothNumber])) {
                $imgSrc = 'data:image/png;base64,' . base64_encode($toothData[$toothNumber]['image']);
                $remark = htmlspecialchars($toothData[$toothNumber]['remarks']);
            }

            echo '
    <div class="tooth" data-tooth="' . $toothNumber . '" data-remarks="' . $remark . '">
        <div class="remark-display">' . $remark . '</div>
        <img src="' . $imgSrc . '" alt="Tooth ' . $toothNumber . '">
        <label>' . $toothNumber . '</label>
    </div>';
        }
        echo '</div>';

        echo '</div>'; // Close .tooth-arch
        echo '<div class="tooth-arch">';

        // Column 1: 48 to 41
        echo '<div class="tooth-column">';
        foreach ([48, 47, 46, 45, 44, 43, 42, 41] as $toothNumber) {
            $imgSrc = 'dentalcharts/tooth_1.png';
            $remark = '-';

            if (isset($toothData[$toothNumber])) {
                $imgSrc = 'data:image/png;base64,' . base64_encode($toothData[$toothNumber]['image']);
                $remark = htmlspecialchars($toothData[$toothNumber]['remarks']);
            }

            echo '
    <div class="tooth" data-tooth="' . $toothNumber . '" data-remarks="' . $remark . '">
        <div class="remark-display">' . $remark . '</div>
        <img src="' . $imgSrc . '" alt="Tooth ' . $toothNumber . '">
        <label>' . $toothNumber . '</label>
    </div>';
        }
        echo '</div>';

        // Column 2: 31 to 38
        echo '<div class="tooth-column">';
        foreach ([31, 32, 33, 34, 35, 36, 37, 38] as $toothNumber) {
            $imgSrc = 'dentalcharts/tooth_1.png';
            $remark = '-';

            if (isset($toothData[$toothNumber])) {
                $imgSrc = 'data:image/png;base64,' . base64_encode($toothData[$toothNumber]['image']);
                $remark = htmlspecialchars($toothData[$toothNumber]['remarks']);
            }

            echo '
    <div class="tooth" data-tooth="' . $toothNumber . '" data-remarks="' . $remark . '">
        <div class="remark-display">' . $remark . '</div>
        <img src="' . $imgSrc . '" alt="Tooth ' . $toothNumber . '">
        <label>' . $toothNumber . '</label>
    </div>';
        }
        echo '</div>';

        echo '</div>'; // Close .tooth-arch
        echo '<div class="text-center"><strong>LOWER</strong></div>';


    }
}
