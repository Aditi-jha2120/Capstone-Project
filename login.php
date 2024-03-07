<?php

session_start();

include("includes/header.php");
include("classes/db_conn.php");
include("classes/user.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(empty($_POST["email"]) || empty($_POST["password"])) {

        header("Location: login.php?msg=error");

    } else {

        $email = $_POST["email"];
        $password = $_POST["password"];

        $db_conn = new DatabaseConn();
        $db = $db_conn->get_db_conn();

        $user = new User($db);
        $user_data = $user->find_user($_POST);

        
        
        if ($user_data) {
    
            $_SESSION["user_data"] = $user_data;
            header("Location: index.php");

        } else {

            header("Location: login.php?msg=invalid");

        }

    }

}



?>


<!-- Main Content -->

<div class="container mb-5 pb-5p">


    <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-md-6">


            <div class="text-center">

                <h2 class="mb-3">Login</h2>

                <?php

                    if(isset($_GET["msg"]) && $_GET["msg"] == "error") {
                        echo '<p class="fw-bold text-danger">All Fields are Required.<p>';
                    }
                    
                ?>

                <?php

                    if(isset($_GET["msg"]) && $_GET["msg"] == "invalid") {
                        echo '<p class="fw-bold text-danger">Email or Password is Incorrect.<p>';
                    }

                ?>

            </div>


            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <button type="submit" class="btn btn-dark">Login</button>

            </form>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>