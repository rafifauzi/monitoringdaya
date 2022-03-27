<?php include_once('../header.php');
$json_data = include('database.php');
?>

<!-- <head>
	<meta http-equiv="refresh" content="5">
</head> -->

<?php

if (isset($_GET['waktu'])) {
	$getTime = $_GET['waktu'];
	$ceksql = mysqli_query($con, "SELECT * FROM tabel_monitoring WHERE LEFT(Date_Time, 10)='$getTime'");
	$row = mysqli_num_rows($ceksql);

	$getTimeMonitoring = mysqli_query($con, "SELECT MAX(Date_Time) as 'lastTime' FROM tabel_monitoring WHERE `ID_mesin`='1'");
	$timeMonitoring = mysqli_fetch_array($getTimeMonitoring);
	$waktuTerakhir = $timeMonitoring['lastTime'];
	if ($row > 0) {
		$_SESSION['waktuTerakhir'] = $getTime;		
	} else {
		echo "Tidak Ada Data";
	}

} else {
	$sql = "SELECT MAX(Date_Time) FROM tabel_monitoring WHERE `ID_mesin`='1'";
	$result = $con->query($sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$waktuTerakhir = $row['MAX(Date_Time)'];
	}

	$getTimeMonitoring = mysqli_query($con, "SELECT MAX(Date_Time) as 'lastTime' FROM tabel_monitoring WHERE `ID_mesin`='1'");
	$timeMonitoring = mysqli_fetch_array($getTimeMonitoring);
	$waktuTerakhir = $timeMonitoring['lastTime'];
	$getTime = '';
}

$sql = "SELECT * FROM tabel_monitoring WHERE `ID_mesin` = '" . $mesin . "' AND `Date_Time` = '" . $waktuTerakhir . "'";
$query = mysqli_query($con, $sql);
$data = mysqli_fetch_array($query);
$sql_treshold = mysqli_query($con, "SELECT * FROM tabel_treshold WHERE `status` = '1' && `ID_mesin` = '" . $mesin . "';") or die(mysqli_error($con));
$treshold = mysqli_fetch_array($sql_treshold);


?>

<div style="padding-top: 30px;">
	<div class="row">
		<div class="col-lg-6">
			<div style="float: left;">
				<form action='' class="form-inline">
					<span>Select Machine</span>
					<select name='mesin' class="form-control">
						<?php
						$sql = "SELECT * FROM tabel_mesin";
						$result = $con->query($sql);
						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								if ($row['ID_mesin'] == $mesin) {
									echo "<option value=" . $row['ID_mesin'] . " selected>" . $row['no_mesin'] . "</option>";
								} else {
									echo "<option value=" . $row['ID_mesin'] . ">" . $row['no_mesin'] . "</option>";
								}
							}
						}
						?>
					</select>
					<button type='submit' class="btn btn-primary">Submit</button>
					<!-- <a href="datajson.php" target="blank" class="btn btn-primary">Lihat Json</a> -->
				</form>
				<br>
			</div>
		</div>
		<div class="col-lg-6">
			<div style="float: right;">
				<form action='' method="GET" class="form-inline">
					<span>Pilih Tanggal</span>
					<input type="date" class="form-control" name="waktu" value="<?= $getTime; ?>" required>
					<button type='submit' class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-lg-12" id="tampilanDetail" style="margin-top:20px;">
		<div style="float: right;">
			<?php
			if ($data['Power'] > $treshold['th_mesin_ready'] && $data['Power'] <= $treshold['th_spindel_on']) {
			?>
				<span class="label label-success">MESIN READY</span>
			<?php
			} elseif ($data['Power'] > $treshold['th_spindel_on'] && $data['Power'] <= $treshold['th_cutting']) {				
			?>
				<h4><span class="label label-warning">SPINDLE ON</span></h4>
			<?php
			} elseif ($data['Power'] > $treshold['th_cutting']) {
			?>
				<span class="label label-danger">CUTTING</span>
			<?php
			}

			// if (($dataTerakhir[2] > $treshold['th_mesin_ready']) && ($dataTerakhir[2] <= (int)$treshold['th_spindel_on']))
			// {
			// 	echo (int)$treshold['th_mesin_ready'];
			// }
			// else if (($dataTerakhir[2] > (int)$treshold['th_spindel_on']) && ($dataTerakhir[2] <= (int)$treshold['th_cutting']))
			// {
			// 	echo "SPINDLE ON";
			// }
			// else if (($dataTerakhir[2] > (int)$treshold['th_cutting']))
			// {
			// 	echo "CUTTING";
			// }
			?>
			<!-- <table>
				<tr>
					<td>Status </td>
					<td>
						<?php
						// if ($data['Power'] > $treshold['th_mesin_ready'] && $data['Power'] <= $treshold['th_spindel_on']) {
						// 	echo "MESIN READY";
						// } elseif ($data['Power'] > $treshold['th_spindel_on'] && $data['Power'] <= $treshold['th_cutting']) {
						// 	echo "SPINDLE ON";
						// } elseif ($data['Power'] > $treshold['th_cutting']) {
						// 	echo "CUTTING";
						// }

						// if (($dataTerakhir[2] > $treshold['th_mesin_ready']) && ($dataTerakhir[2] <= (int)$treshold['th_spindel_on']))
						// {
						// 	echo (int)$treshold['th_mesin_ready'];
						// }
						// else if (($dataTerakhir[2] > (int)$treshold['th_spindel_on']) && ($dataTerakhir[2] <= (int)$treshold['th_cutting']))
						// {
						// 	echo "SPINDLE ON";
						// }
						// else if (($dataTerakhir[2] > (int)$treshold['th_cutting']))
						// {
						// 	echo "CUTTING";
						// }
						?>
					</td>
				</tr>
			</table> -->
		</div>

		<div style="margin-top: 50px;">
			<div id="data_monitoring" style="float: left;width:100%"></div>
		</div>
		<div>

			<div style="float: left;width:50%;">
				<table>
					<tr>
						<td rowspan='3'>
							<?php
							$dataTerakhir = [0, 0, 0];
							$sql = "SELECT * FROM tabel_monitoring WHERE Date_Time='$waktuTerakhir' AND `ID_mesin`='$mesin' ";
							$result = $con->query($sql);
							if ($result->num_rows > 0) {
								$row = $result->fetch_assoc();
								$dataTerakhir = array($row['Current'], $row['Voltage'], $row['Power'], 2);
							}
							echo $waktuTerakhir;
							// echo (strtotime($waktuTerakhir) * 1000)." ".floatval($row['Current']);
							?>
						</td>
						<td>Current</td>
						<td><?= $dataTerakhir[0] ?></td>
						<td>A</td>
					</tr>
					<td>Voltage</td>
					<td><?= $dataTerakhir[1] ?></td>
					<td>V</td>
					</tr>
					</tr>
					<td>Power</td>
					<td><?= $dataTerakhir[2] ?></td>
					<td>Watt</td>
					</tr>
				</table>
			</div <div style="float: right;">
			<table>
				<?php
				// $sql_mesin = mysqli_query($con, "SELECT * FROM tabel_monitoring WHERE `ID_mesin`='" . $mesin . "'") or die (mysqli_error($con));
				// $data = mysqli_fetch_array($sql_mesin);
				// $power = $data['Power'];

				$datamesinready = mysqli_query($con, "SELECT * FROM tabel_monitoring WHERE `ID_mesin`='" . $mesin . "' AND Power>='" . $treshold['th_mesin_ready'] . "' and Power<='" . $treshold['th_spindel_on'] . "'") or die(mysqli_error($con));
				$jmlmesinready = mysqli_num_rows($datamesinready);

				$dataspindelon = mysqli_query($con, "SELECT * FROM tabel_monitoring WHERE `ID_mesin`='" . $mesin . "' AND Power>='" . $treshold['th_spindel_on'] . "' and Power<='" . $treshold['th_cutting'] . "'") or die(mysqli_error($con));
				$jmlspindelon = mysqli_num_rows($dataspindelon);

				$datacutting = mysqli_query($con, "SELECT * FROM tabel_monitoring WHERE `ID_mesin`='" . $mesin . "' AND Power>='" . $treshold['th_cutting'] . "'") or die(mysqli_error($con));
				$jmlcutting = mysqli_num_rows($datacutting);
				?>
				</tr>
				<td>Total Working Hour</td>
				<td><?= round((($jmlspindelon + $jmlcutting) * 5 / 3600), 3) ?></td>
				<td>Hour</td>
				</tr>
				<td>Spindel On</td>
				<td><?= round(($jmlspindelon * 5 / 3600), 3) ?></td>
				<td>Hour</td>
				</tr>
				<td>Cutting Process</td>
				<td><?= round(($jmlcutting * 5 / 3600), 3) ?></td>
				<td>Hour</td>
				</tr>
				<td>Machine Ready</td>
				<td><?= round(($jmlmesinready * 5 / 3600), 3) ?></td>
				<td>Hour</td>
			</table>

		</div>
		<?php //echo $json_data;
		?>
	</div>
