<?php

// API DOCS: https://developers.themoviedb.org/3/movies/get-movie-videos

// GET MOVIE INFO: https://api.themoviedb.org/3/movie/791373?api_key=04c35731a5ee918f014970082a0088b1&language=en-US




$domain = 'https://api.themoviedb.org';
$API_KEY = '04c35731a5ee918f014970082a0088b1';
$id = $_GET['movie'];
$video_key = false;

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



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="shortcut icon" href="./pictures/Logo.png"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"/>

    <link rel="stylesheet" href="info.css"/>

    <title>Video</title>


</head>

<body>


<nav class="navbar navbar-expand-sm justify-content-around">

    <!-- Navbar content -->
    <img id="logo" src="./pictures/Logo.png" alt="logo" srcset=""/>

    <a href="./application/source/index.php" style="color: rgb(247, 240, 241)">Welcome Page</a>
    <a href="register.php" style="color:rgb(247, 240, 241)">Register</a>
    <a href="login.php" style="color:rgb(247, 240, 241)">Log in</a>


</nav>

<div class="container d-flex p-3">


    <div class="row">
        <div class="col-sm">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Video window</h5>
                </div>
                <div class="ibox-content d-flex">
                    <figure>
                        <?php
                        if ($video_key !== false && $video_key !== null)
                            echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $video_key . '"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>';
                        else echo '<h4 class="text-danger">No video</h4>'
                        ?>
                    </figure>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Video description</h5>
                </div>

                <div class="ibox-content profile-content">
                    <h4><strong><?php echo $response_info->title ?></strong></h4>

                    <p><i class="fa fa-clock-o"></i> <b>Release date</b> <?php echo $response_info->release_date ?></p>

                    <p><i class="fa fa-clock-o"></i>
                        <a href="<?php echo $response_info->homepage ?>" target="_blank"><b>Homepage</b></a></p>

                    <h5>Genres:</h5>
                    <ul><?php foreach ($response_info->genres as $item){
                        echo '<li>'.$item->name.'</li>';
                        } ?></ul>

                    <p>
                        <?php echo $response_info->overview ?>
                    </p>
                    <div class="row m-t-md">
                        <div class="col-md-9">
                            <h5><strong>28</strong> Comments</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>