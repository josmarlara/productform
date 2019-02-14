<!DOCTYPE html> 
<html>
<head>
<meta http-equiv='content-type' content='text/html; charset=UTF-8'/>
<title>product form</title>

<link rel="stylesheet" type="text/css" href="../css/style.css" />


</head>

<body>
 <a href="producto.php">Buscar producto</a>
 <div class="contenido">
 
 
 <h1>Product Form</h1>
 
 
 <form id="form1" action="index.php" method="post" novalidate enctype="multipart/form-data">
 
 
 <fieldset>
 
 <legend>Introduce los datos  de tu producto en el siguiente formulario</legend>
 
 <label for="nombreProducto">Nombre del producto:</label>
 <input type="text" name="nombreProducto" id="nombreProducto"> 
 <div class="clear"> </div>
 <label for="descripcion">Descripción:</label>
  <textarea rows="10" cols="30" name="descripcion" id="descripcion"></textarea> 
 <div class="clear"> </div>
 <label for="precio">Precio:</label>
 <input type="text" name="precio" id="precio">
 <div class="clear"> </div>
 <label for="imagen">Subir imagen:</label>
 <input type="file" name="imagen" id="imagen" />
 <div class="clear"> </div>
  <input type="submit" class="enviar" name="enviar" id="enviar" value="subir producto" />
 
 </fieldset>

 </form>
 
  </div>

<script src="../js/jquery.js"></script>
<script src="../js/jquery.validate.js"></script>
<script src="../js/additional-methods.js"></script>
<script src="../js/messages_es.js"></script>
<script>

$("#form1").validate({
    rules: {
      nombreProducto: {
        required: true
      },
       descripcion: {
        required: true
       },
       precio: {
        required: true,
        number: true
       },
       imagen: {
    	 required: true,
    	 extension: "png|jpe?g|gif"
       },  
   },
    submitHandler: function(form) {
    	form.submit();

        //alert("producto enviado");
     }
  });




</script>


<?php 
if ( ! empty( $_POST ) ) {
	

	include("config.php");
	
	
	
	
	# Comprovamos que se haya subido un fichero
	if (is_uploaded_file($_FILES["imagen"]["tmp_name"]))
	
	{
	
		# Cogemos la anchura y altura de la imagen
	
		$info=getimagesize($_FILES["imagen"]["tmp_name"]);
	
		//echo "<BR>".$info[0]; //anchura
	
		//echo "<BR>".$info[1]; //altura
	
		$imagenBinaria = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
		
		
		
		
		mysqli_query($obj_conexion," INSERT INTO producto VALUES(null,'".$_POST["nombreProducto"]."','".$_POST["descripcion"]."',".$_POST["precio"].",".$info[0].",".$info[1].",'".$_FILES["imagen"]["type"]."','".$imagenBinaria."') ");
		
		mysqli_close($obj_conexion);
	
	}
	
	
	
	
}




	
	

?>
		








</body>








</html>