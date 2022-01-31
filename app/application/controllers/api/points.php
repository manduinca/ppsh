<?php
require APPPATH.'/libraries/REST_Controller.php';

class Points extends REST_Controller {
	
	protected $_coordenadas;
	protected $_poligonos;
	
	public function location_get()
	{
		$lat = $this->input->get('lat', TRUE);
		$long = $this->input->get('long', TRUE);
		$this->load->model('location_model');
		$result = $this->location_model->find_two($lat, $long);
		$this->response(array('status' => 'success', 'data' => $result->id, 'total' => count($result)), 200);
	}
	
	public function serie_one_get()
	{
		$location = $this->input->get('location', TRUE);
		$periodo = $this->input->get('p', TRUE);
		$periodo = $periodo + 0;
		$result = $this->_probabilidades($location, $periodo);
      /*  $resul_final = array();
        foreach($result as $res) {
            $result_final[] = array('x' => log10($res['x']), 'y' => log10($res['y']));
        }*/
		$this->response(array('status' => 'success', 'data' => $result, 'total' => count($result)), 200);
	}
	
	public function serie_two_get()
	{
		$location = $this->input->get('location', TRUE);
		$tr = $this->input->get('tr', TRUE);
		//$tr = $tr + 0;
		$result = array();
		$peligro = $this->_peligro($location, $tr);
		foreach ($peligro as $x => $y) {
			$result[] = array('x' => $x, 'y' => $y);
		}
		$this->response(array('status' => 'success', 'data' => $result, 'total' => count($result)), 200);
	}
	
	public function serie_three_get()
	{
		$location = $this->input->get('location', TRUE);
		$type = $this->input->get('type', TRUE);
		$ground = $this->input->get('ground', TRUE);
		$result_data = array();
		$result = array();
		if ($type == 'e30_2003') {
			$result_data = $this->_e30_2003($location, $ground);
		} else if ($type == 'e30_2015') {
			$result_data = $this->_e30_2015($location, $ground);
		} else if ($type == 'e30_2015_esp') {
			$result_data = $this->_e30_2015_esp($location, $ground);
		} else if ($type == 'ibc') {
			$result_data = $this->_ibc($location, $ground);
        } else if ($type == 'asce') {
            $result_data = $this->_ibc($location, $ground);
		}
		foreach ($result_data as $x => $y) {
			$result[] = array('x' => $x, 'y' => $y);
			//$result[floatval($k)] = $v;
		}
		$this->response(array('status' => 'success', 'data' => $result, 'total' => count($result)), 200);
	}
	
	private function _isInsidePoligon($lat, $lon, $k)
	{
		$nvert = count($this->_poligonos[$k]);
		$testx = $lon;
		$testy = $lat;
		for ($t = 0; $t < $nvert; $t++) {
			$verty[] = $this->_coordenadas[$this->_poligonos[$k][$t] - 1][0];
			$vertx[] = $this->_coordenadas[$this->_poligonos[$k][$t] - 1][1];
		}
		$i = $j = $c = 0;
		for($i = 0, $j = $nvert - 1; $i < $nvert; $j = $i++) {
			if( (($verty[$i] > $testy) != ($verty[$j] > $testy)) &&
				($testx < ($vertx[$j] - $vertx[$i]) * ($testy - $verty[$i]) / ($verty[$j] - $verty[$i]) + $vertx[$i]) ){
				$c = !$c;
			}
		}
		return $c;
	}
	
	private function _getPoligono($lat, $lon)
	{
		for ($i = 0; $i < count($this->_poligonos); $i++) {
			$x = $this->_isInsidePoligon($lat, $lon, $i);
			if($x) return $i;
		}
		return -1;
	}
	
