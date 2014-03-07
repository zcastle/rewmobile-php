<?php
	require_once 'bootstrap.php';
	$data['data'] = array();
	$condicion = array('conditions' => array('fl_eliminado=?','N'));
	foreach (Usuario::all($condicion) as $obj) {
		array_push($data['data'], array(
			'id' => $obj->id,
			'usuario' => $obj->co_usuario,
			'clave' => $obj->pw_usuario,
			'rol_id' => $obj->id_rol,
			'rol_name' => Rol::find($obj->id_rol)->no_rol
		));
	}
	echo json_encode($data);
?>