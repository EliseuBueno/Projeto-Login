<?php
session_start();
include_once("conexao.php");
$btnLogin = filter_input(INPUT_POST, 'btnLogin', FILTER_SANITIZE_STRING);
if($btnLogin){
	$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
	$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
	// echo "$usuario - $senha";
	if((!empty($usuario)) AND (!empty($senha))){
		//echo "$usuario - $senha";
		//Gerar a senha criptografa
		//echo password_hash($senha, PASSWORD_DEFAULT);
		//Pesquisar o usuário no BD
		$result_usuario = "SELECT * FROM usuarios WHERE usuario='$usuario' LIMIT 1";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		if($resultado_usuario){
			// echo "$usuario - $senha";
			$row_usuario = mysqli_fetch_assoc($resultado_usuario);
			if(password_verify($senha, $row_usuario['senha'])){
				// echo "$usuario - $senha";
				$_SESSION['id'] = $row_usuario['id'];
				$_SESSION['nome'] = $row_usuario['nome'];
				//$_SESSION['email'] = $row_usuario['email'];
				//$_SESSION['cidade'] = $row_usuario['cidade'];
				//$_SESSION['estado'] = $row_usuario['estado'];
				//$_SESSION['cep'] = $row_usuario['cep'];
				//$_SESSION['logradouro'] = $row_usuario['logradouro'];
				//$_SESSION['numero'] = $row_usuario['numero'];
				//$_SESSION['bairro'] = $row_usuario['bairro'];
				//$_SESSION['complemento'] = $row_usuario['complemento'];
				//$_SESSION['telefone'] = $row_usuario['telefone'];
				$_SESSION['img'] = $row_usuario['img'];
				echo "<script> alert('Login realizado com sucesso')</script>";
				echo "<script>document.location='pedidos/pedidos.php'</script>";
			}else{
				$_SESSION['msg'] = "<div class='alert alert-danger'>Login ou senha incorreto!</div>";
				echo "<script>document.location='login.php'</script>";
			}
		}
	}else{
		$_SESSION['msg'] = "<div class='alert alert-danger'>Login ou senha incorreto!</div>";
		echo "<script>document.location='login.php'</script>";
	}
}

else{
	$_SESSION['msg'] = "<div class='alert alert-danger'>Página não encontrada</div>";
	echo "<script>document.location='login.php'</script>";
}

