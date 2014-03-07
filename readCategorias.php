<?php
	require_once 'bootstrap.php';
	$data['data'] = array();
	$condicion = array('conditions' => array('fl_eliminado=?','N'));
	foreach (Categoria::all($condicion) as $obj) {
		array_push($data['data'], array(
			'id' => $obj->id,
			'co_categoria' => $obj->co_categoria,
			'no_categoria' => $obj->no_categoria
		));
	}
	echo json_encode($data);
?>