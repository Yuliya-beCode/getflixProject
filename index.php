<?php include 'header.php'; ?>
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
                    <li>
                        <button type="button" id="trending" class="active">Trending</button>
                    </li>
                    <li>
                        <button type="button" id="topPopular" class="">Most Popular</button>
                    </li>
                    <li>
                        <button type="button" id="topRated" class="">Top Rated</button>
                    </li>
                    <li>
                        <button type="button" id="action" class="">Action</button>
                    </li>
                    <li>
                        <button type="button" id="comedy" class="">Comedy</button>
                    </li>
                    <li>
                        <button type="button" id="horror" class="">Horror</button>
                    </li>
                    <li>
                        <button type="button" id="romantic" class="">Romantic</button>
                    </li>
                    <li>
                        <button type="button" id="docs" class="">Documentary</button>
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/770384ac45.js" crossorigin="anonymous"></script>
<script src="js/search.js">
</script>

<?php require 'footer.php'; ?>