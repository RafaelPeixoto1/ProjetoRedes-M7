<?php 


session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	//conteúdo






if ($_SERVER['REQUEST_METHOD']=="POST") {
	$titulo="";
	
	$idGinasio=$_GET['ginasio'];
	if (isset($_POST['ginasio'])) {
		$ginasio=$_POST['ginasio'];
	
	}
	$con=new mysqli("localhost","root","","projetoredes_gym");
	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso á base de dados.<br>".$con->connect_erro;
		exit;
	}
	else{
		$sql='update ginasio set ginasio=? where id=?';
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param('si',$ginasio,$idGinasio);
			$stm->execute();
			$stm->close();
echo "<script>alert('ginasio adicionado com sucesso')</script>";

			echo "Aguarde um momento. A reencaminhar pagina";

			header("refresh:5; url=index.php");
		}
		else{
		}
	}
}
else{
	echo "<h1>Houve um erro ao processar o seu pedido!<br>Ira ser reencaminhado!</h1>";
	header("refresh:5; url=index.php");
}

}
else{
	echo "Para entrar nesta página necessita de efetuar <a href='login.php'>login</a>";
	header('refresh:2;url=login.php');
}