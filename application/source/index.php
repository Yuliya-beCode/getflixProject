<?php

    session_start();

?>
<?php include('header.php'); ?>



<main class="container">
        <div class="row align-items-center" style="min-height: calc(100vh - 250px);">
            <div class="col-lg-6 mx-auto">
                <div class="input-group">
                    <h1>Unlimited movies, TV shows, and more.</h1>
                    <h2>Ready to watch? Enter a keyword of your favorite movie.</h2>
                    <form id="searchbar" class="searchbar" method="get" action="search.php">
                        <label class="search_label" for="search_input">Search :</label>
                        <input id="search_input" class="search_input" type="text" name="search"
                               onkeypress="clickPress(event)">
                        <button id="btn_search" type="submit" aria-label="search" class="search_icon"><i
                                    class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

   


<?php include('footer.php'); ?>