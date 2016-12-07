<!-- Start Full Menu -->
<nav class="full-menu">
	<?php if (has_nav_menu('nav-menu')) { wp_nav_menu( array( 'theme_location' => 'nav-menu', 'depth' => 2, 'container' => false, 'menu_class' => 'thb-full-menu' ) ); }?>
	<?php do_action( 'thb_language_switcher' ); ?>
</nav>
<!-- End Full Menu -->