<?php
require "config/Conexion.php";
$datos = json_decode(file_get_contents('php://input'), true);


//users//
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $sql = "SELECT id_user, name, email, password FROM usuarios";
        $query = $conexion->query($sql);

        if ($query->num_rows > 0) {
            $data = array();
            while ($row = $query->fetch_assoc()) {
                $data[] = $row;
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo "No se encontraron registros en la tabla de usuarios.";
        }

        $conexion->close();
        break;

    case 'POST':
        $name = $datos['name'];
        $email = $datos['email'];
        $password = $datos['password'];

        $sql = $conexion->prepare("INSERT INTO usuarios (name, email, password) VALUES (?,?,?)");
        $sql->bind_param("sss", $name, $email, $password);

        if ($sql->execute()) {
            echo "Datos insertados con éxito";
        } else {
            echo "Error al insertar datos: " . $sql->error;
        }

        $sql->close();
        break;

    case 'PATCH':
        $id_user = $datos['id_user'];
        $name = $datos['name'];
        $email = $datos['email'];
        $password = $datos['password'];

        $actualizaciones = array();
        if (!empty($name)) {
            $actualizaciones[] = "name = '$name'";
        }
        if (!empty($email)) {
            $actualizaciones[] = "email = '$email'";
        }
        if (!empty($password)) {
            $actualizaciones[] = "password = '$password'";
        }

        $actualizaciones_str = implode(', ', $actualizaciones);
        $sql = "UPDATE usuarios SET $actualizaciones_str WHERE id_user = $id_user";

        if ($conexion->query($sql) === TRUE) {
            echo "Registro actualizado con éxito.";
        } else {
            echo "Error al actualizar registro: " . $conexion->error;
        }
        break;

    case 'PUT':
        $id_user = $datos['id_user'];
        $name = $datos['name'];
        $email = $datos['email'];
        $password = $datos['password'];

        $sql = "UPDATE usuarios SET name = '$name', email = '$email', password = '$password' WHERE id_user = $id_user";

        if ($conexion->query($sql) === TRUE) {
            echo "Registro actualizado con éxito.";
        } else {
            echo "Error al actualizar registro: " . $conexion->error;
        }
        break;

    case 'DELETE':
        $id_user = $datos['id_user'];

        $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id_user = ?");
        $stmt->bind_param("i", $id_user);

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

//diario//

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $sql = "SELECT id_regis, id_habit, id_user, date, archievement FROM diario";
        $query = $conexion->query($sql);

        if ($query->num_rows > 0) {
            $data = array();
            while ($row = $query->fetch_assoc()) {
                $data[] = $row;
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo "No se encontraron registros en la tabla de diario.";
        }

        $conexion->close();
        break;

    case 'POST':
        $id_habit = $datos['id_habit'];
        $id_user = $datos['id_user'];
        $date = $datos['date'];
        $archievement = $datos['archievement'];

        $sql = $conexion->prepare("INSERT INTO diario (id_habit, id_user, date, archievement) VALUES (?,?,?,?)");
        $sql->bind_param("iiss", $id_habit, $id_user, $date, $archievement);

        if ($sql->execute()) {
            echo "Datos insertados con éxito";
        } else {
            echo "Error al insertar datos: " . $sql->error;
        }

        $sql->close();
        break;

    case 'PATCH':
        $id_regis = $datos['id_regis'];
        $id_habit = $datos['id_habit'];
        $id_user = $datos['id_user'];
        $date = $datos['date'];
        $archievement = $datos['archievement'];

        $actualizaciones = array();
        if (!empty($id_habit)) {
            $actualizaciones[] = "id_habit = '$id_habit'";
        }
        if (!empty($id_user)) {
            $actualizaciones[] = "id_user = '$id_user'";
        }
        if (!empty($date)) {
            $actualizaciones[] = "date = '$date'";
        }
        if (!empty($archievement)) {
            $actualizaciones[] = "archievement = '$archievement'";
        }

        $actualizaciones_str = implode(', ', $actualizaciones);
        $sql = "UPDATE diario SET $actualizaciones_str WHERE id_regis = $id_regis";

        if ($conexion->query($sql) === TRUE) {
            echo "Registro actualizado con éxito.";
        } else {
            echo "Error al actualizar registro: " . $conexion->error;
        }
        break;

    case 'PUT':
        $id_regis = $datos['id_regis'];
        $id_habit = $datos['id_habit'];
        $id_user = $datos['id_user'];
        $date = $datos['date'];
        $archievement = $datos['archievement'];

        $sql = "UPDATE diario SET id_habit = '$id_habit', id_user = '$id_user', date = '$date', archievement = '$archievement' WHERE id_regis = $id_regis";

        if ($conexion->query($sql) === TRUE) {
            echo "Registro actualizado con éxito.";
        } else {
            echo "Error al actualizar registro: " . $conexion->error;
        }
        break;

    case 'DELETE':
        $id_regis = $datos['id_regis'];

        $stmt = $conexion->prepare("DELETE FROM diario WHERE id_regis = ?");
        $stmt->bind_param("i", $id_regis);

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

//habits//
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $sql = "SELECT id_habit, id_user, nombre, tipo, descripcion FROM habits";
        $query = $conexion->query($sql);

        if ($query->num_rows > 0) {
            $data = array();
            while ($row = $query->fetch_assoc()) {
                $data[] = $row;
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo "No se encontraron registros en la tabla de habits.";
        }

        $conexion->close();
        break;

    case 'POST':
        $id_user = $datos['id_user'];
        $nombre = $datos['nombre'];
        $tipo = $datos['tipo'];
        $descripcion = $datos['descripcion'];

        $sql = $conexion->prepare("INSERT INTO habits (id_user, nombre, tipo, descripcion) VALUES (?,?,?,?)");
        $sql->bind_param("isss", $id_user, $nombre, $tipo, $descripcion);

        if ($sql->execute()) {
            echo "Datos insertados con éxito";
        } else {
            echo "Error al insertar datos: " . $sql->error;
        }

        $sql->close();
        break;

    case 'PATCH':
        $id_habit = $datos['id_habit'];
        $id_user = $datos['id_user'];
        $nombre = $datos['nombre'];
        $tipo = $datos['tipo'];
        $descripcion = $datos['descripcion'];

        $actualizaciones = array();
        if (!empty($id_user)) {
            $actualizaciones[] = "id_user = '$id_user'";
        }
        if (!empty($nombre)) {
            $actualizaciones[] = "nombre = '$nombre'";
        }
        if (!empty($tipo)) {
            $actualizaciones[] = "tipo = '$tipo'";
        }
        if (!empty($descripcion)) {
            $actualizaciones[] = "descripcion = '$descripcion'";
        }

        $actualizaciones_str = implode(', ', $actualizaciones);
        $sql = "UPDATE habits SET $actualizaciones_str WHERE id_habit = $id_habit";

        if ($conexion->query($sql) === TRUE) {
            echo "Registro actualizado con éxito.";
        } else {
            echo "Error al actualizar registro: " . $conexion->error;
        }
        break;

    case 'PUT':
        $id_habit = $datos['id_habit'];
        $id_user = $datos['id_user'];
        $nombre = $datos['nombre'];
        $tipo = $datos['tipo'];
        $descripcion = $datos['descripcion'];

        $sql = "UPDATE habits SET id_user = '$id_user', nombre = '$nombre', tipo = '$tipo', descripcion = '$descripcion' WHERE id_habit = $id_habit";

        if ($conexion->query($sql) === TRUE) {
            echo "Registro actualizado con éxito.";
        } else {
            echo "Error al actualizar registro: " . $conexion->error;
        }
        break;

    case 'DELETE':
        $id_habit = $datos['id_habit'];

        $stmt = $conexion->prepare("DELETE FROM habits WHERE id_habit = ?");
        $stmt->bind_param("i", $id_habit);

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

//stats//

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $sql = "SELECT id_stat, id_user, date, stat FROM stats";
        $query = $conexion->query($sql);

        if ($query->num_rows > 0) {
            $data = array();
            while ($row = $query->fetch_assoc()) {
                $data[] = $row;
            }
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            echo "No se encontraron registros en la tabla de stats.";
        }

        $conexion->close();
        break;

    case 'POST':
        $id_user = $datos['id_user'];
        $date = $datos['date'];
        $stat = $datos['stat'];

        $sql = $conexion->prepare("INSERT INTO stats (id_user, date, stat) VALUES (?,?,?)");
        $sql->bind_param("iss", $id_user, $date, $stat);

        if ($sql->execute()) {
            echo "Datos insertados con éxito";
        } else {
            echo "Error al insertar datos: " . $sql->error;
        }

        $sql->close();
        break;

    case 'PATCH':
        $id_stat = $datos['id_stat'];
        $id_user = $datos['id_user'];
        $date = $datos['date'];
        $stat = $datos['stat'];

        $actualizaciones = array();
        if (!empty($id_user)) {
            $actualizaciones[] = "id_user = '$id_user'";
        }
        if (!empty($date)) {
            $actualizaciones[] = "date = '$date'";
        }
        if (!empty($stat)) {
            $actualizaciones[] = "stat = '$stat'";
        }

        $actualizaciones_str = implode(', ', $actualizaciones);
        $sql = "UPDATE stats SET $actualizaciones_str WHERE id_stat = $id_stat";

        if ($conexion->query($sql) === TRUE) {
            echo "Registro actualizado con éxito.";
        } else {
            echo "Error al actualizar registro: " . $conexion->error;
        }
        break;

    case 'PUT':
        $id_stat = $datos['id_stat'];
        $id_user = $datos['id_user'];
        $date = $datos['date'];
        $stat = $datos['stat'];

        $sql = "UPDATE stats SET id_user = '$id_user', date = '$date', stat = '$stat' WHERE id_stat = $id_stat";

        if ($conexion->query($sql) === TRUE) {
            echo "Registro actualizado con éxito.";
        } else {
            echo "Error al actualizar registro: " . $conexion->error;
        }
        break;

    case 'DELETE':
        $id_stat = $datos['id_stat'];

        $stmt = $conexion->prepare("DELETE FROM stats WHERE id_stat = ?");
        $stmt->bind_param("i", $id_stat);

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

?>
