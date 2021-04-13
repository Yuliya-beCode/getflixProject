<?php

    session_start();

?>
 <?php include('header.php');?>




        <h1>Welcome to the <?php echo $_SESSION['users']['username']; ?>Page</h1>

        <div id="profile">
            <h2>Your Username is: <?php echo  "<u>" . $_SESSION['users']['username'] . "</u>"; ?>. "</u>"; ?></h2>
            <div id="logout"><a href="logout.php">Please Click To Logout</a></div>
        </div>

        <table id="table">
            <tr>
                <th>Id</th>
                <th>firstname</th>
                <th>lastname</th>
                <th>username</th>
                <th>email</th>
                <th>role</th>
                <th>operation</th>
            </tr>





            <?php

            //connect to database
            $conn = mysqli_connect("database", "root", "root", "GetFlix");


            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            //select en insert database data into html 
            $sql = "SELECT id, firstname, lastname, username, email, role FROM user ORDER BY id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["firstname"] . "</td>";
                    echo "<td>" . $row["lastname"] . "</td>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["role"] . "</td>";
                    //delete a row from the database 
                    echo "<td><a href = delete.php?id=" . $row['id'] . ">delete</a></td>";
                    echo "</tr>";
                }
            }

            ?>
        </table>

        <?php include('footer.php'); ?>