	private function _probabilidades($location, $periodo)
	{
		$this->load->model('polygon_model');
		$this->load->model('point_polygon_model');
		$this->load->model('location_model');
		$this->load->model('w_one_model');
		$this->load->model('zer0_model');
		$this->load->model('zer1_model');
		$this->load->model('zer2_model');
		$this->load->model('zer3_model');
		$this->load->model('zer4_model');
		$this->load->model('zer5_model');
		$this->load->model('zer6_model');
		$this->load->model('zer7_model');
		
		$location_data = $this->location_model->find($location);
		$lat = $location_data->latitude;
		$long = $location_data->longitude;
		
		$coordenadas = $this->point_polygon_model->getAll(array('type' => 1));
		$this->_coordenadas = array();
		foreach ($coordenadas as $c) {
			$this->_coordenadas[] = array($c->latitude, $c->longitude);
		}
		$poligonos = $this->polygon_model->getAll(array('type' => 1));
		$this->_poligonos = array();
		foreach ($poligonos as $p) {
			$this->_poligonos[] = explode("|", $p->points);
		}
		$polygon = $this->_getPoligono($lat, $long);
		if ($polygon == -1) {
			$this->response(array('status' => 'error', 'message' => 'polygon not found'), 200);
		}
		$ponderaciones_data = $this->w_one_model->getAll();
		$ponderaciones = array();
		foreach ($ponderaciones_data as $pd) {
			$ponderaciones[] = array($pd->Y_y, $pd->Y_z, $pd->Y_mc, $pd->Y_ab, $pd->Y_bc);
		}

		$coordenadas = $this->point_polygon_model->getAll(array('type' => 4));
		$this->_coordenadas = array();
		foreach ($coordenadas as $c) {
			$this->_coordenadas[] = array($c->latitude, $c->longitude);
		}
		$poligonos = $this->polygon_model->getAll(array('type' => 4));
		$this->_poligonos = array();
		foreach ($poligonos as $p) {
			$this->_poligonos[] = explode("|", $p->points);
		}
		$polygon2 = $this->_getPoligono($lat, $long);
		if ($polygon2 == -1) {
			$this->response(array('status' => 'error', 'message' => 'polygon not found'), 200);
		}

		switch($polygon2) {
			case 7: $zer_data = $this->zer7_model->getAll(array('id' => $location, 'Periodo' => $periodo)); break;
			case 6: $zer_data = $this->zer6_model->getAll(array('id' => $location, 'Periodo' => $periodo)); break;
			case 5: $zer_data = $this->zer5_model->getAll(array('id' => $location, 'Periodo' => $periodo)); break;
			case 4: $zer_data = $this->zer4_model->getAll(array('id' => $location, 'Periodo' => $periodo)); break;
			case 3: $zer_data = $this->zer3_model->getAll(array('id' => $location, 'Periodo' => $periodo)); break;
			case 2: $zer_data = $this->zer2_model->getAll(array('id' => $location, 'Periodo' => $periodo)); break;
			case 1: $zer_data = $this->zer1_model->getAll(array('id' => $location, 'Periodo' => $periodo)); break;
			case 0: $zer_data = $this->zer0_model->getAll(array('id' => $location, 'Periodo' => $periodo)); break;
		}

		$result = array();
		$X = array();
		$Y_y = array();
		$Y_z = array();
		$Y_mc = array();
		$Y_ab = array();
		$Y_bc = array();
		
		foreach ($zer_data as $zd) {
			$X[] = $zd->X;
			$Y_y[] = $zd->Y_y;
			$Y_z[] = $zd->Y_z;
			$Y_mc[] = $zd->Y_mc;
			$Y_ab[] = $zd->Y_ab;
			$Y_bc[] = $zd->Y_bc;
		}
		
		for($i = 0; $i < 20; $i++) {
			$sum = $ponderaciones[$polygon][0] * $Y_y[$i] + $ponderaciones[$polygon][1] * $Y_z[$i] + $ponderaciones[$polygon][2] * $Y_mc[$i] + $ponderaciones[$polygon][3] * $Y_ab[$i] + $ponderaciones[$polygon][4] * $Y_bc[$i];
			$sum = number_format($sum, 8, '.', '');
			$result[] = array('x' => $X[$i] / 981, 'y' => $sum);
		}
		return $result;
	}
	
