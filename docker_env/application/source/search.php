<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="stylesheet" href="./search.css">

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
        <div id="myform" class="searchbar">
            <label class="search_label" for="search_input">Search :</label>
            <input id="search_input" class="search_input" type="text" name="search" onkeypress="clickPress(event)">
            <button id="btn_search" aria-label="search" class="search_icon"><i class="fas fa-search"></i></button>
        </div>
    </div>
</header>
<main class="container">
    <div class="">
        <div id="switch" class="">
            <div id="filters" class="">
                <ul class="d-flex flex-wrap">
                    <li>
                        <form id="switch_ctrl" class="d-flex justify-content-center">
                            <p id="filterText" class="align-self-center px-2 text-light">Find by :</p>
                            <button type="button" id="findPlaylist" class="find">Playlist</button>
                            <button type="button" id="findCategory" class="find">Category</button>
                            <button type="button" id="findYear" class="find">Year</button>
                        </form>
                    </li>
                    <!-- Playlist buttons -->
                    <li>
                        <button type="button" id="nowPlay" class="playlist">Now playing</button>
                    </li>
                    <li>
                        <button type="button" id="trending" class="playlist">Trending</button>
                    </li>
                    <li>
                        <button type="button" id="upcoming" class="playlist">Upcoming</button>
                    </li>
                    <li>
                        <button type="button" id="popular" class="playlist">Popular</button>
                    </li>
                    <li>
                        <button type="button" id="topRated" class="playlist">Top Rated</button>
                    </li>
                    <!-- Category buttons -->
                    <li>
                        <button type="button" id="action" class="cat d-none" value=28>Action</button>
                    </li>
                    <li>
                        <button type="button" id="adventure" class="cat d-none" value=12>Adventure</button>
                    </li>
                    <li>
                        <button type="button" id="animation" class="cat d-none" value=16>Animation</button>
                    </li>
                    <li>
                        <button type="button" id="comedy" class="cat d-none" value=35>Comedy</button>
                    </li>
                    <li>
                        <button type="button" id="crime" class="cat d-none" value=80>Crime</button>
                    </li>
                    <li>
                        <button type="button" id="documentary" class="cat d-none" value=99>Documentary</button>
                    </li>
                    <li>
                        <button type="button" id="drama" class="cat d-none" value=18>Drama</button>
                    </li>
                    <li>
                        <button type="button" id="family" class="cat d-none" value=10751>Family</button>
                    </li>
                    <li>
                        <button type="button" id="fantasy" class="cat d-none" value=14>Fantasy</button>
                    </li>
                    <li>
                        <button type="button" id="history" class="cat d-none" value=36>History</button>
                    </li>
                    <li>
                        <button type="button" id="horror" class="cat d-none" value=27>Horror</button>
                    </li>
                    <li>
                        <button type="button" id="music" class="cat d-none" value=10402>Music</button>
                    </li>
                    <li>
                        <button type="button" id="mystery" class="cat d-none" value=9648>Mystery</button>
                    </li>
                    <li>
                        <button type="button" id="romance" class="cat d-none" value=10749>Romance</button>
                    </li>
                    <li>
                        <button type="button" id="sf" class="cat d-none" value=878>SF</button>
                    </li>
                    <li>
                        <button type="button" id="tv" class="cat d-none" value=10770>TV Movie</button>
                    </li>
                    <li>
                        <button type="button" id="thriller" class="cat d-none" value=53>Thriller</button>
                    </li>
                    <li>
                        <button type="button" id="war" class="cat d-none" value=10752>War</button>
                    </li>
                    <li>
                        <button type="button" id="western" class="cat d-none" value=37>Western</button>
                    </li>
                    <!-- Year buttons -->
                    <li>
                        <button type="button" class="year d-none" id="2021">2021</button>
                    </li>
                    <li>
                        <button type="button" class="year d-none" id="2020">2020</button>
                    </li>
                    <li>
                        <button type="button" class="year d-none" id="2019">2019</button>
                    </li>
                    <li>
                        <button type="button" class="year d-none" id="2018">2018</button>
                    </li>
                    <li>
                        <button type="button" class="year d-none" id="2017">2017</button>
                    </li>
                    <li>
                        <button type="button" class="year d-none" id="2016">2016</button>
                    </li>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
        crossorigin="anonymous"></script>


</html>