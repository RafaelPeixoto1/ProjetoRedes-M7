<?php 
session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	//conteúdo




if ($_SERVER['REQUEST_METHOD']=="POST") {
	$id_ginasio="";
	$aula="";
	$horario="";
	$professor="";
	
if (isset($_POST['id_ginasio'])) {
		$id_ginasio=$_POST['id_ginasio'];
	
	}

	if (isset($_POST['aula'])) {
		$aula=$_POST['aula'];
	
	}
	if (isset($_POST['horario'])) {
		$horario=$_POST['horario'];
	
	}
	if (isset($_POST['professor'])) {
		$professor=$_POST['professor'];
	
	}

	$con=new mysqli("localhost","root","","projetoredes_gym");
	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso á base de dados.<br>".$con->connect_erro;
		exit;
	}
	else{
		$sql='insert into aula (id_ginasio,aula,horario,professor) values (?,?,?,?)';
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('isss',$id_ginasio,$aula,$horario,$professor);
			$stm->execute();
			
			$stm->close();

			echo "<script>alert('aula adicionado com sucesso')</script>";

			echo "Aguarde um momento. A reencaminhar pagina";

			header("refresh:5; url=index.php");
		}
		else{
			echo ($con->error);
			echo "Aguarde um momento. A reencaminhar página";
			header("refresh:5; url=index.php");
		} 
	} //end if
} //if
else{
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Adicionar aula</title>
</head>
<body>
<h1>Adicionar aula</h1>
<form action="aula_create.php" method="post">
	
	<label>id_ginasio</label><input type="text" name="id_ginasio" required ><br>
	<br>
	<label>Aula</label><input type="text" name="aula" required ><br>
	<br>
	<label>Horario</label><input type="time" name="horario" required ><br>
	<br>
	<label>Professor</label><input type="text" name="professor" required ><br>
	<br>
	<input type="submit" name="enviar">
</form>
</body>
</html>
<?php  
}


}
else{
	echo "Para entrar nesta página necessita de efetuar <a href='login.php'>login</a>";
	header('refresh:2;url=login.php');
}
?>