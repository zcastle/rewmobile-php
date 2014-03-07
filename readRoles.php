<?php
	require_once 'bootstrap.php';
	$data['data'] = array();
	foreach (Rol::all() as $obj) {
		array_push($data['data'], array(
			'id' => $obj->id,
			'nombre' => $obj->no_rol
		));
	}
	echo json_encode($data);
?>