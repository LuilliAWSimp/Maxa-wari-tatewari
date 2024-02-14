<?php
require "config/Conexion.php";
$datos = json_decode(file_get_contents('php://input'), true);
//print_r($_SERVER['REQUEST_METHOD']);
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        // Consulta SQL para seleccionar datos de la tabla de entradas_diario
        $sql = "SELECT id_entrada, id_usuario, titulo, contenido, creado_en FROM entradas_diario";

        $query = $conexion->query($sql);

        if ($query->num_rows > 0) {
            $data = array();
            while ($row = $query->fetch_assoc()) {
                $data[] = $row;
            }
            // Devolver los resultados en formato JSON
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo "No se encontraron registros en la tabla de entradas_diario.";
        }

        $conexion->close();
        break;

    case 'POST':
            // Recibir los datos del formulario HTML
            $id_usuario = $datos['id_usuario'];
            $titulo = $datos['titulo'];
            $contenido = $datos['contenido'];

            // Insertar los datos en la tabla de entradas_diario
            $sql = $conexion->prepare("INSERT INTO entradas_diario (id_usuario, titulo, contenido) VALUES (?,?,?)");
            $sql->bind_param("sss", $id_usuario, $titulo, $contenido);
            if($sql->execute()){
                echo "Datos insertados con exito";
            } else {
                echo "Error al insertar datos" . $sql->error;
            }
        $sql->close();
        break;

        case 'PATCH':
        $id_usuario = $datos['id_usuario'];
        $id_entrada = $datos['id_entrada'];
        $titulo = $datos['titulo'];
        $contenido = $datos['contenido'];
    
        $actualizaciones = array();
        if (!empty($titulo)) {
            $actualizaciones[] = "titulo = '$titulo'";
        }
        if (!empty($contenido)) {
            $actualizaciones[] = "contenido = '$contenido'";
        }
    
        $actualizaciones_str = implode(', ', $actualizaciones);
        $sql = "UPDATE entradas_diario SET $actualizaciones_str WHERE id_entrada = $id_entrada";
    
        if ($conexion->query($sql) === TRUE) {
            echo "Registro actualizado con éxito.";
        } else {
            echo "Error al actualizar registro: " . $conexion->error;
        }
        break;
    

        case 'PUT':
            $id_usuario = $datos['id_usuario'];
            $id_entrada = $datos['id_entrada'];
            $titulo = $datos['titulo'];
            $contenido = $datos['contenido'];
            $sql = "UPDATE entradas_diario SET titulo = '$titulo', contenido = '$contenido' WHERE id_entrada = $id_entrada";
    
            if ($conexion->query($sql) === TRUE) {
                echo "Registro actualizado con éxito.";
            } else {
                echo "Error al actualizar registro: " . $conexion->error;
            }
            break;
    

            case 'DELETE':
                $id_entrada = $datos['id_entrada'];
                
                $stmt = $conexion->prepare("DELETE FROM entradas_diario WHERE id_entrada = ?");
                $stmt->bind_param("i", $id_entrada);
                
                if ($stmt->execute()) {
                    echo "Registro eliminado con éxito.";
                } else {
                    echo "Error al eliminar registro: " . $stmt->error;
                }
                $stmt->close();
                break;
                    
            default:
                echo "Método de solicitud no válido.";
                break;
        }

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
        }
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
          
              case'LINK':
                $apiUrl = 'https://ejemplo.com/tu_endpoint'; // Reemplaza con la URL de tu API
                $resourceUri = '/ruta/a/tu/recurso'; // Reemplaza con la ruta de tu recurso
                $linkHeader = '<' . $resourceUri . '>; rel="link-type"'; // Define el encabezado Link
                
                $options = [
                    'http' => [
                        'method' => 'LINK',
                        'header' => 'Link: ' . $linkHeader,
                    ],
                ];
                
                $context = stream_context_create($options);
                $response = file_get_contents($apiUrl, false, $context);
                
                if ($response === false) {
                    echo "Error al enviar la solicitud LINK.";
                } else {
                    echo "Solicitud LINK exitosa. Respuesta del servidor: " . $response;
                }
                break;
          case 'UNLINK':
              $apiUrl = 'https://ejemplo.com/tu_endpoint'; // Reemplaza con la URL de tu API
              $resourceUri = '/ruta/a/tu/recurso'; // Reemplaza con la ruta de tu recurso
              $linkHeader = '<' . $resourceUri . '>; rel="unlink"'; // Define el encabezado Link
              
              $options = [
                  'http' => [
                      'method' => 'UNLINK',
                      'header' => 'Link: ' . $linkHeader,
                  ],
              ];
              
              $context = stream_context_create($options);
              $response = file_get_contents($apiUrl, false, $context);
              
              if ($response === false) {
                  echo "Error al enviar la solicitud UNLINK.";
              } else {
                  echo "Solicitud UNLINK exitosa. Respuesta del servidor: " . $response;
              }
              break;
          
               default:
                 echo 'undefined request type!';
?>