<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Suma Handmade Ceramics</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.css">
    

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <style>
        
        :root{
            --bs-body-font-family: "Libre Franklin", sans-serif; 
        }
        
        body {
            padding-top: 56px;
        }

        .banner {
            background: linear-gradient(rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.45)), url("images/banner.jpg");
            background-size: cover;
            color: #fff;
            background-position: center;
            text-align: center;
            padding: 190px 0;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            text-align: center;
        }
        

        .card img {
            object-fit: cover;
            height: 320px !important;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: none;
            border-color: #000;
        }



    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top py-3">
        <div class="container">
            <a class="navbar-brand border border-2 px-2 py-1 fs-6" style="letter-spacing: 0.1rem;" href="/">Suma Handmade Ceramics</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-nav"
                aria-controls="navbar-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbar-nav">

                <form method="GET" action="products.php" class="input-group px-lg-5 mt-3 mt-lg-0">
                    <input type="search" class="form-control" placeholder="Search" name="search">
                    <button class="btn btn-success" type="button">
                    <svg class="text-white" width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>

                    </button>
                </form>
            
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="learning.php">Learning</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>

                    <?php if(isset($_SESSION["user_data"])): ?>

                        <div class="dropdown">
                            
                            <button class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown"
                             aria-expanded="false">
                                <?php echo $_SESSION['user_data']['first_name']; ?>
                            </button>
                            
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="account.php">My Account</a></li>
                                <li><a class="dropdown-item" href="logout.php?logout_user=1">Logout</a></li>
                            </ul>
                        </div>


                    <?php else: ?>

                        
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>
                        

                   <?php endif; ?>

                </ul>

            </div>
        </div>
    </nav>