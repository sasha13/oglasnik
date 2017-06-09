<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "root";
    $dbname = "ovde ubaciti ime baze";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
?>

<?php include 'header.php'; ?>
    <section class="site-content">
        <div class="site-columns">
            <main class="site-main">
                <div class="container">
                    <h1>Ads</h1>

					<?php

                        // Prepare statement
                        $sql = "SELECT * FROM ads";
                        $statement = $conn->prepare($sql);

                        // execute statement
                        $statement->execute();

                        // set the resulting array to associative
                        $statement->setFetchMode(PDO::FETCH_ASSOC);

                        // gets data from DB
                        $ads = $statement->fetchAll();

                        // uncomment to see if it works
                        //var_dump($ads);


                        // Display all ads - title and first 100 characters of text
                        // Make title and text clickable - click takes you to the single ad page

                        // Below every ad, add a delete link

                        // Also, add an edit link with a query parameter
                        // which should redirect to edit ad page

					?>

                </div>
            </main>
        </div>
    </section>
<?php include 'footer.php'; ?>
