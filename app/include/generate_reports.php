<?php 

	require 'querys.php';


	/*
	 Генерация отчёта "Количество оказанных услуг фотографами"
	*/

	function ReportPhotographerServices($months, $months_count, $year){
		$list = array();
		$row = 0;
		$total_price = 0;
		$days_count = 0;
		$month_name = "";
		$flag = true;
		$report_headline = "Количество оказанных услуг фотографами за ";
		$users = Select("user", ["role" => ["=", "Фотограф"]]);
		for($i = 0; $i < count($users); $i++){
			$specialist = Select("staff", ["id_user" => ["=", $users[$i]['id']]]);
			$list[$row]['specialist'] = $specialist[0]['surname'] . " " . $specialist[0]['name'];
			$list[$row]['count'] = 0;
			$list[$row]['price'] = 0;
			for ($j = 0; $j < $months_count; $j++) {
				switch($months[$j]){
					case '1': $days_count = 31; $month_name = "Январь"; break;
					case '2': $days_count = 28; $month_name = "Февраль"; break;
					case '3': $days_count = 31; $month_name = "Март"; break;
					case '4': $days_count = 30; $month_name = "Апрель"; break;
					case '5': $days_count = 31; $month_name = "Май"; break;
					case '6': $days_count = 30; $month_name = "Июнь"; break;
					case '7': $days_count = 31; $month_name = "Июль"; break;
					case '8': $days_count = 31; $month_name = "Август"; break;
					case '9': $days_count = 30; $month_name = "Сентябрь"; break;
					case '10': $days_count = 31; $$month_name = "Октябрь"; break;
					case '11': $days_count = 30; $month_name = "Ноябрь"; break;
					case '12': $days_count = 31; $month_name = "Декабрь"; break;
				}
				if($flag){
					if($months_count - $j == 1){
						$report_headline .= $month_name . " ";
					}
					else{
						$report_headline .= $month_name . ", ";
					}
				}
				for ($day = 1; $day <= $days_count; $day++) {
					$dateComplete = date("Y-m-d", mktime(0,0,0,$months[$j], $day, $year));
					$params = [
						"id_specialist" => ["=", $users[$i]['id']],
						"date_complete" => ["=", $dateComplete]
					];
					$result = Select("request_to_photographer", $params);
					$list[$row]['count'] += count($result);
					if(!empty($result)){
						for($l = 0; $l < count($result); $l++){
							$list[$row]['price'] += $result[$l]['price'];
							$total_price += $result[$l]['price'];
						}
					}
				}
			}
			$flag = false;
			$row++;
		}
		$report_headline .= $year . " года";
		ob_start();
		$pdf = new TFPDF('P', 'mm', 'A4');
		$pdf->SetTextColor(0, 0, 0);
		$pdf->AddPage();
		$pdf->AddFont('DejaVuSansBold','','DejaVuSans-Bold.ttf',true);
		$pdf->SetFont('DejaVuSansBold','',14);
		$pdf->Ln(5);
		$pdf->Write(7, $report_headline);
		$pdf->Ln(15);
		$pdf->SetFont('DejaVuSansBold','',10);
		$pdf->SetDrawColor(70, 70, 70);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->Cell(10, 8, " №", 1, 0, 'L');
		$pdf->Cell(105, 8, " Специалист", 1, 0, 'L');
		$pdf->Cell(30, 8, " Кол-во услуг", 1, 0, 'L');
		$pdf->Cell(40, 8, " Общая стоимость", 1, 0, 'L');
		$pdf->Ln(8);
		$pdf->AddFont('DejaVuSans','','DejaVuSans.ttf',true);
		$pdf->SetFont('DejaVuSans','',10);
		for($i = 0; $i < count($list); $i++){
			$pdf->Cell(10, 8, " " . $i+1, 1, 0, 'L');
			$pdf->Cell(105, 8, " " . $list[$i]['specialist'], 1, 0, 'L');
			$pdf->Cell(30, 8, " " . $list[$i]['count'], 1, 0, 'L');
			$pdf->Cell(40, 8, " " . $list[$i]['price'] . " ₽", 1, 0, 'L');
			$pdf->Ln(8);
		}
		$pdf->AddFont('DejaVuSansBold','','DejaVuSans-Bold.ttf',true);
		$pdf->SetFont('DejaVuSansBold','',10);
		$pdf->Cell(10, 8, "", 1, 0, 'L');
		$pdf->Cell(105, 8, "", 1, 0, 'L');
		$pdf->Cell(30, 8, " ИТОГО:", 1, 0, 'L');
		$pdf->Cell(40, 8, " " . $total_price . " ₽", 1, 0, 'L');
		$pdf->Output("report.pdf", "I");
		ob_end_flush();
	}

	/*
	 Генерация отчёта "Количество оказанных услуг специалистами по обработке фотографий"
	*/

	function ReportPhotoshopServices($months, $months_count, $year){
		$list = array();
		$row = 0;
		$total_price = 0;
		$days_count = 0;
		$month_name = "";
		$flag = true;
		$report_headline = "Количество оказанных услуг специалистами по обработке фотогрофий за ";
		$users = Select("user", ["role" => ["=", "Специалист по обработке фотографий"]]);
		for($i = 0; $i < count($users); $i++){
			$specialist = Select("staff", ["id_user" => ["=", $users[$i]['id']]]);
			$list[$row]['specialist'] = $specialist[0]['surname'] . " " . $specialist[0]['name'];
			$list[$row]['count'] = 0;
			$list[$row]['price'] = 0;
			for ($j = 0; $j < $months_count; $j++) {
				switch($months[$j]){
					case '1': $days_count = 31; $month_name = "Январь"; break;
					case '2': $days_count = 28; $month_name = "Февраль"; break;
					case '3': $days_count = 31; $month_name = "Март"; break;
					case '4': $days_count = 30; $month_name = "Апрель"; break;
					case '5': $days_count = 31; $month_name = "Май"; break;
					case '6': $days_count = 30; $month_name = "Июнь"; break;
					case '7': $days_count = 31; $month_name = "Июль"; break;
					case '8': $days_count = 31; $month_name = "Август"; break;
					case '9': $days_count = 30; $month_name = "Сентябрь"; break;
					case '10': $days_count = 31; $$month_name = "Октябрь"; break;
					case '11': $days_count = 30; $month_name = "Ноябрь"; break;
					case '12': $days_count = 31; $month_name = "Декабрь"; break;
				}
				if($flag){
					if($months_count - $j == 1){
						$report_headline .= $month_name . " ";
					}
					else{
						$report_headline .= $month_name . ", ";
					}
				}
				for ($day = 1; $day <= $days_count; $day++) {
					$dateComplete = date("Y-m-d", mktime(0,0,0,$months[$j], $day, $year));
					$params = [
						"id_specialist" => ["=", $users[$i]['id']],
						"date_complete" => ["=", $dateComplete]
					];
					$result = Select("request_to_photoshop", $params);
					$list[$row]['count'] += count($result);
					if(!empty($result)){
						for($l = 0; $l < count($result); $l++){
							$list[$row]['price'] += $result[$l]['price'];
							$total_price += $result[$l]['price'];
						}
					}
				}
			}
			$flag = false;
			$row++;
		}
		$report_headline .= $year . " года";
		ob_start();
		$pdf = new TFPDF('P', 'mm', 'A4');
		$pdf->SetTextColor(0, 0, 0);
		$pdf->AddPage();
		$pdf->AddFont('DejaVuSansBold','','DejaVuSans-Bold.ttf',true);
		$pdf->SetFont('DejaVuSansBold','',14);
		$pdf->Ln(5);
		$pdf->Write(7, $report_headline);
		$pdf->Ln(15);
		$pdf->SetFont('DejaVuSansBold','',10);
		$pdf->SetDrawColor(70, 70, 70);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->Cell(10, 8, " №", 1, 0, 'L');
		$pdf->Cell(105, 8, " Специалист", 1, 0, 'L');
		$pdf->Cell(30, 8, " Кол-во услуг", 1, 0, 'L');
		$pdf->Cell(40, 8, " Общая стоимость", 1, 0, 'L');
		$pdf->Ln(8);
		$pdf->AddFont('DejaVuSans','','DejaVuSans.ttf',true);
		$pdf->SetFont('DejaVuSans','',10);
		for($i = 0; $i < count($list); $i++){
			$pdf->Cell(10, 8, " " . $i+1, 1, 0, 'L');
			$pdf->Cell(105, 8, " " . $list[$i]['specialist'], 1, 0, 'L');
			$pdf->Cell(30, 8, " " . $list[$i]['count'], 1, 0, 'L');
			$pdf->Cell(40, 8, " " . $list[$i]['price'] . " ₽", 1, 0, 'L');
			$pdf->Ln(8);
		}
		$pdf->AddFont('DejaVuSansBold','','DejaVuSans-Bold.ttf',true);
		$pdf->SetFont('DejaVuSansBold','',10);
		$pdf->Cell(10, 8, "", 1, 0, 'L');
		$pdf->Cell(105, 8, "", 1, 0, 'L');
		$pdf->Cell(30, 8, " ИТОГО:", 1, 0, 'L');
		$pdf->Cell(40, 8, " " . $total_price . " ₽", 1, 0, 'L');
		$pdf->Output("report.pdf", "I");
		ob_end_flush();
	}

	/*
	 Генерация отчёта "Количество продаж каждого товара"
	*/

	function ReportProductsSale($months, $months_count, $year){
		$list = array();
		$row = 0;
		$total_price = 0;
		$days_count = 0;
		$month_name = "";
		$flag = true;
		$report_headline = "Количество продаж каждого товара за ";
		$products = Select("product");
		for($i = 0; $i < count($products); $i++){
			$list[$row]['name'] = $products[$i]['name'];
			$list[$row]['count'] = 0;
			$list[$row]['price'] = 0;
			for ($j = 0; $j < $months_count; $j++) {
				switch($months[$j]){
					case '1': $days_count = 31; $month_name = "Январь"; break;
					case '2': $days_count = 28; $month_name = "Февраль"; break;
					case '3': $days_count = 31; $month_name = "Март"; break;
					case '4': $days_count = 30; $month_name = "Апрель"; break;
					case '5': $days_count = 31; $month_name = "Май"; break;
					case '6': $days_count = 30; $month_name = "Июнь"; break;
					case '7': $days_count = 31; $month_name = "Июль"; break;
					case '8': $days_count = 31; $month_name = "Август"; break;
					case '9': $days_count = 30; $month_name = "Сентябрь"; break;
					case '10': $days_count = 31; $$month_name = "Октябрь"; break;
					case '11': $days_count = 30; $month_name = "Ноябрь"; break;
					case '12': $days_count = 31; $month_name = "Декабрь"; break;
				}
				if($flag){
					if($months_count - $j == 1){
						$report_headline .= $month_name . " ";
					}
					else{
						$report_headline .= $month_name . ", ";
					}
				}
				for ($day = 1; $day <= $days_count; $day++) {
					$dateSale = date("Y-m-d", mktime(0,0,0,$months[$j], $day, $year));
					$params = [
						"date" => ["=", $dateSale]
					];
					$orders = Select("orderr", $params);
					if(!empty($orders)){
						for($l = 0; $l < count($orders); $l++){
							$orders_product = Select("orders_product", ["id_order" => ["=", $orders[$l]['id']]]);
							for($k = 0; $k < count($orders_product); $k++){
								if($orders_product[$k]['id_product'] == $products[$i]['id']){
									$products_count = $orders_product[$k]['count'];
									$products_price = $products[$i]['price'];
									$list[$row]['count'] += $products_count;
									$list[$row]['price'] += $products_count * $products_price;
									$total_price += $products_count * $products_price;
								}
							}
						}
					}
				}
			}
			$flag = false;
			$row++;
		}
		$report_headline .= $year . " года";
		ob_start();
		$pdf = new TFPDF('P', 'mm', 'A4');
		$pdf->SetTextColor(0, 0, 0);
		$pdf->AddPage();
		$pdf->AddFont('DejaVuSansBold','','DejaVuSans-Bold.ttf',true);
		$pdf->SetFont('DejaVuSansBold','',14);
		$pdf->Ln(5);
		$pdf->Write(7, $report_headline);
		$pdf->Ln(15);
		$pdf->SetFont('DejaVuSansBold','',10);
		$pdf->SetDrawColor(70, 70, 70);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->Cell(10, 8, " №", 1, 0, 'L');
		$pdf->Cell(95, 8, " Наименование товара", 1, 0, 'L');
		$pdf->Cell(40, 8, " Кол-во продаж", 1, 0, 'L');
		$pdf->Cell(40, 8, " Общая стоимость", 1, 0, 'L');
		$pdf->Ln(8);
		$pdf->AddFont('DejaVuSans','','DejaVuSans.ttf',true);
		$pdf->SetFont('DejaVuSans','',10);
		for($i = 0; $i < count($list); $i++){
			$pdf->Cell(10, 8, " " . $i+1, 1, 0, 'L');
			$pdf->Cell(95, 8, " " . $list[$i]['name'], 1, 0, 'L');
			$pdf->Cell(40, 8, " " . $list[$i]['count'], 1, 0, 'L');
			$pdf->Cell(40, 8, " " . $list[$i]['price'] . " ₽", 1, 0, 'L');
			$pdf->Ln(8);
		}
		$pdf->AddFont('DejaVuSansBold','','DejaVuSans-Bold.ttf',true);
		$pdf->SetFont('DejaVuSansBold','',10);
		$pdf->Cell(10, 8, "", 1, 0, 'L');
		$pdf->Cell(95, 8, "", 1, 0, 'L');
		$pdf->Cell(40, 8, " ИТОГО:", 1, 0, 'L');
		$pdf->Cell(40, 8, " " . $total_price . " ₽", 1, 0, 'L');
		$pdf->Output("report.pdf", "I");
		ob_end_flush();
	}

	/*
	 Генерация отчёта "Количество брони каждой фотостудии"
	*/

	function ReportPhotostudios($months, $months_count, $year){
		$list = array();
		$row = 0;
		$total_price = 0;
		$days_count = 0;
		$month_name = "";
		$flag = true;
		$report_headline = "Количество брони каждой фотостудии за ";
		$photostudios = Select("photostudio");
		for($i = 0; $i < count($photostudios); $i++){
			$list[$row]['name'] = $photostudios[$i]['name'];
			$list[$row]['count'] = 0;
			$list[$row]['price'] = 0;
			for ($j = 0; $j < $months_count; $j++) {
				switch($months[$j]){
					case '1': $days_count = 31; $month_name = "Январь"; break;
					case '2': $days_count = 28; $month_name = "Февраль"; break;
					case '3': $days_count = 31; $month_name = "Март"; break;
					case '4': $days_count = 30; $month_name = "Апрель"; break;
					case '5': $days_count = 31; $month_name = "Май"; break;
					case '6': $days_count = 30; $month_name = "Июнь"; break;
					case '7': $days_count = 31; $month_name = "Июль"; break;
					case '8': $days_count = 31; $month_name = "Август"; break;
					case '9': $days_count = 30; $month_name = "Сентябрь"; break;
					case '10': $days_count = 31; $$month_name = "Октябрь"; break;
					case '11': $days_count = 30; $month_name = "Ноябрь"; break;
					case '12': $days_count = 31; $month_name = "Декабрь"; break;
				}
				if($flag){
					if($months_count - $j == 1){
						$report_headline .= $month_name . " ";
					}
					else{
						$report_headline .= $month_name . ", ";
					}
				}
				for ($day = 1; $day <= $days_count; $day++) {
					$dateBooking = date("Y-m-d", mktime(0,0,0,$months[$j], $day, $year));
					$params = [
						"id_photostudio" => ["=", $photostudios[$i]['id']],
						"date" => ["=", $dateBooking],
						"status" => ["=", "Завершена"]
					];
					$result = Select("booking", $params);
					$list[$row]['count'] += count($result);
					if(!empty($result)){
						for($l = 0; $l < count($result); $l++){
							$list[$row]['price'] += $result[$l]['price'];
							$total_price += $result[$l]['price'];
						}
					}
				}
			}
			$flag = false;
			$row++;
		}
		$report_headline .= $year . " года";
		ob_start();
		$pdf = new TFPDF('P', 'mm', 'A4');
		$pdf->SetTextColor(0, 0, 0);
		$pdf->AddPage();
		$pdf->AddFont('DejaVuSansBold','','DejaVuSans-Bold.ttf',true);
		$pdf->SetFont('DejaVuSansBold','',14);
		$pdf->Ln(5);
		$pdf->Write(7, $report_headline);
		$pdf->Ln(15);
		$pdf->SetFont('DejaVuSansBold','',10);
		$pdf->SetDrawColor(70, 70, 70);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->Cell(10, 8, " №", 1, 0, 'L');
		$pdf->Cell(95, 8, " Наименование фотостудии", 1, 0, 'L');
		$pdf->Cell(40, 8, " Кол-во брони", 1, 0, 'L');
		$pdf->Cell(40, 8, " Общая стоимость", 1, 0, 'L');
		$pdf->Ln(8);
		$pdf->AddFont('DejaVuSans','','DejaVuSans.ttf',true);
		$pdf->SetFont('DejaVuSans','',10);
		for($i = 0; $i < count($list); $i++){
			$pdf->Cell(10, 8, " " . $i+1, 1, 0, 'L');
			$pdf->Cell(95, 8, " " . $list[$i]['name'], 1, 0, 'L');
			$pdf->Cell(40, 8, " " . $list[$i]['count'], 1, 0, 'L');
			$pdf->Cell(40, 8, " " . $list[$i]['price'] . " ₽", 1, 0, 'L');
			$pdf->Ln(8);
		}
		$pdf->AddFont('DejaVuSansBold','','DejaVuSans-Bold.ttf',true);
		$pdf->SetFont('DejaVuSansBold','',10);
		$pdf->Cell(10, 8, "", 1, 0, 'L');
		$pdf->Cell(95, 8, "", 1, 0, 'L');
		$pdf->Cell(40, 8, " ИТОГО:", 1, 0, 'L');
		$pdf->Cell(40, 8, " " . $total_price . " ₽", 1, 0, 'L');
		$pdf->Output("report.pdf", "I");
		ob_end_flush();
	}

?>