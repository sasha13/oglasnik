<?php
    session_start();
?>

<?php include 'db.php'; ?>

<!-- ova skripta se izvrsava kada se dolazi na edit stranu pojedinacnog oglasa
    i kada se klikne na 'Update' dugme na istoj strani.
    Zbog toga je neophodno imati 2 uslova (If-a)
    -->

<?php
    if (isset($_GET['id'])) {
        $adId = $_GET['id'];

        // query koji dovlaci oglas sa dodatnim podacima iz povezanih tabela
        $getSingleAdQuery = "SELECT ads.id, ads.title, ads.text, ads.created_at, ads.expires_on,
                         categories.id AS category_id, users.id AS user_id,
                         profiles.first_name, profiles.last_name, profiles.city, profiles.phone FROM ads
                         LEFT JOIN categories ON categories.id = ads.category_id
                         LEFT JOIN users ON users.id = ads.user_id
                         LEFT JOIN profiles ON profiles.user_id = users.id WHERE ads.id = $adId";

        $statement = $conn->prepare($getSingleAdQuery);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $singleAd = $statement->fetch();

        // neophodno je da u sesiji sacuvamo ad_id koji smo
        // dovukli iz baze. zasto?
        // kada budemo kliknuli na 'Update', necemo upasti u ovu iF granu
        // pa samim tim i necemo odraditi query koji dovlaci singleAd,
        // a taj ad_id nam je neophodan da bi znali koji oglas da update-ujemo.
        $_SESSION['ad_id'] = $singleAd['id'];

        // query koji dovlaci sve kategorije oglasa
        // neophodan nam je za dropdown
        $getAllCategoriesQuery = "SELECT * FROM categories";

        $statement = $conn->prepare($getAllCategoriesQuery);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $allCategories = $statement->fetchAll();
    }

    // deo koda koji se izvrsava klikom na 'Update' dugme
    if (isset($_POST['submit'])) {
        // uzimamo sve vrednosti koje je korisnik uneo preko forme
        // uz pomoc $_POST globalne promenjive
        $title = $_POST['title'];
        $text = $_POST['text'];
        $categoryId = $_POST['category_id'];
        // ID oglasa uzimamo iz sesije gde smo ga snimili kada
        // smo prvi put dosli na stranu i iz baze povukli oglas
        $adId = $_SESSION['ad_id'];
        $updateAdQuery = "UPDATE ads SET title = '{$title}', text = '{$text}', category_id = $categoryId WHERE ads.id = $adId";
        $statement = $conn->prepare($updateAdQuery);

        $statement->execute();

        header('Location: ads.php');
    }

?>
<?php include 'header.php'; ?>
    <section class="site-content">
        <div class="site-columns">
            <main class="site-main">

                <div class="container">
                    <!-- sva polja forme moraju biti popunjena podacima koje smo povukli iz baze -->
                    <form method="POST">
                        <input type="text" value="<?php echo $singleAd['title'] ?>" name="title" placeholder="Title" required>
                        <textarea rows="10" name="text" placeholder="Type in the text of your ad..." required>
                            <?php echo $singleAd['text'] ?>
                        </textarea>

						<!-- kategorija oglasa mora biti preselektovana (postize se 'selected' atributom) -->
                        <select name="category_id">
                            <?php
                                foreach ($allCategories as $category) {
                            ?>
                            <option value="<?php echo $category['id'] ?>" <?php if($category['id'] == $singleAd['category_id']) { echo 'selected'; } ?>>
                                <?php echo $category['name'] ?>
                            </option>
                            <?php } ?>
                        </select>

                        <input type="submit" value="Update" name="submit">
                    </form>
                </div>

            </main>
        </div>
    </section>
<?php include 'footer.php'; ?>
