<?php

session_start();

include_once('connect.php');

$user_id = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email');
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
$data_nasc = filter_input(INPUT_POST, 'data');
$cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
$uf = filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_STRING);
$obs = filter_input(INPUT_POST, 'observacao', FILTER_SANITIZE_STRING);
$cadastro = filter_input(INPUT_POST, 'ativo');

if (isset($_POST['enviar'])) {
    if (empty($_POST['observacao'])) {
        $obs = 'Nenhuma observação';
    }
}

if(!empty($_POST['ativo'])){
    $cadastro = true;
}

if (isset($_POST['enviar'])) {
    $consultando_user = "select * from usuarios where user = '$user_id'";
    $resultado_user = mysqli_query($conn, $consultando_user);
    $consultando_email = "select * from usuarios where email = '$email'";
    $resultado_email = mysqli_query($conn, $consultando_email);

    if (mysqli_num_rows($resultado_user) > 0) {
        $_SESSION['retorno'] = "<p style='color:red; font-size:12px;'>Erro no cadastramento: User ID já está em uso!</p>";
        header("Location: TestePHP.php");
    } else if (mysqli_num_rows($resultado_email) > 0) {
        $_SESSION['retorno'] = "<p style='color:red; font-size:12px;'>Erro no cadastramento: o e-mail já está em uso!</p>";
        header("Location: TestePHP.php");
    } else {
        $cad_usuario = "insert into usuarios (user, nome, email, senha, data_nasc, cidade, uf, observacao, ativo) values ('$user_id', '$nome', '$email', '$senha', '$data_nasc', '$cidade', '$uf', '$obs', '$cadastro')";
        $resultado_cadastro = mysqli_query($conn, $cad_usuario);
    }
}

if (mysqli_insert_id($conn)) {
    $_SESSION['retorno'] = "<p style='color:green; font-size:12px;'>Usuário cadastrado com sucesso!</p>";
    header("Location: TestePHP.php");
}
