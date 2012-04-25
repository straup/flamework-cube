<?php

	loadlib("http");

	########################################################################

	function cube_evaluator_events($params){
		return _cube_evaluator_get('event', $params)
	}

	########################################################################

	function cube_evaluator_metrics($params){
		return _cube_evaluator_get('metric', $params)
	}

	########################################################################

	function cube_evaluator_types(){
		return _cube_evaluator_get('types')
	}

	########################################################################

	function _cube_evaluator_get($what, $params=array()){

		$address = implode(":", array(
			$GLOBALS['cfg']['cube_evaluator_host'],
			$GLOBALS['cfg']['cube_evaluator_port']
		));

		$url = "http://{$address}/1.0/{$what}";

		if (count($params)){
			$url .= "?" . http_build_query($params);
		}

		$rsp = http_get($url);

		if (! $rsp['ok']){
			return $data;
		}

		$data = json_decode($rsp['body'], 'as hash');

		if (! $data){
			return not_okay("failed to parse response");
		}

		return okay(array(
			'data' => $data
		));

	}

	########################################################################
?>
