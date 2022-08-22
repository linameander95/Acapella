<?php
$page_title = "Acapella";
include("includes/header.php");
include("includes/main-menu.php");
?>
<div class="div2">
<h1> Welcome </h1>
<h2>About us</h2>
<div id="aboutdiv">
</div>
<img class="divider" src="images/divider.webp" alt="divider">
<h1> Menu </h1>
<div id="menudiv">
</div>
<img class="divider" src="images/divider.webp" alt="divider">
<h1>Book a table</h1>
        <form id="book" action="index.php" method="post">
            <div class="form-group">
                <label>Name</label><br>
                <input type="text" id="name" name="name" class="form-control" value=""><br>
                <label>E-mail</label><br>
                <input type="text" id="email" name="email" class="form-control" value=""><br><br>
                <label>Phone number</label><br>
                <input type="text" id="phonenr" name="phonenr" class="form-control" value=""><br><br>
                <label for="seating">Where do you wish to sit?</label><br><br>
                <select id="seating" name="seating" size="4" multiple>
                <option value="window">A table by the window</option>
                <option value="booth">A booth</option>
                <option value="balcony">On the upper balcony</option>
                <option value="hall">In the dining hall</option>
                </select><br><br>
                <label for="time">Desired time & date:</label><br>
                <input type="datetime-local" id="time" name="time"><br><br>
                <input type="submit" id="submitbtn" name="submitbtn" class="btn btn-primary" value="Confirm booking"><br><br>
            </div>
</form>
</div>
<?php include("includes/footer.php"); ?>
<script type="text/javascript">
    writeFood();
  </script>
  </body>

</html>