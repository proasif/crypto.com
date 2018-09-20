 <footer>
        <footer-background>
            <figure class="clouds velocity-animating" ></figure>
            <figure class="background velocity-animating" ></figure>
            <figure class="foreground velocity-animating" ></figure>
            <figure class="poof"></figure>
            <div class="stag"><img src="https://bluestag.co.uk/templates/blue_stag/img/footer/seb.gif">
            <img src="https://bluestag.co.uk/templates/blue_stag/img/footer/quote-1.png" class="quote" id="q-1">
            <img src="https://bluestag.co.uk/templates/blue_stag/img/footer/quote-2.png" class="quote visible" id="q-2"></div>
        </footer-background>
        
            <?php 
					$menu = p1_custom_menu( "social-icons", true, "foot-icons", true, "", "", "");
					echo $menu;
				 
					$menu1 = p1_custom_menu( "footer-menu", true, "foot-main-nav", true, "", "", "");
					echo $menu1; 
			?>
    </footer>
  </body>
</html>
