<?php

session_start();

?>
<?php include('header.php'); ?>



<main class="container-fluid">
    <div class="row align-items-center" style="min-height: calc(100vh - 250px);">
        <div class="col-lg-6 mx-auto">
            <div class="input-group">
                <h1>Please enter a Movie of your Choice</h1>
                <form id="searchbar" class="searchbar" method="get" action="search.php">
                    <label class="search_label" for="search_input">Search :</label>
                    <input id="search_input" class="search_input" type="text" name="search">
                    <button id="btn_search" type="submit" aria-label="search" class="search_icon"><i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include('footer.php'); ?>