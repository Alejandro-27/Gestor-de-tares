<?php include("db.php"); ?>
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
    }
    .form-control-dark {
        background-color: #3a3a3a;
        color: #ffffff;
        border: none;
        border-radius: 5px;
    }
    .form-control-dark:focus {
        background-color: #3a3a3a;
        color: #ffffff;
        border-color: #80bdff;
        box-shadow: 0 0 10px #80bdff;
    }
    .btn-block {
        display: block;
        width: 100%;
        border-radius: 5px;
    }
    .table-dark {
        background-color: #2a2a2a;
        border-radius: 10px;
        overflow: hidden;
    }
    .btn-secondary {
        background-color: #6c757d;
        border: none;
        border-radius: 5px;
    }
    .btn-danger {
        background-color: #dc3545;
        border: none;
        border-radius: 5px;
    }
    .btn-success {
        background-color: #28a745;
        border: none;
        border-radius: 5px;
    }
    .btn-success:hover,
    .btn-secondary:hover,
    .btn-danger:hover {
        filter: brightness(1.2);
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
    .table-hover tbody tr:hover {
        background-color: #444;
    }
    .table-hover tbody tr:hover td {
        box-shadow: 0 0 10px #80bdff;
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
            <div class="col-md-4">
                <?php if (isset($_SESSION['message'])) { ?>
                    <div class="alert alert-success alert-dismissible fade show rgb-light" role="alert">
                        <?= $_SESSION['message'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php session_unset();
                } ?>

                <div class="card card-body rgb-light">
                    <form action="save_task.php" method="POST">
                        <div class="mb-3">
                            <input type="text" name="title" class="form-control form-control-dark" placeholder="Título de la tarea" autofocus required>
                        </div>
                        <div class="mb-3">
                            <textarea name="description" rows="2" class="form-control form-control-dark" placeholder="Descripción de la tarea" required></textarea>
                        </div>
                        <input type="submit" class="btn btn-success btn-block" name="save_task" value="Guardar tarea">
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <table class="table table-bordered table-dark table-hover rgb-light">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>Fecha de creación</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM task";
                        $result_task = mysqli_query($conn, $query);

                        while ($row = mysqli_fetch_assoc($result_task)) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td><?php echo htmlspecialchars($row['description']); ?></td>
                                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                <td>
                                    <a href="edit_task.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary btn-sm">
                                        <i class="fas fa-marker"></i>
                                    </a>
                                    <a href="delete_task.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
