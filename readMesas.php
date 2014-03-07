<?php
 	require_once 'lib/dbapdo.class.php';
	$conn = new dbapdo();
	$query = "select m.n_ate, IF(n.fl_sta is null, 0, 1) As fl_sta from m_cbzaten AS m LEFT JOIN 
             (select nroatencion as n_ate,'1' as fl_sta from m_atenciones WHERE nroatencion is not null group by nroatencion order by n_ate asc)
             AS n ON m.n_ate=n.n_ate order by n_ate asc";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_CLASS);
    echo json_encode(
            array(
                "data" => $result
    ));
?>