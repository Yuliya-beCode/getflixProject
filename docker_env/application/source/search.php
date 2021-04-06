<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <link rel="stylesheet" href="search.css">
    <title>Movie Search module</title>
</head>

<body>

<nav class="navbar navbar-dark bg-dark d-flex justify-content-around">
    <!-- Navbar content -->
    <img id="logo" src="pictures/Logo.png" alt="logo" srcset="">
    <a href="index.php" style="color:white;">Welcome Page</a>
    <a href="register.php" style="color:white;">Register</a>
    <a href="login.php" style="color:white;">Log in</a>
    <a href="logout.php" style="color:white;">Log out</a>
</nav>

    <header class="container">
        <div class="d-flex justify-content-end">
            <div class="searchbar">
                <label class="search_label" for="search">Search :</label>
                <input id="search_input" class="search_input" type="text" name="search" placeholder="">
                <button id="btn_search" class="search_icon"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </header>
    <main class="container">
        <div class="">

            <div id="switch" class="">
                <div id="filters" class="">
                    <ul class="d-flex flex-wrap">
                        <li>
                            <div id="switch_ctrl" class="d-flex justify-content-center">
                                <p class="align-self-center px-2 text-light">Filter by :</p>
                                <button type="button" id="" class="active">Top</button>
                                <button type="button" id="" class="">Categories</button>
                                <button type="button" id="" class="">Year</button>
                            </div>
                        </li>
                        <li><button type="button" id="trending" class="active">Trending</button></li>
                        <li><button type="button" id="topPopular" class="">Most Popular</button></li>
                        <li><button type="button" id="topRated" class="">Top Rated</button></li>
                        <li><button type="button" id="action" class="">Action</button></li>
                        <li><button type="button" id="comedy" class="">Comedy</button></li>
                        <li><button type="button" id="horror" class="">Horror</button></li>
                        <li><button type="button" id="romantic" class="">Romantic</button></li>
                        <li><button type="button" id="docs" class="">Documentary</button></li>
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <p id="result" class="text-white">Movies</p>
            </div>
        </div>
        <div id="movies">
        </div>
    </main>
</body>
<!--search functions-->
<script src="js/search.js"></script>
<!-- Font Awesome JS -->
<script src="https://kit.fontawesome.com/770384ac45.js" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
    integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
</script>

</html>