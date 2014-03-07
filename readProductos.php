<?php
	require_once 'bootstrap.php';
	$data['data'] = array();
	$condicion = array('conditions' => array('fl_eliminado=?','N'));
	foreach (Producto::all($condicion) as $obj) {
		//echo utf8_encode($obj->no_producto);
		array_push($data['data'], array(
			'id' => $obj->id,
			'co_producto' => $obj->co_producto,
			'no_producto' => utf8_encode($obj->no_producto),
			'precio0' => $obj->precio0,
			'nu_orden' => $obj->nu_orden,
			'co_destino' => $obj->co_destino,
			'co_categoria' => $obj->co_categoria
		));
	}

	echo json_encode($data);
?>