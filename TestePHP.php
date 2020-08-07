<?php

session_start();

include_once('connect.php');

$conid = '';
$connome = '';
$conemail = '';
$consenha = '';
$condata = '';
$concidade = '';
$conuf = '';
$conobs = '';
$conativo = '';

if (isset($_POST['consultar'])) {

    $consulta = $_POST['userconsulta'];

    if ($consulta == '') {
        $_SESSION['erro'] = "<p style='color:red; font-size:12px;'>Insira um User ID para consultar.</p>";
    } else {

        $query = "select * from usuarios where user = '$consulta'";
        $consulta_result = mysqli_query($conn, $query);

        if ($consulta_result) {

            if (mysqli_num_rows($consulta_result) > 0) {
                $linha = mysqli_fetch_array($consulta_result, MYSQLI_ASSOC);
                if ($linha['ativo'] == 1) {
                    $linha['ativo'] = 'Ativo';
                }

                $connome = $linha['nome'];
                $conemail = $linha['email'];
                $consenha = $linha['senha'];
                $condata = $linha['data_nasc'];
                $concidade = $linha['cidade'];
                $conuf = $linha['uf'];
                $conobs = $linha['observacao'];
                $conativo = $linha['ativo'];
            } else {
                $_SESSION['erro'] = "<p style='color:red; font-size:12px;'>User ID inválido.</p>";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8" />
    <title>Formulário Teste</title>

</head>

<style>
    body {
        text-align: center;
        font-family: arial;
        background-color: #ABCCEC;
        color: black;
        font-weight: bold;
        font-weight: 500;
    }

    header {
        color: black;
        text-align: center;
        background: white;
        font-size: 14px;
    }

    #form {
        width: 49%;
        height: 400px;
        float: left;
        border-radius: 15px;
        font-weight: bold;
        background-color: #FFFFFF;
    }

    #form2 {
        width: 49%;
        height: 400px;
        float: right;
        border-radius: 15px;
        font-weight: bold;
        background-color: #FFFFFF;
    }

    #dados {
        width: 100%;
        height: 190px;
        float: none;
    }

    .bt_buy {
        color: #ffffff;
        background-color: #ABCCEC;
        border: 2px solid #17202A;
        border-radius: 20px;
        cursor: pointer;
        color: black;
        font-family: Arial;
        font-weight: bold;
        font-size: 12px;
        padding: 6px 10px;
        text-decoration: none;
        vertical-align: middle;
    }

</style>

<body>

<header>
    <h1>Formulário teste</h1>
</header>
    <form action='processamento.php' method='POST'>
        <div id='form'>

            <div id='dados'>
                <br><b>Insira seus dados:</b><br><br>
                <center>
                    <table>
                        <tr>
                            <td>User ID:</td>
                            <td><input type='text' placeholder='User ID' id='user_nome' name='user' size=30 required></td>
                        </tr>
                        <tr>
                            <td>Nome:</td>
                            <td><input type='text' placeholder='Nome' id='user_nome' name='nome' size=30 required></td>
                        </tr>
                        <tr>
                            <td>E-mail:</td>
                            <td><input type='email' placeholder='E-mail' id='user_email' name='email' size=30 required></td>
                        </tr>
                        <tr>
                            <td>Senha:</td>
                            <td><input type='text' placeholder='Senha' id='user_senha' name='senha' size=30 required></td>
                        </tr>
                        <tr>
                            <td>Data de nascimento: </td>
                            <td><input type='date' id='user_data' name='data' required></td>
                        </tr>
                        <tr>
                            <td>Cidade:</td>
                            <td><input type='text' placeholder='Cidade' id='user_cidade' name='cidade' size=30 required></td>
                        </tr>
                        <tr>
                            <td>UF:</td>
                            <td>
                                <select id='user_uf' name='uf'>
                                    <option value="AC">AC</option>
                                    <option value="AL">AL</option>
                                    <option value="AP">AP</option>
                                    <option value="AM">AM</option>
                                    <option value="BA">BA</option>
                                    <option value="CE">CE</option>
                                    <option value="DF">DF</option>
                                    <option value="ES">ES</option>
                                    <option value="GO">GO</option>
                                    <option value="MA">MA</option>
                                    <option value="MT">MT</option>
                                    <option value="MS">MS</option>
                                    <option value="MG">MG</option>
                                    <option value="PA">PA</option>
                                    <option value="PB">PB</option>
                                    <option value="PR">PR</option>
                                    <option value="PE">PE</option>
                                    <option value="PI">PI</option>
                                    <option value="RJ">RJ</option>
                                    <option value="RN">RN</option>
                                    <option value="RS">RS</option>
                                    <option value="RO">RO</option>
                                    <option value="RR">RR</option>
                                    <option value="SC">SC</option>
                                    <option value="SP">SP</option>
                                    <option value="SE">SE</option>
                                    <option value="TO">TO</option>
                            </td>
                            </select>
                        </tr>

                        <tr>
                            <td>Observação:</td>
                            <td><textarea placeholder='Observação' id='user_obs' name='observacao' rows='3' cols='32'></textarea></td>
                        </tr>
                        <tr>
                            <td style='text-align:right'><input type='checkbox' id='user_terms' name='ativo' required></td>
                            <td>
                                <a href='TestePHP.php' style='font-size:12px;'>Aceito os termos e condições do cadastro.</a>
                            </td>
                        </tr>
                    </table>

                    <br>

                    <button class='bt_buy' type="submit" name='enviar'>Enviar Formulário</button>
                    <button class='bt_buy' type="reset">Limpar Campos</button>

                    <?php

                    if (isset($_SESSION['retorno'])) {
                        echo $_SESSION['retorno'];
                        unset($_SESSION['retorno']);
                    }
                    ?>

                </center>
            </div>
        </div>
    </form>

    <form action='' method='post'>
        <div id='form2'>

            <div id='dados'>
                <br><b>Consulta ao cadastro:</b><br><br>
                <center>
                    <table>
                        <tr>
                            <td>User ID:</td>
                            <td><input type='text' placeholder='Digite o User ID a ser consultado' id='user_nome' name='userconsulta' size=30 value="<?php if (isset($_POST['userconsulta'])) echo $_POST['userconsulta']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Nome:</td>
                            <td><input type='text' name='connome' value='<?php echo $connome; ?>' readonly></td>
                        </tr>
                        <tr>
                            <td>E-mail:</td>
                            <td><input type='text' name='connome' value='<?php echo $conemail; ?>' readonly></td>
                        </tr>
                        <tr>
                            <td>Senha:</td>
                            <td><input type='text' name='connome' value='<?php echo $consenha; ?>' readonly></td>
                        </tr>
                        <tr>
                            <td>Data de nascimento:</td>
                            <td><input type='text' name='connome' value='<?php echo $condata; ?>' readonly></td>
                        </tr>
                        <tr>
                            <td>Cidade:</td>
                            <td><input type='text' name='connome' value='<?php echo $concidade; ?>' readonly></td>
                        </tr>
                        <tr>
                            <td>UF:</td>
                            <td><input type='text' name='connome' value='<?php echo $conuf; ?>' readonly></td>
                        </tr>

                        <tr>
                            <td>Observação:</td>
                            <td><textarea name='observacao' rows='3' cols='32' readonly><?php echo $conobs; ?></textarea></td>
                        </tr>
                        <tr>
                            <td>Situação cadastral:</td>
                            <td><input type='text' name='connome' value='<?php echo $conativo; ?>' readonly></td>
                        </tr>
                    </table>

                    <br>

                    <button class='bt_buy' type="submit" name='consultar'>Consultar usuário</button>

                    <?php

                    if (isset($_SESSION['erro'])) {
                        echo $_SESSION['erro'];
                        unset($_SESSION['erro']);
                    }
                    ?>
                </center>

            </div>

        </div>

    </form>
    

</body>

</html>