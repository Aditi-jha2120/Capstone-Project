<?php

session_start();
include("includes/header.php");
include("classes/db_conn.php");
include("classes/user.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(
        empty($_POST["email"]) 
        || empty($_POST["password"]) 
        || empty($_POST["first_name"]) 
        || empty($_POST["last_name"]) 
        
    ) {
        
        header("Location: register.php?msg=error");

    } else {

        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $db_conn = new DatabaseConn();
        $db = $db_conn->get_db_conn();

        $user_obj = new User($db);
        $user = $user_obj->create_user($_POST);

        //
        $_SESSION["user_data"] = $user;

        header("Location: index.php");

    }

}


?>


<!-- Main Content -->

<div class="container my-5">


    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="text-center">
                
                <h2 class="mb-3">Register</h2>

                <?php

                    if(isset($_GET["msg"]) && $_GET["msg"] == "error") {
                    echo '<p class="fw-bold text-danger">All Fields are Required.<p>';
                    }


                ?>
            </div>
            

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="mb-5">

                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name">
                </div>

                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <button type="submit" class="btn btn-dark">Register</button>
            </form>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>