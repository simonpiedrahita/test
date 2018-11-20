<?php
include("conexion.php");
/*$cn=mysql_connect("localhost","root","")or die("Error en Conexion");
$db=mysql_select_db("bdfacturacion")or die("Error en Db");*/
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
<title>Actualización de Clientes</title>
</head>

<body>
<header>
<center>
<h2>Actualización de Clientes con PHP y MySQL</h2>
</center>
</header>



<!--AQUI COMIENZA EL CODIGO DE PHP CON MYSQL-->

<?php
$nitocc="";
$nombre="";
$direccion="";
$telefono="";
$fechaingreso="";
$cupocredito="";
$foto="";

if(isset($_POST["btn1"]))
	{
		$btn=$_POST["btn1"];
		$nitoccbus=$_POST["txtnitoccbus"];
		if($btn=="Buscar")
		{
			
			$res = $MySQLiconexion->query("select * from tblcliente where nitocc='$nitoccbus'");
			while($resul=$res->fetch_array())
			{
				$nitocc=$resul[0];
				$nombre=$resul[1];
				$direccion=$resul[2];
				$telefono=$resul[3];
				$fechaingreso=$resul[4];
				$cupocredito=$resul[5];
				$foto=$resul[6];
			}
				
			}
			/*if($btn=="Nuevo")
			{
				//echo "<script>document.getElementById('txtnitocc').focus();</script>";
				/*$res = $MySQLiconexion->query("select count(nitocc),Max(nitocc) from tblcliente");
				$count=0;
				$max=0;
				while($resul=$res->fetch_array())
				{
					$count=$resul[0];
					$max=$resul[1];
				}
				/*if($count==0)
				{
					$nitocc="10";
				}
				else
				{
					$nitocc=$max+1;
				}
				
			}*/
			if($btn=="Guardar")
			{
				$nitocc=$_POST["txtnitocc"];
				$nombre=$_POST["txtnombre"];
				$direccion=$_POST["txtdireccion"];
				$telefono=$_POST["txttelefono"];
				$fechaingreso=$_POST["txtfechaingreso"];
				$cupocredito=$_POST["txtcupocredito"];
				//Manejo de Foto
				$nombre_foto=$_FILES['foto']['name'];//Nombre de la foto
				$ruta=$_FILES['foto']['tmp_name'];//ruta o path del archivo
				$foto='fotos/'.$nombre_foto; //ruta y nombre del archivo
				copy ($ruta,$foto);//Guarda archivo en ruta especifica
				//
				//$SQL = $MySQLiconexion->query("insert into tblcliente(nitocc,nombre,direccion,telefono,fechaingreso,cupocredito,foto) values ('$nitocc','$nombre','$direccion','$telefono','$fechaingreso','$cupocredito','$foto')");
				// Codigo para buscar nitocc
				$sqlbuscar="SELECT nitocc FROM tblcliente WHERE nitocc = '$nitocc' ORDER BY nitocc";
				if ($result=mysqli_query($MySQLiconexion,$sqlbuscar))
				  {
					  $nroregistros=mysqli_num_rows($result);
					  if ($nroregistros>0)
					  {
					  	echo "<script>alert('Nitocc ya existe!!!');</script>";
					  }
					  else
					  {
					  	$SQL = $MySQLiconexion->query("insert into tblcliente(nitocc,nombre,direccion,telefono,fechaingreso,cupocredito,foto) values ('$nitocc','$nombre','$direccion','$telefono','$fechaingreso','$cupocredito','$foto')");
					  	if(!$SQL)
			  				{
			   					echo $MySQLiconexion->error;
			  				} 
			  				else
			  				{
								echo "<script> alert('Se insertó correctamente');</script>";
							}
					  }
				  }
			}
			if($btn=="Actualizar")
			{
				$nitocc=$_POST["txtnitocc"];
				$nombre=$_POST["txtnombre"];
				$direccion=$_POST["txtdireccion"];
				$telefono=$_POST["txttelefono"];
				$fechaingreso=$_POST["txtfechaingreso"];
				$cupocredito=$_POST["txtcupocredito"];
				$nombre_foto=$_FILES['foto']['name'];//Nombre de la foto
				$ruta=$_FILES['foto']['tmp_name'];//ruta o path del archivo
				$foto='fotos/'.$nombre_foto; //ruta y nombre del archivo
				copy ($ruta,$foto);//Guarda archivo en ruta especifica
				$SQL = $MySQLiconexion->query("update tblcliente set nombre ='$nombre',direccion='$direccion',telefono='$telefono',fechaingreso='$fechaingreso',cupocredito='$cupocredito',foto='$foto' where nitocc='$nitocc'");
				if(!$SQL)
  				{
   					echo $MySQLiconexion->error;
  				} 
  				else
  				{
					echo "<script> alert('Se actualizó correctamente');</script>";
				}
			}
			if($btn=="Eliminar")
			{
				$nitocc=$_POST["txtnitocc"];
					
				$SQL = $MySQLiconexion->query("delete from tblcliente where nitocc='$nitocc'");
			if(!$SQL)
  				{
   					echo $MySQLiconexion->error;
  				} 
  				else
  				{
					echo "<script> alert('Se eliminó correctamente');</script>";
				}
			}
	}
