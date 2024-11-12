<?php

$con = mysqli_connect("localhost", "root", "", "informacoes");

if (isset($_FILES['file'])) {
    $file = $_FILES['file']['tmp_name'];
    $dados = file_get_contents($file);
    $read_json = json_decode($dados, true)['data'];

    foreach ($read_json as $value) {
        // verifyDuplicateEmail($value["email"]);
        addDb(
            $value['nome'],
            $value['email'],
            $value['telefone']
        );
    }
}

if (isset($_GET["excluir"])) {
    $id = intval($_GET["id"]);
    deleteItem($id);
}

function addDb($nome, $email, $telefone) {
    $con = mysqli_connect("localhost", "root", "", "informacoes");

    $sql = "INSERT INTO
                clientes (nome, email, telefone)
            VALUES
                ('$nome', '$email', '$telefone')";

    mysqli_query($con, $sql);
}

function deleteItem($id) {
    $con = mysqli_connect("localhost", "root", "", "informacoes");

    $sql = "DELETE FROM
                clientes
            WHERE
                id=$id";

    mysqli_query($con, $sql);
}

function verifyDuplicateEmail($email) {
    $con = mysqli_connect("localhost", "root", "", "informacoes");

    $sql = "SELECT
                *
            FROM
                clientes ";

    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $rowEmail = $row['email'];

        if ($rowEmail == $email) {
            echo "esse email ja existe";
            return;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?= time(); ?>">
    <title>Tela Importação</title>
    <script src="index.js" defer></script>
</head>

<body>
    <header class="container">
        <h1>Tela De Importação</h1>
    </header>

    <form method="POST" enctype="multipart/form-data" class="form-file">
        <input name="file" type="file">
        <button class="button-86" role="button" type="submit">Submit</button>
    </form>

    <div id="modal" class="modal">
        <div class="modal__window">
            <a href="#" class="modal__close" >X</a>
            <h2>Editar Cliente</h2>
            <form id="editForm" method="POST">
                <input type="hidden" name="id" id="editId">
                <label for="editNome">Nome:</label>
                <input type="text" name="nome" id="editNome" required>
                <label for="editEmail">Email:</label>
                <input type="email" name="email" id="editEmail" required>
                <label for="editTelefone">Telefone:</label>
                <input type="text" name="telefone" id="editTelefone" required>
                <button type="submit" id="salvar-btn">Salvar</button>
            </form>
        </div>
    </div>

    <!-- <div id="modal" class="modal">
        <div class="modal__window">
            <a href="#" class="modal__close" >X</a>
            <h2>Editar Cliente</h2>
            <form id="editForm">
                <input type="hidden" name="id" id="editId">
                <label for="editNome">Nome:</label>
                <input type="text" name="nome" id="editNome" required>
                <label for="editEmail">Email:</label>
                <input type="email" name="email" id="editEmail" required>
                <label for="editTelefone">Telefone:</label>
                <input type="text" name="telefone" id="editTelefone" required>
                <button type="submit">Salvar</button>
            </form>
        </div>
    </div> -->

    <table>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Deletar</th>
            <th>Editar</th>
        </tr>

        <?php
            $sql = "SELECT * FROM clientes";
            $result = mysqli_query($con, $sql);

            while ($row = mysqli_fetch_assoc($result)):
        ?>

        <tr>
            <td><?= $row["nome"] ?></td>
            <td><?= $row["email"] ?></td>
            <td><?= $row["telefone"] ?></td>
            <td style="text-align: center;">
                <a href="?id=<?= $row['id'] ?>" name="excluir"  onclick="return confirm('Tem certeza que deseja excluir este registro?')" class="delete-btn">Excluir</a>
            </td>
            <td style="text-align: center;">
                <a href="#modal" class="edit-btn" data-id="<?= $row['id'] ?>" data-id="<?= $row['id'] ?>">Editar</a>
            </td>
        </tr>

        <?php endwhile; ?>
    </table>
</body>

</html>
