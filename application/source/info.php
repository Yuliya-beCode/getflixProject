<?php

    session_start();

?>
<?php
if (!isset($_GET['movie']) or $_GET['movie'] == '') {
    header('Location: ./search.php');
}
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

date_default_timezone_set("Europe/Brussels");

if (!$response_info->title) {
    echo "Send to future 404 page - No movie found with this id on our database.";
} else { ?>
<?php include('header.php'); ?>

    <div class="container-md">
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
                        <div class="p-3 bg-light bg-gradient border-bottom">
                            <h5>Comment section</h5>
                        </div>
                        <div class="row m-t-md">
                            <div class="col">
                                <?php require_once 'process.php'; ?>
                                <?php
                                $mysqli = new mysqli('database', 'root', 'root', 'GetFlix') or die(mysqli_error($mysqli));
                                $result = $mysqli->query("SELECT * FROM comments") or die($mysqli->error);
                                ?>
                                <div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>date</th>
                                                <th>message</th>
                                                <th>action</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        while ($row = $result->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?php echo $row['date']; ?></td>
                                                <td><?php echo $row['message']; ?></td>
                                                <td>
                                                    <a href="info.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                                                    <a href="info.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete </a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </table>
                                </div>
                                <?php
                                function pre_r($array)
                                {
                                    echo '<pre>';
                                    print_r($array);
                                    echo '</pre>';
                                }
                                ?>
                                <form action="process.php" method="POST">
                                    <input type='hidden' name='id' value="<?php echo $id; ?>">
                                    <div class="form-group">
                                        <input type="text" name="message" class="form-control" value="<?php echo $message; ?>" placeholder="enter your comment">
                                        <input type='hidden' name='date' class="form-control" value=".date('Y-m-d H:i:s')."'>
                                </div>
                                <div class="form-group">
                                    <?php
                                    if ($update == true) :
                                    ?>
                                    <button type=' submit' class="btn btn-info" name='update'>Update</button>
                                    <?php else : ?>
                                        <button type="submit" name="save">Save</button>
                                    <?php endif ?>
                                    <?php echo "<br>";
                                    if (date_default_timezone_get()) {
                                        echo "default timezone: " . date_default_timezone_get();
                                    }
                                    echo "<br>";
                                    echo date('Y-m-d H:i:s');

                                    ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
} ?>
<?php require('footer.php'); ?>
