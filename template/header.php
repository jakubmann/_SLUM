<div class='header'>
    <a class='header__title' href='/'>Slum</a>
</div>

<div class="navigation">
	<ul class="navigation__ul">
		<li class="navigation__item navigation__item--first"><a class="navigation__link" href="/">Home</a></li>
        <?php
        if (!isset($_SESSION['user_id'])) {
		      echo '<li class="navigation__item"><a class="navigation__link" href="/login">Log in / Register</a></li>';
        }
        else {
            echo '<li class="navigation__item"><a class="navigation__link" href="ajax/logout.php">Log out</a></li>';
        }
        ?>

	</ul>
</div>
