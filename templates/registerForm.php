<section id="registerUser">
      <h1>Register</h1>
      <form action="../actions/addUser.php" method="post">
          <label>Username: <input type="text" name = "username" required="required" value="<?=htmlentities($_SESSION['newUser username '])?>"></label>
          <label>Name: <input type="text" name="name" required="required" value="<?=htmlentities($_SESSION['newUser name '])?>"></label>
          <label>E-mail: <input type="email" name="email" required="required" value="<?=htmlentities($_SESSION['newUser email '])?>"></label>
          <label>Password: <input type="password" name="password1" required="required" value="<?=htmlentities($_SESSION['newUser password1 '])?>"></label>
          <label>Confirm password: <input type="password" name="password2" required="required" value="<?=htmlentities($_SESSION['newUser password2 '])?>"></label>
          <input id="button" type="submit" value="Submit">
      </form>
  </section> <?php 