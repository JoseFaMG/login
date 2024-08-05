<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../php/login.php');
    exit();
}

// Mostrar todos los errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$servername = "localhost";
$username = "root";
$password = "2017452071";
$dbname = "controldeacceso";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file']['tmp_name'];

    if (!file_exists($file)) {
        die("El archivo no se ha subido correctamente.");
    }

    try {
        $spreadsheet = IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();

        for ($row = 2; $row <= $highestRow; $row++) {
            $matricula = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
            $nombre = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
            $cuatrimestre = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
            $correo = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
            $estado = $worksheet->getCellByColumnAndRow(5, $row)->getValue();

            // Validación de datos
            if (empty($matricula) || empty($nombre) || empty($cuatrimestre) || empty($correo) || empty($estado)) {
                echo "Datos incompletos en la fila $row, saltando.<br>";
                continue; // Saltar filas con datos incompletos
            }

            // Verificar duplicados
            $sql = "SELECT COUNT(*) AS count FROM alumnos WHERE matricula = ? OR nombre = ? OR correo = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $matricula, $nombre, $correo);
            $stmt->execute();
            $result = $stmt->get_result();
            $countRow = $result->fetch_assoc();

            if ($countRow['count'] == 0) {
                // Insertar datos en la base de datos
                $sql = "INSERT INTO alumnos (matricula, nombre, cuatrimestre, correo, estado) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                if (!$stmt) {
                    die("Error en la preparación del statement: " . $conn->error);
                }
                $stmt->bind_param("ssiss", $matricula, $nombre, $cuatrimestre, $correo, $estado);
                if (!$stmt->execute()) {
                    echo "Error al agregar el alumno: " . $stmt->error . "<br>";
                }
            } else {
                echo "Alumno duplicado no agregado: $nombre ($matricula)<br>";
            }

            $stmt->close();
        }

        echo "Carga de archivo completada";
        header('Location: alumnos.php');
        exit();
    } catch (Exception $e) {
        die('Error al procesar el archivo: ' . $e->getMessage());
    }
}

// Cerrar la conexión
$conn->close();

