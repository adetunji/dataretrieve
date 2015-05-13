<html>
    <head>
        <title>Book-O-Rama Search Results</title>
    </head>
    <body>
        <h1>Book-O-Rama Search Results</h1>
        <?php
        require 'dbconfig.php';

        
// create short variable names
        $searchtype = $_POST['searchtype'];
        $searchterm = trim($_POST['searchterm']);
        if (!$searchtype || !$searchterm) {
            echo 'You have not entered search details. Please go back and try again.';
            exit;
        }
        if (!get_magic_quotes_gpc()) {
            $searchtype = addslashes($searchtype);
            $searchterm = addslashes($searchterm);
        }
        $db = new mysqli($DBHOST,  $DBUSER, '', $DBNAME);
        $db = new mysqli('localhost', 'root', '', 'books');
        if (mysqli_connect_errno()) {
            echo 'Error: Could not connect to database. Please try again later.';
            exit;
        }
       // $query = "select * from textbooks where " . $searchtype . " like '%" . $searchterm . "%'";
        $query = "select * from textbooks where " . $searchtype . " like '%" . $searchterm . "%'";
        $result = $db->query($query);
        $num_results = $result->num_rows;
        echo "<p>Number of books found: " . $num_results . "</p>";
        for ($i = 0; $i < $num_results; $i++) {
            $row = $result->fetch_assoc();
            echo "<p><strong>" . ($i + 1) . ". Title: ";
            echo htmlspecialchars(stripslashes($row['title']));
            echo "</strong><br />Author: ";
            echo stripslashes($row['author']);
            echo "<br />Title: ";
            echo stripslashes($row['title']);
            echo "<br />Year: ";
            echo stripslashes($row['year']);
            echo "</p>";
        }
        $result->free();
        $db->close();
        ?>
    </body>
</html>