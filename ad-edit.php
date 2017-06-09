<?php include 'header.php'; ?>
    <section class="site-content">
        <div class="site-columns">
            <main class="site-main">

                <div class="container">
                    <form action="" method="POST">
                        <input type="text" value="" name="title" placeholder="Title" required>
                        <textarea rows="10" name="text" placeholder="Type in the text of your ad..." required></textarea>

						<!-- Dodati dropdown iz koga ce moci da se odabere kategorija oglasa -->

                        <input type="submit" value="Update" name="submit">
                    </form>
                </div>

            </main>
        </div>
    </section>
<?php include 'footer.php'; ?>
