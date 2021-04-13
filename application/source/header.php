<!DOCTYPE html>
<html lang="en">
<?php $curPage = basename($_SERVER['PHP_SELF']); ?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" href="./pictures/Logo.png" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="<?php if ($curPage == '404.php') echo 'bg-404' ;?>"  >
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container-fluid">
                <img id="logo" src="pictures/Logo.png" alt="logo" srcset="" width="75px">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">Welcome Page</a>
                        </li>
                        <?php if (isset($_SESSION['auth'])) : ?>

                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="logout.php">Log Out</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="account.php">Profils</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="admin.php">Admin</a>
                            </li>

                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="register.php">Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="login.php">Log in</a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </div>
                
                <?php if ($curPage != 'index.php') { ?>
                    <div class="d-flex justify-content-end">
                        <form id="searchbarhead" class="searchbar" method="get" action="search.php">
                            <label class="search_label" for="search_input">Search</label>
                            <input id="search_input" class="search_input" type="text" name="search" onkeypress="clickPress(event)">
                            <button id="btn_search" type="submit" aria-label="search" class="search_icon"><i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                <?php } ?>

                
            </div>
        </nav>

    </header>


    <div class="container">

        <?php if (isset($_SESSION['flash'])) : ?>
            <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
                <div class="alert alert-<?= $type; ?>">
                    <?= $message; ?>
                </div>
            <?php endforeach; ?>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>
    </div>