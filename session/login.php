<?php
include("../cabecalho.php");
include("../conecta.php");
include("banco-login.php");

session_start();
if (isset($_SESSION['logado'])) {
    header('Location: index.php');
    echo ($_SESSION['logado']);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $count = 0;
    $infos = array();
    if ($_POST["tipo"] == "A" || $_POST["tipo"] == "S") {
        $ra_siape = $_POST["raSiape"];
        $senha = $_POST["password"];

        $resultado = loginInstituicao($conexao, $ra_siape, $senha);
        $count = pg_num_rows($resultado);
        echo "$resultado";
    } else {
        $email = $_POST["email"];
        $senha = $_POST["password"];

        $resultado = loginTerceiros($conexao, $email, $senha);
        $count = pg_num_rows($resultado);
        echo "$resultado";
    }

    if ($count != 1) {
        header('Location: login.php?error=2');
    } else {
        $_SESSION['logado'] = true;
        header('Location: index.php');
    }
}
?>

<head>
    <link rel="stylesheet" href="../css/login.css">
</head>

<div class="content">
    <h1>Efetuar Login</h1>
    <?php if (isset($_GET["error"]) && $_GET["error"] == '1') { ?>
        <p class="alert-danger">Você precisa fazer login primeiro!</p>
    <?php } else if (isset($_GET["error"]) && $_GET["error"] == '2') { ?>
        <p class="alert-danger">Usuário ou senha incorretos!</p>
    <?php } ?>

    <form action="" method="post">
        <div class="form-group">
            <label for="tipo">Tipo de login</label>
            <select class="form-control" id="tipo" name="tipo" required>
                <option value="A">ALUNO</option>
                <option value="S">SERVIDOR</option>
                <option value="T">TERCEIRIZADO</option>
                <option value="O">OUTRO</option>
            </select>
        </div>
        <div id="emailDiv" class="form-group">
            <label for="email">E-mail</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="E-mail" />
        </div>
        <div id="raSiapeDiv" class="form-group">
            <label for="raSiape">RA/SIAPE</label>
            <input type="text" class="form-control" id="raSiape" name="raSiape" placeholder="RA/SIAPE" value="<?php $count ?>" />
        </div>
        <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" />
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>

<script>
    $(document).ready(function() {
        $("#emailDiv").hide();
    });
    document.querySelector("#tipo").addEventListener("change", function(data) {
        let val = data.target.value;
        console.log(val)
        if (val === "A" || val === "S") {
            $("#emailDiv").hide();
            $("#raSiapeDiv").show();
        } else {
            $("#raSiapeDiv").hide();
            $("#emailDiv").show();
        }
    });
</script>
<?php include("../rodape.php"); ?>