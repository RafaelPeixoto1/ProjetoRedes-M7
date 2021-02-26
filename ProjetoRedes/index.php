<?php 
session_start();
if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto"&& isset($_SESSION['login'])){
	//conteúdo


 ?>



<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="fa/css/all.css">
	<script type="text/javascript" src="fa/js/all.js"></script>
	 <script src="js/jquery-3.5.1.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>



<?php 
//session_start();
$con=new mysqli("localhost","root","","projetoredes_gym");
if($con->connect_errno!=0){
	echo "Ocorreu um erro no acesso à base de dados".$con->connect_error;
	exit;
}
else{
	if(!isset($_SESSION['login'])){
		$_SESSION['login']="incorreto";
	}
	if($_SESSION['login']=="correto"){



	 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>GYM</title>
</head>
<body>





<div class="container-fluid">
	<div class="row">
		<div align="left" class="col-md-4">
			<h1>Lista de Ginasios </h1>
<?php 
$stm=$con->prepare('select * from ginasio');
$stm->execute();
$res=$stm->get_result();
while ( $resultado=$res->fetch_assoc() ) {
	echo '<a href="ginasio_show.php?ginasio='.$resultado['id'].'">';
	echo $resultado['ginasio'];
	echo "</a>";
	echo ' <a href="ginasio_edit.php?ginasio='.$resultado['id'].'"><strong>Editar</strong></a>';
	
	echo '  <a href="ginasio_delete.php?ginasio='.$resultado['id'].'"><strong>Eliminar</strong></a>';
	echo "<br>";
}
$stm->close();
 ?>
		</div>
</div></div>

	

		<div align="middle" class="col-md-4">

<a href="ginasio_create.php"><strong><i>Adicionar ginasios</i></strong></a>
<br><br>
<a href="aula_create.php"><strong><i>Adicionar aulas</i></strong></a>

	</div>

		
	
<div class="container-fluid">
	<div class="row">
		<div align="right" class="col-md-4">
			
<h1>Lista de Aulas </h1>
<?php 
$stm=$con->prepare('select * from aula');
$stm->execute();
$res=$stm->get_result();
while ( $resultado=$res->fetch_assoc() ) {
	
	echo '<a href="aula_show.php?aula='.$resultado['id'].'">';
	echo $resultado['aula'];
	echo "</a>";

	echo '  <a href="aula_edit.php?aula='.$resultado['id'].'"><strong>Editar</strong></a>';

	echo '  <a  href="aula_delete.php?aula='.$resultado['id'].'"><strong>Eliminar</strong></a>';
	echo "<br>";
}
$stm->close();
 ?>
	</div>
	</div>
</div>



<?php 
} //end if 
else{
	echo "Para entrar nesta página necessita de efetuar <a href='login.php'>login</a>";
	header('refresh:2;url=login.php');
}

}
 ?>

</body>
</html>
<br><br>


	<h1><p align="center">GINÁSIO</h1></p>
<p align="center"><img  src="capturar.png"></p>






<?php  
}
else{
	echo "Para entrar nesta página necessita de efetuar <a href='login.php'>login</a>";
	header('refresh:2;url=login.php');
}
?>
