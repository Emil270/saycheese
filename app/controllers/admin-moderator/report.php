<?php 

	session_start();
	require '../../../app/include/generate_reports.php';
	require '../../../libs/tfpdf/tfpdf.php';

	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['report-type'])){
		$months = $_POST['months'];
		$months_count = count($months);
		$year = $_POST['year'];
		$report_type = $_POST['report-type'];
		$report = "";

		if($months_count == 0){
		}

		switch($report_type){
			case 'photographer_services': ReportPhotographerServices($months, $months_count, $year); break;
			case 'photoshop_services': ReportPhotoshopServices($months, $months_count, $year); break;
			case 'products': ReportProductsSale($months, $months_count, $year); break;
			case 'photostudios': ReportPhotostudios($months, $months_count, $year); break;
		}

	}

?>