?>
<form name="fe" action="" method="post" enctype="multipart/form-data">
<center>
<table border="0">
<tr>
<td>Buscar</td>
<td><input type="text" name="txtnitoccbus"/></td>
<td><input type="submit" name="btn1"  value="Buscar"  /></td>
</tr></table>

<table border="0">
<tr>
<td>Nit o CC</td>
<td><input type="text" id="txtnitocc" name="txtnitocc" value="<?php echo $nitocc?>" /></td>
</tr>

<tr>
<td>Nombre</td>
<td><input type="text" name="txtnombre"  value="<?php echo $nombre?>"/></td>
</tr>
<tr>
<td>Direccion</td>
<td><input type="text" name="txtdireccion"  value="<?php echo $direccion?>"/></td>
</tr>
<tr>
<td>Telefono</td>
<td><input type="text" name="txttelefono"  value="<?php echo $telefono?>"/></td>
</tr>
<tr>
<td>Fecha Ingreso</td>
<td><input type="text" name="txtfechaingreso"  value="<?php echo $fechaingreso?>"/></td>
</tr>

<tr>
<td>Cupo Credito</td>
<td><input type="text" name="txtcupocredito" value="<?php echo $cupocredito?>"/></td>
</tr>
<tr>
<td>Subir Foto</td>
<td><input type="file" name="foto" id="foto">
</td>
<tr>
<td>Imagen</td>
<td>
	<img src="<?php echo $foto?>" width="50" height="50">
</td>
</tr>

<tr align="center">
<td colspan="2"><input type="button" name="btn1" value="Nuevo" onclick="document.getElementById('txtnitocc').focus();"/>
<input type="submit" name="btn1" value="Listar"/>
</td>
</tr>
<tr align="center"><td colspan="2"><input type="submit" name="btn1" value="Actualizar"/><input type="submit" name="btn1" value="Eliminar"/>
<input type="submit" name="btn1" value="Guardar"/></td></tr>

</table>

</center>
<br />
<hr>
</form>
<br />



<?php
if(isset($_POST["btn1"]))
{
	$btn=$_POST["btn1"];

	if($btn=="Listar")
	{
		echo"<center>
			<table border='3'>
			<tr>
			<td bgcolor='gray' style='color:yellow;font-weight: bold'>Nitocc</td>
			<td bgcolor='gray' style='color:yellow;font-weight: bold'>Nombre</td>
			<td bgcolor='gray' style='color:yellow;font-weight: bold'>Direccion</td>
			<td bgcolor='gray' style='color:yellow;font-weight: bold'>Telefono</td>
			<td bgcolor='gray' style='color:yellow;font-weight: bold'>Fecha Ingreso</td>
			<td bgcolor='gray' style='color:yellow;font-weight: bold'>Cupo Credito</td>
			<td bgcolor='gray' style='color:yellow;font-weight: bold'>Foto</td>
			</tr>";
			$res = $MySQLiconexion->query("select * from tblcliente");
			while($resul=$res->fetch_array())
			{
				$nitocc=$resul[0];
				$nombre=$resul[1];
				$direccion=$resul[2];
				$telefono=$resul[3];
				date_default_timezone_set('America/Bogota');
				$fechaingreso=date("d-m-Y", strtotime($resul[4]));
				$cupocredito=number_format($resul[5]);
				$foto=$resul[6];
				echo "<tr>
					<td>$nitocc</td>
					<td>$nombre</td>
					<td>$direccion</td>
					<td>$telefono</td>
					<td>$fechaingreso</td>
					<td>$cupocredito</td>
					<td><img src='$foto' width='20' height='20'></td>
					</tr>";
			}
			
			echo "</table>
</center>";
	}
}
?>
</body>
</html>