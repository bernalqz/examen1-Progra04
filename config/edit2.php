<?php
    //Recepción de los datos del formulario
    $Nombre = $_POST['nombre'];
    $Cedula = $_POST['cedula'];
    $PrimerNota = $_POST['nota1'];
    $SegundaNota = $_POST['nota2'];
    $TercerNota = $_POST['nota3'];
    $id = $_POST['id'];

    $Promedio = ($PrimerNota + $SegundaNota + $TercerNota) / 3;
    
    if($Promedio >= 70)
    {
        $Condicion = "Aprobado";
    }
    else
    {
        $Condicion = "Reprobado";
    }

    $Server = "localhost";
	$User = "root";
	$Password = "Admin";
	$BD = "examen01";

	$conexion = new mysqli ($Server, $User, $Password, $BD);

	if ($conexion -> connect_error)
	{
		die("Conexión Fallida".$conexion -> connect_error);
		echo "No se puedo conectar a la base de datos";
	}
    else
    {
        $sql = "UPDATE estudiantes set  Nombre ='$Nombre', Cedula= '$Cedula', PrimerNota ='$PrimerNota', SegundaNota='$SegundaNota', TercerNota='$TercerNota', Promedio='$Promedio' WHERE id=$id";

        if ($conexion->query($sql)===true) 
        {
            print("
                <script>
                    setTimeout(mensaje,1000);
                    function mensaje(){
                        window.alert('Datos agregados');
                    }
                </script>"
            );
            HEADER("Location: ../exam.php");
        }
        else
        {
            die("Error al ingresar datos: ".$conexion->error);
        }   
    }

?>