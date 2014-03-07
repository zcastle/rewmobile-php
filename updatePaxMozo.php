<?php
require_once 'bootstrap.php';

$result = array();
if ($_POST) {
	try {
		$data = json_decode($_POST["data"]);
		$result['success'] = true;

	    $fields = array('pax' => $data->pax, 'mozo' => $data->mozo);
	    $condition = array('nroatencion' => $data->nroatencion);

	    Atenciones::table()->update($fields, $condition);

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