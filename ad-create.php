<?php
	if ( isset( $_POST['submit'] ) ) {

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

						<!-- Add dropdown for ad category -->

                        <input type="submit" value="Create" name="submit">
                    </form>
                </div>

            </main>
        </div>
    </section>
<?php include 'footer.php'; ?>
