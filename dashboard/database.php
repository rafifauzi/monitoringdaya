<?php
require_once "../config/config.php";	
	date_default_timezone_set("UTC");



	$mesin = '1';
	if(isset($_GET['mesin']))
	{
		$mesin = $_GET['mesin'];
	}
	else
	{
		$sql = "SELECT * FROM tabel_mesin WHERE `status` = '1'";
		$result = $con->query($sql);
		if ($result->num_rows > 0) 
		{
			$row = $result->fetch_assoc();
			$mesin = $row['ID_mesin'];
		}
	}		

	$sql = "SELECT * FROM `tabel_mesin`";
    $result = $con->query($sql);
	$jumlahMesin = $result->num_rows;

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()){
			if($row['ID_mesin'] == $mesin)
			{
				$sql = "UPDATE `tabel_mesin` SET `status` = '1' WHERE `ID_mesin` = '" . $row['ID_mesin'] . "'";
			}
			else
			{
				$sql = "UPDATE `tabel_mesin` SET `status` = '0' WHERE `ID_mesin` = '" . $row['ID_mesin'] . "'";
			}
			$con->query($sql);
		}
	}
			

	for($i=0;$i<$jumlahMesin;$i++)
	{
		$sql = "UPDATE `tabel_mesin` SET `status` = '1' WHERE `tabel_mesin`.`ID_mesin` = 1";
	}

    $sql = "SELECT * FROM tabel_monitoring WHERE `ID_mesin`='" . $mesin . "'";
    $result = $con->query($sql);
	
	$currentArr = array('name' => 'Current', 'valueSuffix' => '{value} A');
	$voltageArr = array('name' => 'Voltage', 'valueSuffix' => '{value} V', 'yAxis' => 1,);
	$powerArr = array('name' => 'Power', 'valueSuffix' => '{value} kW');

	$currentData = [];
	$voltageData = [];
	$powerData = [];
	

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            // $arr = array (
                // 'name' => $row['Date_Time'],
                // 'data' => array_map('intval', explode(',', $row['Power']))
            // );
            // $series_array[] = $arr;
            $arr = array ('x' => strtotime($row['Date_Time']) * 1000,'y' => floatval($row['Current']));
            $currentData[] = $arr;
            $arr = array ('x' => strtotime($row['Date_Time']) * 1000,'y' => floatval($row['Voltage']));
            $voltageData[] = $arr;
            $arr = array ('x' => strtotime($row['Date_Time']) * 1000,'y' => floatval($row['Power']));
            $powerData[] = $arr;
        }
		$currentArr['data'] = $currentData;
		$voltageArr['data'] = $voltageData;
		$powerArr['data'] = $powerData;
		$series_array = array($powerArr);
		return json_encode ($series_array);
		
    }else{
		$series_array = array($powerArr);
		return json_encode ($series_array);
    }
	
	
	$con->close();
?>

