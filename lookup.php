<?php

header("Content-type: text/javascript");
	/*
		you should server side cache this response, especially if your site is active
	*/
	$data = isset($_GET['data'])?$_GET['data']:'';
	if (!empty($data)) {
		$data = explode("|", $data);
		$responses = array();
		if (!empty($data)) {
			foreach ($data as $key) {
				list($instance,$currency,$address) = explode('_',$key);
				switch ($currency) {
					case 'bitcoin':
						$response = get_bitcoin($address);
						break;
					case 'litecoin':
						$response = get_litecoin($address);
						break;
					case 'dash':
						$response = get_dash($address);
						break;
					case 'dogecoin':
						$response = dogecoin($address);
						break;
				}
				$responses[$instance] = $response;
			}
		}
		echo 'var COINWIDGETCOM_DATA = '.json_encode($responses).';';
	}


	function get_bitcoin($address) {
		$return = array();
		// https://blockchain.info/api/blockchain_api
		$data = get_request('http://blockchain.info/address/'.$address.'?format=json&limit=0');
		// echo 'http://blockchain.info/address/'.$address.'?format=json&limit=0';

		if (!empty($data)) {
			$data = json_decode($data);
			$return += array(
				'count' => (int) $data->n_tx,
				'amount' => (float) $data->total_received/100000000
				// 'amount' => (float) $data->final_balance/100000000
			);
			return $return;
		}
	}
/*
	function get_litecoin($address) {
		$return = array();
		$data = get_request('http://explorer.litecoin.net/address/'.$address);
		if (!empty($data)
		  && strstr($data, 'Transactions in: ')
		  && strstr($data, 'Received: ')) {
		  	$return += array(
				'count' => (int) parse($data,'Transactions in: ','<br />'),
				'amount' => (float) parse($data,'Received: ','<br />')
			);
		  	return $return;
		}
	}
*/

	function get_litecoin($address) {
		$return = array();
		// https://www.blockcypher.com/quickstart/
		$data = get_request('https://api.blockcypher.com/v1/ltc/main/addrs/'.$address);
		if (!empty($data) ){
			$data = json_decode($data);
		  	$return += array(
				'count' => (int) $data->n_tx,
				'amount' => (float) $data->final_balance
			);
		  	return $return;
		}
	}

	function get_dash($address) {
		$return = array();
		// https://chain.so/api#get-display-data-address
		$data = get_request('https://chain.so/api/v2/address/DASH/'.$address);
		if (!empty($data)) {
			$data = json_decode($data);
			$return += array(
				'count' => (int) $data->data->total_txs,
				'amount' => (float) $data->data->balance
			);
			return $return;
		}
	}

	function get_dogecoin($address) {
		$return = array();
		$data = get_request('http://dogechain.info/address/'.$address.);
		if (!empty($data)
		  && strstr($data, 'Transactions in: ')
		  && strstr($data, 'Received: ')) {
		  	$return += array(
				'count' => (int) parse($data,'Transactions in: ','<br />'),
				'amount' => (float) parse($data,'Received: ','<br />')
			);
		  	return $return;
		}
	}

	function get_request($url,$timeout=4) {
		if (function_exists('curl_version')) {
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($curl, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13');
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			$return = curl_exec($curl);
			curl_close($curl);
			return $return;
		} else {
			return @file_get_contents($url);
		}
	}

	function parse($string,$start,$stop) {
		if (!strstr($string, $start)) return;
		if (!strstr($string, $stop)) return;
		$string = substr($string, strpos($string,$start)+strlen($start));
		$string = substr($string, 0, strpos($string,$stop));
		return $string;
	}
