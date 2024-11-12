<?php 
$con = mysqli_connect("localhost", "root", "", "informacoes");

if(isset($_GET["id"])):
    $id = intval($_GET["id"]);
    $selectAllQuery = "SELECT * FROM clientes WHERE id=$id";
    $result = mysqli_query($con, $selectAllQuery);

    foreach($result as $item):
        echo json_encode($item);
    endforeach;
endif;