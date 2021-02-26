<?php

session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	//conteúdo




if ($_SERVER['REQUEST_METHOD']=="GET") {
	if (isset($_GET['ginasio'])&& is_numeric($_GET['ginasio'])) {
		$idGinasio=$_GET['ginasio'];
		$con=new mysqli("localhost","root","","projetoredes_gym");

		if ($con->connect_errno!=0) {
				echo "<h1>Ocorreu um erro no acesso a base de dados.<br>".$connect_eror."</h1>";
				exit();
		}
		$sql="Select * from ginasio where id=?";
		$stm=$con->prepare($sql);
		if ($stm!=false) {
				$stm->bind_param("i",$idGinasio);
				$stm->execute();
				$res=$stm->get_result();
				$ginasio=$res->fetch_assoc();
				$stm->close();
		}
	
				  ?>
	  <!DOCTYPE html>
	  <html>
	  <head>
	  	<title>Editar Gym</title>
	  </head>
	  <body>
	  <h1>Editar Gym</h1>

<?php 
$stm=$con->prepare('select * from ginasio');
$stm->execute();
$res=$stm->get_result();
while ( $resultado=$res->fetch_assoc() ) {

}
 ?>

	  <form action="ginasio_update.php?ginasio=<?php  echo $ginasio['id']; ?>" method="post">
	<label>Ginasio</label><input type="text" name="ginasio" required value="<?php echo $ginasio['ginasio'];?>"><br>
	
	
	<input type="submit" name="enviar">
</form>

	  </body>
	  </html>
	  <?php
	}	
else{
	echo ("<h1>houve um erro ao precessar o seu pedido.<br> Dentro de segundos sera reencaminhado!</h1>");
	header("refresh:5; url=index.php");
	}
		$stm->close();
}	



}
else{
	echo "Para entrar nesta página necessita de efetuar <a href='login.php'>login</a>";
	header('refresh:2;url=login.php');
}

?>