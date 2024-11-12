<?php

$con = mysqli_connect("localhost", "root", "", "informacoes");

// && $_POST["nome"] && $_POST["email"]) && $_POST["telefone"] && $_POST["id"]
if(isset($_POST["id"])):
    $id = $_POST["id"];
    $name = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];

    $updateQuery = "UPDATE clientes SET nome=$name, email=$email, telefone=$telefone WHERE id=$id";
    $result = mysqli_query($con, $updateQuery);

    echo json_encode(["sucess" => $result]);
endif;
