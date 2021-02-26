<?php

session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	//conteúdo






		if ($_SERVER['REQUEST_METHOD']=="GET") {
	if (isset($_GET['aula'])&& is_numeric($_GET['aula'])) {
		$idAula=$_GET['aula'];
		$con=new mysqli("localhost","root","","projetoredes_gym");

		if ($con->connect_errno!=0) {
				echo "<h1>Ocorreu um erro no acesso a base de dados.<br>".$connect_eror."</h1>";
				exit();
		}
		$sql="Select * from aula where id=?";
		$stm=$con->prepare($sql);
		if ($stm!=false) {
				$stm->bind_param("i",$idAula);
				$stm->execute();
				$res=$stm->get_result();
				$aula=$res->fetch_assoc();
				$stm->close();
		}
	
				  ?>
	  <!DOCTYPE html>
	  <html>
	  <head>
	  	<title>Editar aula</title>
	  </head>
	  <body>
	  <h1>Editar aula</h1>

<?php 
$stm=$con->prepare('select * from aula');
$stm->execute();
$res=$stm->get_result();
while ( $resultado=$res->fetch_assoc() ) {

}
 ?>

	  <form action="aula_update.php?aula=<?php  echo $aula['id']; ?>" method="post">
	<label>id_ginasio</label><input type="text" name="id_ginasio" required value="<?php echo $aula['id_ginasio'];?>"><br>
	<br>
	
	<label>Aula</label><input type="text" name="aula" required value="<?php echo $aula['aula'];?>"><br>
	<br>
	<label>Horario</label><input type="time" name="horario" required value="<?php echo $aula['horario'];?>"><br>
	<br>
	<label>Professor</label><input type="text" name="professor" required value="<?php echo $aula['professor'];?>"><br>
	<br>

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