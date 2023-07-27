<aside class="post-outcome">
    <h1>Your Message was Sent!</h1>
    <div style="text-align:center;">
        <?php 
	 
	// "Capturamos" el mail
	$name = $_POST['name'];
	echo "Thank you for Contacting Us " . $name . "!";
	?>
    </div>
</aside>