<?php 
session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	//conteúdo




if ($_SERVER['REQUEST_METHOD']=="POST") {
	$ginasio="";
	


	if (isset($_POST['ginasio'])) {
		$ginasio=$_POST['ginasio'];
	
	}

	$con=new mysqli("localhost","root","","projetoredes_gym");
	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso á base de dados.<br>".$con->connect_erro;
		exit;
	}
	else{
		$sql='insert into ginasio (ginasio ) values (?)';
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('s',$ginasio);
			$stm->execute();
			
			$stm->close();

			echo "<script>alert('Gym adicionado com sucesso')</script>";

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
	<title>Adicionar ginasio</title>
</head>
<body>
<h1>Adicionar ginasio</h1>
<form action="ginasio_create.php" method="post">
	<label>Ginasio</label><input type="text" name="ginasio" required><br>
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