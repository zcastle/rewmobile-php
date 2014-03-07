<?php
	require_once 'bootstrap.php';

	$data['data'] = array();

	$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;

 	if($nombre) {

		$d = Equipos::first(array('conditions' => array('nombre=?', $nombre)));
		$centrocosto_id = $d->centrocosto_id;
		$d = $d->attributes();

		$cc = CentroCosto::first($centrocosto_id);
		$e = Empresa::first($cc->empresa_id);

		$d['cc_codigo'] = $cc->codigo;
		$d['cc_nombre'] = utf8_encode($cc->nombre);
		$d['cc_direccion'] = utf8_encode($cc->direccion);
		$d['cc_distrito'] = Ubigeo::first($cc->ubigeo_id)->no_ubigeo;
		$d['cc_empresa_id'] = $cc->empresa_id;

		$d['e_codigo'] = $e->co_empresa;
		$d['e_ruc'] = $e->nu_ruc;
		$d['e_razon'] = utf8_encode($e->no_razon_social);
		$d['e_nombre'] = utf8_encode($e->no_comercial);
		$d['e_direccion'] = utf8_encode($e->de_direccion);
		$d['e_distrito'] = utf8_encode($e->no_distrito);
		$d['e_igv'] = 18;

		array_push($data['data'], $d);


		echo json_encode($data);
	}
?>