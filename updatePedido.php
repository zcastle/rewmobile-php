<?php
require_once 'bootstrap.php';

$result = array();
if ($_POST) {
	try {
		$data = json_decode($_POST["data"]);
		$result['success'] = true;

	    $atencion=Atenciones::first($data->id);
	    $atencion->cantidad = $data->cant;
	    $atencion->producto = $data->prod;
	    $atencion->fl_mensaje = $data->msg;
	    $atencion->save();

	    $result['data'] = $data;

    } catch (ActiveRecordException $e) {
        $result['success']=false;
        $result['message']='Ha ocurrido algun error';
    }

    echo json_encode($result);

} else {
	$result['success']=false;
	$result['message']='Ha ocurrido algun error POST';
	echo json_encode($result);
}
		
?>