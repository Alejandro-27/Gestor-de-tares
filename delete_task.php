<?php
include("db.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM task WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Error al eliminar");
    }
    $_SESSION['message'] = 'La terea se eliminóm correctamente';
    $_SESSION['message_type'] = 'danger';
    header("Location: index.php");
}
