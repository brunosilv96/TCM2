<?php
require_once 'php/lib/bancoDeDados.php';
require_once 'php/class/Endereco.php';

session_start();

$codigo = $_SESSION["id_usuario"];

$conex = new BancoDeDados();

$logradouro = null;
$numero = null;
$cidade = null;
$uf = null;
$complemento = null;
$flag = null;

if(isset($_GET["flag"])){
    $flag = $_GET["flag"];
}

if ($conex->abrirConexao()) {

    $conex->executarSQL("SELECT * FROM endereco WHERE id_usuario_fk = '$codigo'");

    $resultado = $conex->lerResultados();

    if (count($resultado) > 0) {
        $logradouro = $resultado[0][1];
        $numero = $resultado[0][2];
        $cidade = $resultado[0][3];
        $uf = $resultado[0][4];
        $complemento = $resultado[0][5];
        
        $conex->fecharConexao();
    }
}

?>
<html>
<head>
<meta charset="utf-8">
<meta name="author" content="Bruno Silva">
<meta name="description" content="Pedidos do Wireframe">

<link rel="stylesheet" href="css/if_global.css">
<link rel="stylesheet" href="css/if_cadastro.css">
</head>
<body>

	<div class="conteudo">
		<h3>Alterar Endereço</h3>
		<form action="php/atualizaEndereco.php" method="post">
			<table>
				<tr>
					<td class="lb"><label>Logradouro:</label></td>
					<td class="txt"><input type="text" class="input-cadastro"
						name="txtLogradouro" value="<?php echo $logradouro;?>"></td>
				</tr>
				<tr>
					<td class="lb"><label>Número:</label></td>
					<td class="txt"><input type="text" class="input-cadastro"
						name="txtNumero" value="<?php echo $numero;?>"></td>
				</tr>
				<tr>
					<td class="lb"><label>Cidade:</label></td>
					<td class="txt"><input type="text" class="input-cadastro"
						name="txtCidade" value="<?php echo $cidade;?>"></td>
				</tr>
				<tr>
					<td class="lb"><label>UF:</label></td>
					<td class="txt"><input type="text" class="input-cadastro"
						name="txtUf" value="<?php echo $uf;?>"></td>
				</tr>
				<tr>
					<td class="lb"><label>Complemento:</label></td>
					<td class="txt"><input type="text" class="input-cadastro"
						name="txtComplemento" value="<?php echo $complemento;?>"></td>
				</tr>
				<?php
					if(trim($flag) != ""){
				?>
				<tr>
					<td colspan="2"><label class="lb-msg"><p class="p sucesso"><?php echo $flag;?></p></label></td>
				</tr>
				<?php
				}
				?>
			</table>
			<div class="botoes">
				<input type="reset" name="btnLimpar" class="btn-cadastro"
					value="Limpar"> 
					<input type="submit" name="btnSalvar"
					class="btn-cadastro" value="Salvar">
			</div>
		</form>
	</div>
</body>
</html>

<!--
	Combo BOX com as UF dos Estádos:

	<select name="estado"> 
    <option value="ac">Acre</option> 
    <option value="al">Alagoas</option> 
    <option value="am">Amazonas</option> 
    <option value="ap">Amapá</option> 
    <option value="ba">Bahia</option> 
    <option value="ce">Ceará</option> 
    <option value="df">Distrito Federal</option> 
    <option value="es">Espírito Santo</option> 
    <option value="go">Goiás</option> 
    <option value="ma">Maranhão</option> 
    <option value="mt">Mato Grosso</option> 
    <option value="ms">Mato Grosso do Sul</option> 
    <option value="mg">Minas Gerais</option> 
    <option value="pa">Pará</option> 
    <option value="pb">Paraíba</option> 
    <option value="pr">Paraná</option> 
    <option value="pe">Pernambuco</option> 
    <option value="pi">Piauí</option> 
    <option value="rj">Rio de Janeiro</option> 
    <option value="rn">Rio Grande do Norte</option> 
    <option value="ro">Rondônia</option> 
    <option value="rs">Rio Grande do Sul</option> 
    <option value="rr">Roraima</option> 
    <option value="sc">Santa Catarina</option> 
    <option value="se">Sergipe</option> 
    <option value="sp">São Paulo</option> 
    <option value="to">Tocantins</option> 
   </select>
-->
