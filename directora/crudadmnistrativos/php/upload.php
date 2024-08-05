<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$servername = "localhost";
$username = "root";
$password = "2017452071";
$dbname = "controldeacceso";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $fileName = $_FILES['file']['tmp_name'];

    try {
        $spreadsheet = IOFactory::load($fileName);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray();

        foreach ($data as $row) {
            $username = $row[0];
            $nombre = $row[1];
            $apellido = $row[2];
            $email = $row[3];
            $password_hash = password_hash($row[4], PASSWORD_BCRYPT);

            $sql = "INSERT INTO usuarios (username, nombre, apellido, email, password_hash) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $username, $nombre, $apellido, $email, $password_hash);
            $stmt->execute();
        }

        header('Location: ../index.html');
        exit();
    } catch (Exception $e) {
        die('Error al procesar el archivo: ' . $e->getMessage());
    }
}

$conn->close();
?>
