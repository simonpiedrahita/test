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
$CodProd="";
$Descripcion="";
$PrecioCosto="";
$Existencia="";
$foto="";

if(isset($_POST["btn1"]))
	{
		$btn=$_POST["btn1"];
		$CodProdbus=$_POST["txtCodProdbus"];
		if($btn=="Buscar")
		{
			
			$res = $MySQLiconexion->query("select * from tblproducto where CodProd='$CodProdbus'");
			while($resul=$res->fetch_array())
			{
				$CodProd=$resul[0];
				$Descripcion=$resul[1];
				$PrecioCosto=$resul[2];
				$Existencia=$resul[3];
				$foto=$resul[4];
			}
				
			}
			
			if($btn=="Guardar")
			{
				$CodProd=$_POST["txtCodProd"];
				$Descripcion=$_POST["txtDescripcion"];
				$PrecioCosto=$_POST["txtPrecioCosto"];
				$Existencia=$_POST["txtExistencia"];
				//Manejo de Foto
				$nombre_foto=$_FILES['foto']['name'];//Nombre de la foto
				$ruta=$_FILES['foto']['tmp_name'];//ruta o path del archivo
				$foto='fotos/'.$nombre_foto; //ruta y nombre del archivo
				copy ($ruta,$foto);//Guarda archivo en ruta especifica
				//
				//$SQL = $MySQLiconexion->query("insert into tblcliente(nitocc,nombre,direccion,telefono,fechaingreso,cupocredito,foto) values ('$nitocc','$nombre','$direccion','$telefono','$fechaingreso','$cupocredito','$foto')");
				// Codigo para buscar nitocc
				$sqlbuscar="SELECT CodProd FROM tblproducto WHERE CodProd = '$CodProd' ORDER BY CodProd";
				if ($result=mysqli_query($MySQLiconexion,$sqlbuscar))
				  {
					  $nroregistros=mysqli_num_rows($result);
					  if ($nroregistros>0)
					  {
					  	echo "<script>alert('CodProd ya existe!!!');</script>";
					  }
					  else
					  {
					  	$SQL = $MySQLiconexion->query("insert into tblproducto(CodProd,Descripcion,PrecioCosto,Existencia,foto) values ('$CodProd','$Descripcion','$PrecioCosto','$Existencia','$foto')");
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
				$CodProd=$_POST["txtCodProd"];
				$Descripcion=$_POST["txtDescripcion"];
				$PrecioCosto=$_POST["txtPrecioCosto"];
				$Existencia=$_POST["txtExistencia"];
				$nombre_foto=$_FILES['foto']['name'];//Nombre de la foto
				$ruta=$_FILES['foto']['tmp_name'];//ruta o path del archivo
				$foto='fotos/'.$nombre_foto; //ruta y nombre del archivo
				copy ($ruta,$foto);//Guarda archivo en ruta especifica
				$SQL = $MySQLiconexion->query("update tblproducto set CodProd ='$CodProd',Descripcion='$Descripcion',PrecioCosto='$PrecioCosto',Existencia='$Existencia',foto='$foto' where CodProd='$CodProd'");
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
				$CodProd=$_POST["txtCodProd"];
					
				$SQL = $MySQLiconexion->query("delete from tblproducto where CodProd='$CodProd'");
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
<td><input type="text" name="txtCodProbus"/></td>
<td><input type="submit" name="btn1"  value="Buscar"  /></td>
</tr></table>

<table border="0">
<tr>
<td>Codigo de Producto</td>
<td><input type="text" id="txtCodProd" name="txtCodProd" value="<?php echo $CodProd?>" /></td>
</tr>

<tr>
<td>Descripcion</td>
<td><input type="text" name="txtDescripcion"  value="<?php echo $Descripcion?>"/></td>
</tr>
<tr>
<td>PrecioCosto</td>
<td><input type="text" name="txtPrecioCosto"  value="<?php echo $PrecioCosto?>"/></td>
</tr>
<tr>
<td>Existencia</td>
<td><input type="text" name="txtExistencia"  value="<?php echo $Existencia?>"/></td>
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
<td colspan="2"><input type="button" name="btn1" value="Nuevo" onclick="document.getElementById('txtCodProd').focus();"/>
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
			<td bgcolor='gray' style='color:yellow;font-weight: bold'>CodProd</td>
			<td bgcolor='gray' style='color:yellow;font-weight: bold'>Descripcion</td>
			<td bgcolor='gray' style='color:yellow;font-weight: bold'>PrecioCosto</td>
			<td bgcolor='gray' style='color:yellow;font-weight: bold'>Existencia</td>
			<td bgcolor='gray' style='color:yellow;font-weight: bold'>Foto</td>
			</tr>";
			$res = $MySQLiconexion->query("select * from tblproducto");
			while($resul=$res->fetch_array())
			{
				$CodProd=$resul[0];
				$Descripcion=$resul[1];
				$PrecioCosto=number_format($resul[2]);
				$Existencia=$resul[3];
				$foto=$resul[4];
				echo "<tr>
					<td>$CodProd</td>
					<td>$Descripcion</td>
					<td>$PrecioCosto</td>
					<td>$Existencia</td>
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