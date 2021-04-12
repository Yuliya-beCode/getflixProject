<?php
    session_start();
?>

<?php include('header.php'); ?>



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
<!--search functions-->
<script src="js/search.js"></script>


<?php include('footer.php'); ?>