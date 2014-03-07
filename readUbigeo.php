<?php
	require_once 'bootstrap.php';

	$out = isset($_GET['out']) ? $_GET['out'] : null; //DE-PR-DI
	$de = isset($_GET['de']) ? $_GET['de'] : null;
	$pr = isset($_GET['pr']) ? $_GET['pr'] : null;
	$di = isset($_GET['di']) ? $_GET['di'] : null;


	$data['data'] = array();

	$c = array();
	switch (strtoupper($out)) {
		case 'DE':
			$c = array('conditions' => array('co_provincia=? AND co_distrito=?', '00', '00'));
			break;
		case 'PR':
			$c = array('conditions' => array('co_departamento=? AND co_distrito=? AND co_provincia<>?', $de, '00', '00'));
			break;
		case 'DI':
			$c = array('conditions' => array('co_departamento=? AND co_provincia=? AND co_distrito<>?', $de, $pr, '00'));
			break;
		default:
			$c = array('conditions' => array('co_provincia=? AND co_distrito=?', '00', '00'));
			break;
	}

	foreach (Ubigeo::all($c) as $obj) {
		array_push($data['data'], $obj->attributes());
	}
	
	echo json_encode($data);
?>