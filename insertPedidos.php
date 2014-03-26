<?php
require_once 'bootstrap.php';
//date_default_timezone_set('America/Lima');
$result = array();
if ($_POST["data"]) {
    try {
        $data = json_decode($_POST["data"]);
        $result['success'] = true;

        $tot=$data->precio*$data->cant;
        //$prod=Producto::find($data->idprod)->no_producto;

        $curdate = date('Y-m-d');
        $curtime = date('H:i:s');

        $attributes = array(
            'nroatencion'=>$data->mesa,
            'usuario'=>$data->cajeroid,
            'mozo'=>$data->mozoid,
            'idproducto'=>$data->idprod,
            'producto'=>$data->producto,
            'cantidad'=>$data->cant,
            'precio'=>$data->precio,
            'fecha'=>$curdate,
            'hora'=>$curtime,
            'pax'=>$data->pax,
            'total'=>$tot,
            'pc'=>$data->pc,
            'co_destino'=>$data->co_destino,
            'stado'=> 0
        );

        $condicion=array('conditions' => array('nroatencion=? AND idproducto=? AND producto=?', $data->mesa, $data->idprod, $data->producto));
        $atencion=Atenciones::first($condicion);
        if($atencion){
            if($atencion->fl_envio=='N'){
                $cant=$atencion->cantidad+1;
                $total=$atencion->precio*$cant;
                $atencion->update_attributes(array('cantidad'=>$cant, 'total'=>$total));
                $result['message']='Producto no enviado, se actualiza la cantidad';
                $result['id']=0;
            } else {
                $r=Atenciones::create($attributes);
                $result['message']='Producto enviado, se ingresa nuevo registro';
                $result['id']=$r->idatencion;
            }
        } else {
            $ca=CabeceraAtencion::first(array('conditions' => array('n_ate', $data->nmesa)));
            $ca->update_attributes(array('fl_sta'=>1));
            $r=Atenciones::create($attributes);
            $result['message']='Nuevo registro';
            $result['id']=$r->idatencion;
        }
    } catch (ActiveRecordException $e) {
        $result['success']=false;
        $result['message']='Ha ocurrido algun error';
        $result['id']=0;
    }
    print_r(json_encode($result));
} else {
    $result['success']=false;
    $result['message']='Ha ocurrido algun error :P';
    $result['id']=0;
    print_r(json_encode($result));
}
?>