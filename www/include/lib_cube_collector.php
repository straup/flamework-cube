<?php

	loadlib("udp");

	########################################################################

	function cube_collector_record($event=array()){

		# dunno about this... (20120424/straup)

		if (! isset($event['type'])){
			return $event['type'] = 'ping';
		}

		if (! isset($event['time'])){
			$event['time'] = gmdate("c", time());
		}

		$address = implode(":", array(
			$GLOBALS['cfg']['cube_collector_host'],
			$GLOBALS['cfg']['cube_collector_port']
		));

		$msg = json_encode($event);
		return udp_send($address, $msg);
	}

	########################################################################

?>
