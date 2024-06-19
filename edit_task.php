<?php
include("db.php");

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM task WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $title = $row['title'];
        $description = $row['description'];
    }
}

if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $query = "UPDATE task SET title = '$title', description = '$description' WHERE id = $id";
    mysqli_query($conn, $query);

    $_SESSION['message'] = 'Tarea actualizada correctamente';
    $_SESSION['message_type'] = 'warning';
    header("Location: index.php");
    exit();
}
?>

<?php include("includes/header.php"); ?>

<style>
    body {
        background-color: #1a1a1a;
        color: #ffffff;
        font-family: 'Arial', sans-serif;
        height: 100vh;
        margin: 0;
        display: flex;
        flex-direction: column;
    }
    .header-container {
        text-align: center;
        margin: 20px 0;
    }
    .main-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-grow: 1;
    }
    .card {
        background-color: #2a2a2a;
        border: none;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        transition: box-shadow 0.3s ease-in-out;
    }
    .card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
    }
    .form-control-dark {
        background-color: #343a40;
        color: #ffffff;
        border: none;
        border-radius: 5px;
    }
    .form-control-dark:focus {
        background-color: #343a40;
        color: #ffffff;
        border-color: #80bdff;
        box-shadow: 0 0 10px #80bdff;
    }
    .btn-block {
        display: block;
        width: 100%;
        border-radius: 5px;
    }
    .rgb-light {
        animation: rgb-fade 3s infinite;
    }
    @keyframes rgb-fade {
        0% { box-shadow: 0 0 15px #ff0000; }
        33% { box-shadow: 0 0 15px #00ff00; }
        66% { box-shadow: 0 0 15px #0000ff; }
        100% { box-shadow: 0 0 15px #ff0000; }
    }
    .form-control::placeholder {
        color: #d3d3d3;
        opacity: 1;
    }
    .form-control:-ms-input-placeholder {
        color: #d3d3d3;
    }
    .form-control::-ms-input-placeholder {
        color: #d3d3d3;
    }
    textarea {
        color: #ffffff !important;
    }
</style>

<div class="header-container">

</div>

<div class="main-container">
    <div class="container p-4">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="card bg-dark text-white rgb-light">
                    <div class="card-body">
                        <h5 class="card-title">Actualizar Tarea</h5>
                        <form action="edit_task.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" method="POST">
                            <div class="mb-3">
                                <label for="title" class="form-label">Título</label>
                                <input type="text" name="title" class="form-control form-control-dark" id="title" value="<?php echo htmlspecialchars($title); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Descripción</label>
                                <textarea name="description" class="form-control form-control-dark" id="description" rows="3" required><?php echo htmlspecialchars($description); ?></textarea>
                            </div>
                            <button type="submit" name="update" class="btn btn-success btn-block">
                                <i class="fas fa-save"></i> Actualizar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
