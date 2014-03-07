<?php
require_once 'lib/dbapdo.class.php';
    $conn = new dbapdo();
    $query = "select co_categoria,no_categoria,nu_orden from m_categorias where fl_eliminado<>'S' order by no_categoria";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    //$result = $stmt->fetchAll();
    $result = $stmt->fetchAll(PDO::FETCH_CLASS);
    echo json_encode(
            array(
                "data" => $result
    ));
?>