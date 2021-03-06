<?php
include("../cabecalho.php");
//include("../menu.php");
include("../conecta.php");
include("banco-ocorrencia-tipo.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST['nome'];
  $descricao = $_POST['descricao'];
  $setor = strtoupper($_POST['setor']);

  $resposta = adicionarTipoOcorrencia($conexao, $nome, $setor, $descricao);
  if(isset($resposta)){
    header("Location:http://localhost/TCC/SisOC/ocorrencia-tipo/listar-ocorrencia-tipo.php");
  }
}
?>

<head>
  <link rel="stylesheet" href="../css/global.css">
</head>

<div class="row col-md-12">
  <div class="">
    <h1>Registrar novo tipo de ocorrência</h1>
  </div>
</div>

<div class="row col-md-12">
  <div class="">
    <form action="" method="post">
      <div class="row">
        <div class="form-group col-md-6">
          <label for="nome">Nome do tipo</label>
          <input class="form-control" name="nome" id="nome" />
        </div>

        <div class="form-group col-md-6">
          <label for="nome">Nome do setor</label>
          <input class="form-control" name="setor" id="setor" />
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md-12">
          <label for="descricao">Descrição</label>
          <textarea class="form-control" name="descricao" id="descricao"></textarea>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Criar</button>
    </form>
  </div>
</div>

<?php include("../rodape.php"); ?>