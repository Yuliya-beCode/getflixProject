<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="stylesheet" href="index.css">
    <title>Movie Search module</title>
</head>

<body>

<nav class="navbar navbar-dark bg-dark d-flex justify-content-around">
    <!-- Navbar content -->
    <img id="logo" src="pictures/Logo.png" alt="logo" srcset="">

    <a href="register.php" style="color:white;">Register</a>
    <a href="login.php" style="color:white;">Log in</a>
    <a href="logout.php" style="color:white;">Log out</a>
</nav>

<div class="container-fluid">
<div class="row align-items-center" style="min-height: calc(100vh - 66px);">
    <div class="col-lg-6 mx-auto">
        <div class="input-group">
        <form id="searchbar" class="searchbar" method="get" action="search.php">
            <label class="search_label" for="search_input">Search :</label>
            <input id="search_input" class="search_input" type="text" name="search" onkeypress="clickPress(event)">
            <button id="btn_search" type="submit" aria-label="search" class="search_icon"><i class="fas fa-search"></i>
            </button>
        </form>
    </div>
</div>
</div>
</div>

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