	private function _interpolar($peligro, $acel)
	{
        for($i = 0; $i < count($peligro); $i++) {
            $x = $peligro[$i]['x'];
            $y = $peligro[$i]['y'];
			if ($i > 1) {
				if ($y < $acel && $acel < $_y) {
					$m = log($_y / $y) / log($_x / $x);
					$k = $_y / pow($_x, $m);
					$prob = exp(log($acel / $k) / $m);
					return $prob;
				}
			}
			$_x = $x;
			$_y = $y;
		}
		return 0;
	}
	
	private function _peligro($location, $tr)
	{
		$periodo = array(0.0, 0.05, 0.075); 
		for ($i = 0.1; $i < 1.0; $i += 0.05) {
			$periodo[] = $i;
		}
		for ($i = 1.0; $i < 3.1; $i += 0.1) {
			$periodo[] = $i;
		}
		for ($i = 0; $i < count($periodo); $i++) {
			$prob = $this->_probabilidades($location, $periodo[$i]);
			$peligro[(string) $periodo[$i]] = $this->_interpolar($prob, 1/$tr);
		}
		return $peligro;
	}
	
	private function _e30_2003($location, $tipo_suelo)
	{
		$this->load->model('polygon_model');
		$this->load->model('point_polygon_model');
		$this->load->model('location_model');
		
		$location_data = $this->location_model->find($location);
		$lat = $location_data->latitude;
		$long = $location_data->longitude;
		
		$coordenadas = $this->point_polygon_model->getAll(array('type' => 3));
		$this->_coordenadas = array();
		foreach ($coordenadas as $c) {
			$this->_coordenadas[] = array($c->latitude, $c->longitude);
		}
		$poligonos = $this->polygon_model->getAll(array('type' => 3));
		$this->_poligonos = array();
		foreach ($poligonos as $p) {
			$this->_poligonos[] = explode("|", $p->points);
		}
		$polygon = $this->_getPoligono($lat, $long);
		if ($polygon == -1) {
			$this->response(array('status' => 'error', 'message' => 'polygon not found'), 200);
		}
		
		$periodo = array(0.0, 0.05, 0.075); 
		for ($i = 0.1; $i < 1.0; $i += 0.05) {
			$periodo[] = $i;
		}
		for ($i = 1.0; $i < 3.1; $i += 0.1) {
			$periodo[] = $i;
		}
		$Z_2003 = array(0.15, 0.3, 0.4);
		$Z_S_2003 = array(1, 1.2, 1.4);
		$Tp_2003 = array(0.4, 0.6, 0.9);
		
		switch($polygon) {
			case 0: $zona = 0; break;
			case 1: $zona = 0; break;
			case 2: $zona = 1; break;
			case 3: $zona = 2; break;
		}
		$S = $Z_S_2003[$tipo_suelo];
        $g = 1; $R = 1; $U = 1;
		foreach($periodo as $T) {
			if(2.5 * $Tp_2003[$tipo_suelo] > $T * 2.5) $C = 2.5;
			else $C = 2.5 * $Tp_2003[$tipo_suelo] / $T;
			$espectro_e30_2003[(string)$T] = $Z_2003[$zona] * $S * $C * $U * $g / $R;
		}
		return $espectro_e30_2003;
	}
	
