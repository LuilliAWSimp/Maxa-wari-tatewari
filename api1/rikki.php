<?php
require "config/Conexion.php";
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE");
header("Access-Control-Allow-Headers:Content-Type");
$datos = json_decode(file_get_contents('php://input'), true);
//print_r($_SERVER['REQUEST_METHOD']);
switch ($_SERVER['REQUEST_METHOD']) {
case 'OPTIONS':
    // Habilitar CORS para cualquier origen
header("Access-Control-Allow-Origin: *");

// Permitir métodos HTTP específicos
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE, HEAD, TRACE, PATCH");

// Permitir encabezados personalizados
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// Permitir credenciales
header("Access-Control-Allow-Credentials: true");
   
   if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
       // Responder a la solicitud OPTIONS sin procesar nada más
       http_response_code(200);
       exit;
           break;
   case 'HEAD':
     if ($_SERVER['REQUEST_METHOD'] === 'HEAD') {
       // Establecer encabezados de respuesta
       header('Content-Type: application/json');
       header('Custom-Header: PHP 8, HTML ');
   
       // Puedes establecer otros encabezados necesarios aquí
   
       // No es necesario enviar un cuerpo en una solicitud HEAD, por lo que no se imprime nada aquí.
   } else {
       http_response_code(405); // Método no permitido
       echo 'Método de solicitud no válido';
   }
     break;
   
     case 'TRACE':
       header("Access-Control-Allow-Origin: *");
       if ($_SERVER['REQUEST_METHOD'] === 'TRACE') {
         $response = "Solicitud TRACE recibida. Estado: 200 OK";
     } else {
         $response = "Método de solicitud no válido. Estado: 405 Método no permitido";
     }
     
     echo $response;
       break;
    case 'GET':
    // Verificar si se proporcionó el parámetro 'id_user'
    if (isset($_GET['id_user'])) {
        // Obtener el ID de usuario de la solicitud GET
        $id_user = $_GET['id_user'];

        // Construir la consulta SQL para obtener el usuario por su ID
        $sql = "SELECT id_user, name, email, password FROM usuario WHERE id_user = $id_user";

        // Ejecutar la consulta SQL
        $result = $conexion->query($sql);

        // Verificar si se encontraron resultados
        if ($result->num_rows > 0) {
            // Crear un array para almacenar los datos del usuario
            $data = array();
            
            // Recorrer los resultados y almacenarlos en el array
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            
            // Establecer el tipo de contenido de la respuesta como JSON
            header('Content-Type: application/json');
            
            // Devolver los datos del usuario como JSON
            echo json_encode($data);
        } else {
            // Si no se encontraron resultados para el ID de usuario proporcionado
            echo "No se encontró ningún usuario con el ID proporcionado.";
        }
        // Salir del switch después de manejar la solicitud GET
        exit();
    } else {
        // Si no se proporcionó el parámetro 'id_user', realizar una consulta general
        $sql = "SELECT id_user, name, email, password FROM usuario";
        $query = $conexion->query($sql);

        if ($query->num_rows > 0) {
            $data = array();
            while ($row = $query->fetch_assoc()) {
                $data[] = $row;
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo "No se encontraron registros en la tabla de usuario";
        }
    }
    break;

    case 'PATCH':
        // Obtener los datos de la solicitud PATCH
        parse_str(file_get_contents("php://input"), $datos);

        // Verificar si se proporcionó el id_user y al menos un campo para actualizar
        if (isset($datos['id_user']) && (isset($datos['name']) || isset($datos['email']) || isset($datos['password']))) {
            // Obtener el id_user y los campos para actualizar
            $id_user = $datos['id_user'];
            $name = isset($datos['name']) ? $datos['name'] : null;
            $email = isset($datos['email']) ? $datos['email'] : null;
            $password = isset($datos['password']) ? $datos['password'] : null;

            // Inicializar array de actualizaciones
            $actualizaciones = array();

            // Verificar y agregar los campos a actualizar
            if ($name !== null) {
                $actualizaciones[] = "name = '$name'";
            }
            if ($email !== null) {
                $actualizaciones[] = "email = '$email'";
            }
            if ($password !== null) {
                $actualizaciones[] = "password = '$password'";
            }

            // Verificar si se proporcionaron campos para actualizar
            if (!empty($actualizaciones)) {
                // Construir la cadena de actualizaciones
                $actualizaciones_str = implode(', ', $actualizaciones);

                // Construir la consulta SQL
                $sql = "UPDATE usuario SET $actualizaciones_str WHERE id_user = $id_user";

                // Ejecutar la consulta SQL
                if ($conexion->query($sql) === TRUE) {
                    echo "Registro actualizado con éxito.";
                } else {
                    echo "Error al actualizar registro: " . $conexion->error;
                }
            } else {
                // Si no se proporcionaron campos para actualizar
                echo "No se proporcionaron campos válidos para actualizar.";
            }
        } else {
            // Si no se proporcionó el id_user o no se proporcionaron campos para actualizar
            echo "Faltan parámetros en la solicitud PATCH.";
        }
        break;

    case 'PUT':
        $id_user = $datos['id_user'];
        $name = $datos['name'];
        $email = $datos['email'];
        $password = $datos['password'];

        $sql = "UPDATE usuario SET name = '$name', email = '$email', password = '$password' WHERE id_user = $id_user";

        if ($conexion->query($sql) === TRUE) {
            echo "Registro actualizado con éxito.";
        } else {
            echo "Error al actualizar registro: " . $conexion->error;
        }
        break;
    
            case 'POST':
                // Verificar si se proporcionaron todos los datos necesarios
                if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
                    // Obtener los datos del formulario
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
            
                    // Preparar la consulta SQL para insertar un nuevo usuario
                    $stmt = $conexion->prepare("INSERT INTO usuario (name, email, password) VALUES (?, ?, ?)");
            
                    // Verificar si la preparación de la consulta fue exitosa
                    if ($stmt === false) {
                        echo "Error en la preparación de la consulta: " . $conexion->error;
                        break;
                    }
            
                    // Vincular los parámetros
                    $stmt->bind_param("sss", $name, $email, $password);
            
                    // Ejecutar la consulta
                    if ($stmt->execute()) {
                        echo "Usuario insertado con éxito.";
                    } else {
                        echo "Error al insertar usuario: " . $stmt->error;
                    }
                } else {
                    // Si falta algún dato necesario en el formulario
                    echo "Faltan datos en el formulario.";
                }
                break;
    
    case 'DELETE':
    // Obtener el ID de usuario del arreglo $datos
    $id_user = isset($_GET['id_user']) ? $_GET['id_user'] : null;

    // Verificar si se proporcionó el ID de usuario
    if ($id_user === null) {
        echo "ID de usuario no proporcionado.";
        break; // Sale del switch si el ID de usuario no está presente
    }

    // Preparar la consulta de eliminación
    $stmt = $conexion->prepare("DELETE FROM usuario WHERE id_user = ?");

    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt === false) {
        echo "Error en la preparación de la consulta: " . $conexion->error;
        break;
    }

    // Vincular el parámetro ID de usuario
    $stmt->bind_param("i", $id_user);

    // Ejecutar la consulta de eliminación
    if ($stmt->execute()) {
        echo "Registro eliminado con éxito.";
    } else {
        echo "Error al eliminar registro: " . $stmt->error;
    }
    break;
}
}
?>