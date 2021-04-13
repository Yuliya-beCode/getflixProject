<?php

session_start();
require_once('db.php');
?>
<?php
if (!isset($_GET['movie']) or $_GET['movie'] == '') {
    header('Location: search.php');
}
// API DOCS: https://developers.themoviedb.org/3/movies/get-movie-videos
// GET MOVIE INFO: https://api.themoviedb.org/3/movie/791373?api_key=04c35731a5ee918f014970082a0088b1&language=en-US
$domain = 'https://api.themoviedb.org';
$API_KEY = '04c35731a5ee918f014970082a0088b1';
$video_key = false;
$id = $_GET['movie'];

//get information from https://api.themoviedb.org/3/movie/791373/videos?api_key=04c35731a5ee918f014970082a0088b1&language=en-US
$c = curl_init($domain . '/3/movie/' . $id . '/videos?api_key=' . $API_KEY . '&language=en-US');

// return in the version of string
// true> get the value of the request
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

//string to json
$response = json_decode(curl_exec($c));

//control if the request got successfully
if ($response->success !== false) $video_key = $response->results[0]->key;

// getting info of the movie from https://api.themoviedb.org/3/movie/587807?api_key=04c35731a5ee918f014970082a0088b1&language=en-US
$c_info = curl_init($domain . '/3/movie/' . $id . '?api_key=' . $API_KEY . '&language=en-US');
curl_setopt($c_info, CURLOPT_RETURNTRANSFER, true);
$response_info = json_decode(curl_exec($c_info));

date_default_timezone_set("Europe/Brussels");

if (!$response_info->title) {
    header('Location: 404.php');
} else { ?>



    <?php include('header.php'); ?>

    <main class="container-md">
        <div class="row g-3">
            <div class="col-lg-6">
                <div class="bg-white rounded-2">
                    <div class="p-3 bg-light bg-gradient border-bottom movie-title">
                        <h5>Video window</h5>
                    </div>
                    <div class="p-3">
                        <figure>
                            <?php
                            if ($video_key !== false && $video_key !== null)
                                echo '<div class="video-responsive"><iframe width="560" height="315" src="https://www.youtube.com/embed/' . $video_key . '"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe></div>';
                            else echo '<h4 class="text-danger">No video</h4>';
                            ?>
                        </figure>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="bg-white rounded-2">
                    <div class="p-3 bg-light bg-gradient border-bottom">
                        <h5>Video description</h5>
                    </div>
                    <div class="p-3 movie-info">
                        <h4><strong><?php echo $response_info->title ?></strong></h4>

                        <p><i class="fa fa-clock-o"></i> <b>Release date</b> <?php echo $response_info->release_date ?></p>

                        <p><i class="fa fa-clock-o"></i>
                            <a href="<?php echo $response_info->homepage ?>" target="_blank"><b>Homepage</b></a>
                        </p>

                        <h5>Genres:</h5>
                        <ul><?php foreach ($response_info->genres as $item) {
                                echo '<li>' . $item->name . '</li>';
                            } ?></ul>

                        <p>
                            <?php echo $response_info->overview ?>
                        </p>
                    </div>
                    <!-- Comment section -->

                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="bg-white rounded-2">
                <div class="p-3 bg-light bg-gradient border-bottom">
                    <h5>Comments</h5>
                </div>
                <?php
                include('info_comments.php');
                ?>
            </div>
        </div>
    </main>

<?php
} ?>
<!--footer-->

<!-- Grid container -->
<div class="md-container bg-dark text-around text-white mt-5 py-3">
    <!-- Section: Social media -->

    <div class="col-sm justify-content-center align-items-center text-center">
        <a href="https://github.com/Lord-of-Chicken" class="col-sm-12 col-lg-3 my-2 text-white">
            <i class="fab fa-github"></i>Lord-of-Chicken</a>
        <a href="https://github.com/gonzalovsilva" class="col-sm-12 col-lg-3 my-2 text-white">
            <i class="fab fa-github"></i>gonzalovsilva</a>
        <a href="https://github.com/robbertklockaerts" class="col-sm-12 col-lg-3 my-2 text-white">
            <i class="fab fa-github"></i>robbertklockaerts</a>
        <a href="https://github.com/Yuliya-beCode" class="col-sm-12 col-lg-3 my-2 text-white">
            <i class="fab fa-github"></i>Yuliya-beCode</a>
    </div>


    <div class="col-sm d-flex flex-column align-items-center justify-content-center mt-3">
        <img class="navbar-brand" src="https://www.themoviedb.org/assets/2/v4/logos/v2/blue_square_1-5bdc75aaebeb75dc7ae79426ddd9be3b2be1e342510f8202baf6bffa71d7f5c4.svg" alt="">
        <p class="text-muted text-center">This product uses the TMDb API but is not endorsed or certified by
            TMDb
        </p>
    </div>

    <!-- Copyright -->
    <div class="col-sm pt-2 d-flex justify-content-center">
        <a href="https://github.com/Yuliya-beCode/getflixProject"><i class="fab fa-github"></i></a>
        <a class="text-white ms-3 d-block" href="https://mdbootstrap.com/">The Theater copyright© 2021</a>
    </div>
</div>
<!-- Copyright -->

<!--search functions-->
<?php if ($curPage == 'search.php') { ?>
    <script src="js/search.js"></script>
<?php } ?>

<!-- Font Awesome JS -->
<script src="https://kit.fontawesome.com/770384ac45.js" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
</script>

</body>

</html>