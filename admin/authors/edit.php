<?php
session_start();

require __DIR__ . '../../check_if_user_has_access.php';

require_once __DIR__ . '../../../backend/conection.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Fetch the user information for the given ID
    $sql = 'SELECT * FROM authors WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch a single row
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    header('Location: ../../inde.php');
}

$success = isset($_GET['success']) ? $_GET['success'] : null;

?>
<!DOCTYPE html>
<html>

<head>
    <title>Update Authors</title>
    <meta charset="utf-8" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <!-- Local CSS -->
    <link rel="stylesheet" href="../../css/style.css" />
    <!-- Latest compiled and minified Bootstrap 4.4.1 CSS -->
    <link rel="stylesheet" href="../../css/assets/bootstrap.min.css" />
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- custom font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
    <!-- Latest Font-Awesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous" />
    <script src="https://kit.fontawesome.com/3b2a155ba0.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg--nav px-5 w-100">
            <div class="container">
                <a class="navbar-brand flex mx-lg-auto" href="../../index.php"><img src="../../images/Logo.png" alt="logo image" class="logo d-block mx-auto mb-1">
                    <p class="mb-0 font-weight-bold text-uppercase h6">brainster</p>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class=" mr-auto"></div>
                    <div class="form-inline my-2 my-lg-0">
                        <ul class="navbar-nav mr-auto text-center mx-auto">
                            <li class="nav-item nav--btn mr-lg-4 mb-3 mb-lg-0 mt-3 mt-lg-0">
                                <a class="nav-link" href="#">Sign out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="mt-3 mb-5">
            <a href="../dashboard.php"> Home </a> / <a href="index.php"> Authors </a> / Edit Author
        </div>
        <form class="w-100 mx-auto bg--form p-5 rounded" method="POST" action="update.php">
            <div class="text-center">
                <?php if ($success == 'true') : ?>
                    <h1 style="color: green">Successfully</h1>
                <?php elseif ($success == 'false') : ?>
                    <h1 style="color: red">Something went wrong</h1>
                <?php endif;
                ?>
            </div>
            <h2 class="mb-4 text-center">Edit Author</h2>
            <input type="hidden" name="author_id" value="<?= $userId ?>">
            <div class="form-group">
                <label for="firstname">First name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?= isset($user['firstname']) ? $user['firstname'] : '' ?>">
            </div>
            <div class="form-group">
                <label for="lastname">Last name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?= isset($user['lastname']) ? $user['lastname'] : '' ?>" required>
            </div>
            <div class="form-group">
                <label for="biography">Biography</label>
                <textarea class=form-control name="biography" id="biography" cols="30" rows="5" required><?= isset($user['biography']) ? $user['biography'] : '' ?></textarea>
            </div>
            <div class="justify-content-between d-flex">
                <a class="btn btn-danger text-white" href="./index.php">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>


    <!-- jQuery library -->
    <script src="./js/jquery-3.5.1.min.js"></script>
    <!-- Latest Compiled Bootstrap 4.4.1 JavaScript -->
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
</body>

</html>