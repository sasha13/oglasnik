<?php include 'db.php'; ?>

<?php
    $getAllCategoriesQuery = "SELECT * FROM categories";
    $statement = $conn->prepare($getAllCategoriesQuery);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);

    // gets data from DB
    $allCategories = $statement->fetchAll();

    // zbog ovog isset() uslova ovaj deo koda u IF-u
    // ce se izvrsiti samo kada se klikne na 'Create' dugme.
    // u $_POST globalnoj promenjivooj se nalaze sve vrednosti
    // koje smo upisali u formu
	if (isset($_POST['submit'])) {
	    $title = $_POST['title'];
        $text = $_POST['text'];
        // trebalo bi uzeti ID ulogovanog user-a ali posto noje implementiran taj deo
        // uzecemo ID nekog od postojecih user-a
        $user_id = 1;
        $category_id = $_POST['category_id'];
        $created_at = date('Y-m-d');
        $expires_on = date('Y-m-d', strtotime("+30 days"));

        $insertAdQuery = "INSERT INTO ads (title, text, user_id, category_id, created_at, expires_on) 
                          VALUES ('{$title}', '{$text}', $user_id, $category_id, '{$created_at}', '{$expires_on}')";
        $statement = $conn->prepare($insertAdQuery);

        // execute statement
        $statement->execute();

        header('Location: ads.php');
	}
?>

<?php include 'header.php'; ?>
    <section class="site-content">
        <div class="site-columns">
            <main class="site-main">

                <div class="container">
                    <form action="" method="POST">
                        <input type="text" value="" name="title" placeholder="Title" required>
                        <textarea rows="10" name="text" placeholder="Type in the text of your ad..." required></textarea>

                        <!-- popunjavamo dropdown sa vrednostima iz 'category' tabele -->
                        <select name="category_id">
                            <?php
                            foreach ($allCategories as $category) {
                                ?>
                                <option value="<?php echo $category['id'] ?>">
                                    <?php echo $category['name'] ?>
                                </option>
                            <?php } ?>
                        </select>

                        <input type="submit" value="Create" name="submit">
                    </form>
                </div>

            </main>
        </div>
    </section>
<?php include 'footer.php'; ?>