	private function _e30_2015($location, $tipo_suelo)
	{
		$this->load->model('polygon_model');
		$this->load->model('point_polygon_model');
		$this->load->model('location_model');
		
		$location_data = $this->location_model->find($location);
		$lat = $location_data->latitude;
		$long = $location_data->longitude;
		
		$coordenadas = $this->point_polygon_model->getAll(array('type' => 2));
		$this->_coordenadas = array();
		foreach ($coordenadas as $c) {
			$this->_coordenadas[] = array($c->latitude, $c->longitude);
		}
		$poligonos = $this->polygon_model->getAll(array('type' => 2));
		$this->_poligonos = array();
		foreach ($poligonos as $p) {
			$this->_poligonos[] = explode("|", $p->points);
		}
		$polygon = $this->_getPoligono($lat, $long);
		if ($polygon == -1) {
			$this->response(array('status' => 'error', 'message' => 'polygon not found'), 200);
		}
		
		$periodo = array(0.0, 0.05, 0.075); 
		for ($i = 0.1; $i < 1.0; $i += 0.05) {
			$periodo[] = $i;
		}
		for ($i = 1.0; $i < 3.1; $i += 0.1) {
			$periodo[] = $i;
		}
		$Z = array(0.1, 0.25, 0.35, 0.45);
		$Z_S = array(
			array(0.8, 1, 1.6, 2), 
			array(0.8, 1, 1.2, 1.4), 
			array(0.8, 1, 1.15, 1.2), 
			array(0.8, 1, 1.05, 1.1)
		);
		$Tp = array(0.3, 0.4, 0.6, 1);
		$Tl = array(3, 2.5, 2, 1.6);
		switch($polygon) {
			case 0: $zona = 0; break;
			case 1: $zona = 0; break;
			case 2: $zona = 1; break;
			case 3: $zona = 2; break;
			case 4: $zona = 3; break;
		}
		$S = $Z_S[$zona][$tipo_suelo];
        $g = 1; $R = 1; $U = 1;
		foreach($periodo as $T) {
			if($T <= $Tp[$tipo_suelo]) $C = 2.5;
			if($T > $Tp[$tipo_suelo] && $T < $Tl[$tipo_suelo]) $C = 2.5 * $Tp[$tipo_suelo] / $T;
			if($T >= $Tl[$tipo_suelo]) $C = 2.5 * $Tp[$tipo_suelo] * $Tl[$tipo_suelo] / ($T * $T);
			$espectro_e30_2015[(string) $T] = $Z[$zona] * $S * $C * $U * $g / $R;
		}
		return $espectro_e30_2015;
	}

	private function _e30_2015_esp($location, $tipo_suelo)
	{
		$this->load->model('polygon_model');
		$this->load->model('point_polygon_model');
		$this->load->model('location_model');
		
		$location_data = $this->location_model->find($location);
		$lat = $location_data->latitude;
		$long = $location_data->longitude;
		
		$coordenadas = $this->point_polygon_model->getAll(array('type' => 2));
		$this->_coordenadas = array();
		foreach ($coordenadas as $c) {
			$this->_coordenadas[] = array($c->latitude, $c->longitude);
		}
		$poligonos = $this->polygon_model->getAll(array('type' => 2));
		$this->_poligonos = array();
		foreach ($poligonos as $p) {
			$this->_poligonos[] = explode("|", $p->points);
		}
		$polygon = $this->_getPoligono($lat, $long);
		if ($polygon == -1) {
			$this->response(array('status' => 'error', 'message' => 'polygon not found'), 200);
		}
		
		$periodo = array(0.0, 0.05, 0.075); 
		for ($i = 0.1; $i < 1.0; $i += 0.05) {
			$periodo[] = $i;
		}
		for ($i = 1.0; $i < 3.1; $i += 0.1) {
			$periodo[] = $i;
		}
		//$Z = array(0.1, 0.25, 0.35, 0.45);
		$Z_S = array(
			array(0.8, 1, 1.6, 2), 
			array(0.8, 1, 1.2, 1.4), 
			array(0.8, 1, 1.15, 1.2), 
			array(0.8, 1, 1.05, 1.1)
		);
		$Tp = array(0.3, 0.4, 0.6, 1);
		$Tl = array(3, 2.5, 2, 1.6);
		switch($polygon) {
			case 0: $zona = 0; break;
			case 1: $zona = 0; break;
			case 2: $zona = 1; break;
			case 3: $zona = 2; break;
			case 4: $zona = 3; break;
		}

		$prob = $this->_probabilidades($location, 0.0);
		$PGA = $this->_interpolar($prob, 1.0 / 475.0);
        if($PGA < 0.08) $PGA = 0.08;

		$S = $Z_S[$zona][$tipo_suelo];
        $g = 1; $R = 1; $U = 1;
		foreach($periodo as $T) {
			if($T <= $Tp[$tipo_suelo]) $C = 2.5;
			if($T > $Tp[$tipo_suelo] && $T < $Tl[$tipo_suelo]) $C = 2.5 * $Tp[$tipo_suelo] / $T;
			if($T >= $Tl[$tipo_suelo]) $C = 2.5 * $Tp[$tipo_suelo] * $Tl[$tipo_suelo] / ($T * $T);
			$espectro_e30_2015_esp[(string) $T] = $PGA * $S * $C * $U * $g / $R;
		}
		return $espectro_e30_2015_esp;
	}
	
