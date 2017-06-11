<!-- neophodno je da uvucemo db.php u kome se nalazi kod za konekciju sa bazom -->
<?php include 'db.php'; ?>
<?php include 'header.php'; ?>
    <section class="site-content">
        <div class="site-columns">
            <main class="site-main">
                <div class="container">
                    <h1>Adverts</h1>

                    <?php
                        // pripremamo upit
                        $sql = "SELECT * FROM ads ORDER BY id DESC LIMIT 5";
                        $statement = $conn->prepare($sql);

                        // izvrsavamo upit
                        $statement->execute();

                        // zelimo da se rezultat vrati kao asocijativni niz.
                        // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
                        $statement->setFetchMode(PDO::FETCH_ASSOC);

                        // punimo promenjivu sa rezultatom upita
                        $ads = $statement->fetchAll();

                            // iteriramo po nizu oglasa
                        foreach ($ads as $ad) {
                    ?>

                    <!-- za svaki oglas na strani prikazujemo title i text -->
                    <!-- obe stvari su klikabilne i vode na stranu pojedinacnog oglasa -->
                    <!-- link je kreiran uz pomoc query parametra (?id=) -->
                    <!-- taj parametar se automatski smeshta u $_GET (tako funkcionise sam php)-->
                    <a href="ad.php?id=<?php echo $ad['id'] ?>">
                        <h3><?php echo $ad['title'] ?></h3>
                        <p><?php echo $ad['text'] ?></p>
                    </a>

                    <!-- end foreach -->
                    <?php } ?>

                    <!-- link do strane svih oglasa -->
                    <a href="ads.php"><h2>All Ads</h2></a>

                </div>
            </main>
        </div>
    </section>
<?php include 'footer.php'; ?>