</div>


<script src="../assets/highcharts/highcharts.js"></script>
<script src="../assets/highcharts/series-label.js"></script>
<script src="../assets/highcharts/exporting.js"></script>
<script src="../assets/highcharts/export-data.js"></script>
<script src="../assets/highcharts/accessibility.js"></script>

<script type="text/javascript">
	Highcharts.chart('data_monitoring', {
		chart: {
			type: 'spline',
			scrollablePlotArea: {
				minWidth: 600,
				// scrollPositionX: 1
			},
			renderTo: 'container',
			// zoomType: 'xy',
			// alignTicks: false		

		},
		title: {
			text: 'Machine Power Consumption Monitoring Pada Tanggal ',
			align: 'center'
		},
		subtitle: {
			text: 'Politeknik Manufaktur Bandung',
			align: 'center'
		},
		xAxis: {
			type: 'datetime',
			labels: {
				rotation: 0
			},
		},
		yAxis: [{
			title: {
				text: 'Power (W)',
				format: '{value}W',
			},
			plotBands: [{ // Mesin Ready
				from: <?= $treshold['th_mesin_ready'] ?>,
				to: <?= $treshold['th_spindel_on'] ?>,
				color: 'rgb(124, 252, 22)',
				label: {
					text: 'Mesin Ready',
					style: {
						color: '#606060'
					}
				}
			}, { // Spindel ON
				from: <?= $treshold['th_spindel_on'] ?>,
				to: <?= $treshold['th_cutting'] ?>,
				color: 'rgb(255, 255, 0)',
				label: {
					text: 'Spindel ON',
					style: {
						color: '#606060'
					}
				}
			}, { // Cutting
				from: <?= $treshold['th_cutting'] ?>,
				to: 10000000,
				color: 'rgb(250, 99, 71)',
				label: {
					text: 'Cutting',
					style: {
						color: '#606060'
					}
				}
			}]
		}],
		tooltip: {
			valueSuffix: '{value} W'
		},
		plotOptions: {
			spline: {
				lineWidth: 2,
				states: {
					hover: {
						lineWidth: 3
					}
				},
				marker: {
					enabled: false
				},

			}
		},
		series: <?= $json_data ?>,


		navigation: {
			menuItemStyle: {
				fontSize: '10px'
			}
		}
	});
</script>

<?php include_once('../footer.php'); ?>