	private function _fv($Sl, $tp)
	{
		$F = array(
			array(0.8, 0.8, 0.8, 0.8, 0.8), 
			array(1.0, 1.0, 1.0, 1.0, 1.0), 
			array(1.7, 1.6, 1.5, 1.4, 1.3), 
			array(2.4, 2.0, 1.8, 1.6, 1.5), 
			array(3.5, 3.2, 2.8, 2.4, 2.4)
		);
		if($Sl <= 0.1) return $F[$tp][0];
		if($Sl <= 0.2) return ($F[$tp][0] - $F[$tp][1]) / 0.1 * (0.2 - $Sl) + $F[$tp][1];
		if($Sl <= 0.3) return ($F[$tp][1] - $F[$tp][2]) / 0.1 * (0.3 - $Sl) + $F[$tp][2];
		if($Sl <= 0.4) return ($F[$tp][2] - $F[$tp][3]) / 0.1 * (0.4 - $Sl) + $F[$tp][3];
		if($Sl <= 0.5) return ($F[$tp][3] - $F[$tp][4]) / 0.1 * (0.5 - $Sl) + $F[$tp][4];
		return $F[$tp][4];
	}
	
	private function _fa($Ss, $tp)
	{
		$F = array(
			array(0.8, 0.8, 0.8, 0.8, 0.8), 
			array(1.0, 1.0, 1.0, 1.0, 1.0), 
			array(1.2, 1.2, 1.1, 1.0, 1.0), 
			array(1.6, 1.4, 1.2, 1.1, 1.0), 
			array(2.5, 1.7, 1.2, 0.9, 0.9)
		);
		if($Ss <= 0.25) return $F[$tp][0];
		if($Ss <= 0.50) return ($F[$tp][0] - $F[$tp][1]) / 0.25 * (0.50 - $Ss) + $F[$tp][1];
		if($Ss <= 0.75) return ($F[$tp][1] - $F[$tp][2]) / 0.25 * (0.75 - $Ss) + $F[$tp][2];
		if($Ss <= 1.00) return ($F[$tp][2] - $F[$tp][3]) / 0.25 * (1.00 - $Ss) + $F[$tp][3];
		if($Ss <= 1.25) return ($F[$tp][3] - $F[$tp][4]) / 0.25 * (1.25 - $Ss) + $F[$tp][4];
		return $F[$tp][4];
	}
	
	private function _ibc($location, $tipo_suelo)
	{
		$prob = $this->_probabilidades($location, 0.2);
		$PGA1 = $this->_interpolar($prob, 1.0 / 2500.0);
		//if($PGA < 0.08) $PGA = 0.08;
		
		$prob2 = $this->_probabilidades($location, 1.0);
		$PGA2 = $this->_interpolar($prob2, 1.0 / 2500.0);
		//if($PGA < 0.08) $PGA = 0.08;
		
		$Ss = $PGA1; $Sl = $PGA2;
		$Fv = $this->_fv($Sl, $tipo_suelo);
		$Fa = $this->_fa($Ss, $tipo_suelo);
		$Sml = $Fv * $Sl; $Sms = $Fa * $Ss;
		$Sdl = 2.0 / 3.0 * $Sml; $Sds = 2.0 / 3.0 * $Sms;
		$T0 = $Sdl / $Sds * 0.2; $Ts = $Sdl / $Sds;
		for($T = 0.0; $T < 3.01; $T += 0.01) {
			if($T < $T0) $espectro_ibc[(string) $T] = $Sds * (0.4 + 0.6 * $T / $T0);
			else
				if($T >= $Ts) $espectro_ibc[(string) $T] = $Sdl / $T;
				else $espectro_ibc[(string) $T] = $Sds;
		}
		return $espectro_ibc;
    }
}
