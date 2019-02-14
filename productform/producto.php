<!DOCTYPE html> 
<html>
<head>
<meta http-equiv='content-type' content='text/html; charset=UTF-8'/>
<title>product form</title>

<link rel="stylesheet" type="text/css" href="../css/style.css" />


</head>

<body>
 <a href="index.php">Agregar Producto</a>
 <div class="contenido">
 
 
 <h1>Product Form</h1>
 
 
 <form id="form1" action="producto.php" method="post" novalidate enctype="multipart/form-data">
 
 
 <fieldset>
 
 <legend>Buscar producto</legend>
 
 <label for="nombreProducto">Buscar:</label>
 <input type="text" name="producto" id="producto" size="70"> 
 <input type="submit" class="buscar" name="buscar" id="buscar" value="buscar"/>
 
 </fieldset>
 
 </form>
 
  </div>


 <div class="paging"></div>


<?php 
if ( ! empty( $_POST ) ) {
	

	include("config.php");
	
	
	$results = $obj_conexion->query("SELECT * FROM producto WHERE nombreProducto LIKE '%".$_POST["producto"]."%'");
	while($row = $results->fetch_array()){
		?>
		
		<div class="element">
		 <hr>
		 <table>
		 <tr>
		 
		 <td>
		 <img src="data:<?php echo $row['tipoImagen']; ?>;base64,<?php echo base64_encode($row['imagen']); ?>" height="160" width="213" /><br>
		 
		 </td>
		 
		 <td>
		  ID Producto: <?php echo $row['idproducto']; ?><br>
		 Producto: <?php echo $row['nombreProducto']; ?><br>
		 Descripción: <?php echo $row['descripcion']; ?><br>
		 Precio: $<?php echo $row['precio']; ?><br>
		 </td>
		 
		 
		 </tr>
		 
		 
		 </table>
		 
		<hr>
		 
		
		</div>
			
	<?php	
	
	}
	
	
	
	
	
	
}
?>
 <div class="paging"></div>
		

       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
        <script src="../js/jquery.ba-hashchange.js"></script>
        <script src="../js/jquery.paging.min.js"></script>
        <script>

            /*
             * Slicing the content with two pagers and using the URL Hash event
             */
            (function() {

                var prev = {
                    start: 0,
                    stop: 0
                };


                var content = $('.element');

                var Paging = $(".paging").paging(content.length, {
                    onSelect: function() {

                        var data = this.slice;

                        content.slice(prev[0], prev[1]).css('display', 'none');
                        content.slice(data[0], data[1]).fadeIn("slow");

                        prev = data;

                        return true; // locate!
                    },
                    onFormat: function(type) {

                        switch (type) {

                            case 'block':

                                if (!this.active)
                                    return '<span class="disabled">' + this.value + '</span>';
                                else if (this.value != this.page)
                                    return '<em><a href="#' + this.value + '">' + this.value + '</a></em>';
                                return '<span class="current">' + this.value + '</span>';

                            case 'right':
                            case 'left':

                                if (!this.active) {
                                    return '';
                                }
                                return '<a href="#' + this.value + '">' + this.value + '</a>';

                            case 'next':

                                if (this.active) {
                                    return '<a href="#' + this.value + '" class="next">Next &raquo;</a>';
                                }
                                return '<span class="disabled">Next &raquo;</span>';

                            case 'prev':

                                if (this.active) {
                                    return '<a href="#' + this.value + '" class="prev">&laquo; Previous</a>';
                                }
                                return '<span class="disabled">&laquo; Previous</span>';

                            case 'first':

                                if (this.active) {
                                    return '<a href="#' + this.value + '" class="first">|&lt;</a>';
                                }
                                return '<span class="disabled">|&lt;</span>';

                            case 'last':

                                if (this.active) {
                                    return '<a href="#' + this.value + '" class="prev">&gt;|</a>';
                                }
                                return '<span class="disabled">&gt;|</span>';

                            case 'fill':
                                if (this.active) {
                                    return "...";
                                }
                        }
                        return ""; // return nothing for missing branches
                    },
                    format: '[< ncnnn! >]',
                    perpage: 3,
                    lapping: 0,
                    page: null // we await hashchange() event
                });


                $(window).hashchange(function() {

                    if (window.location.hash)
                        Paging.setPage(window.location.hash.substr(1));
                    else
                        Paging.setPage(1); // we dropped "page" support and need to run it by hand
                });

                $(window).hashchange();
            })();
        </script>




</body>



</html>