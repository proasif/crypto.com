<?php
/**
 * Template Name: Style-Guide
 *
 * The template for Style-Guide
 *
 * This is the template that displays all Website design things.
 * @since 1.0
 * @version 1.0
 */
 
 ?>
 
 <!------------Header Module------------> 
 <?
 if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
get_header();
?>
<!------------Header Module Ends------------>
<p>Just a simple <a href="http://wwweeebbb.com/">link</a> in a paragraph.</p>

<a href="http://wwweeebbb.com/" target="_blank" rel="nofollow" hreflang="en">Click here!</a>  

<!DOCTYPE HTML>
<html>
    <head>
        <title>Document Title</title>
    </head>
    <body>
        Content comes here
    </body>
</html>

<p>Let's<br />
break 
this<br /> 
line 
twice!</p>

<div style="background-color: grey; color: #fff; min-height: 100px; padding: 10px; text-align: center;">
    <div style="background-color: green;float: left;min-width: 150px;">
        Green div
    </div>
    <div style="background-color: blue;float: right;padding: 15px;">
        Blue div
    </div>
    Container div
</div>

<form action="/action.php" method="post">
    Name: <input name="name" type="text" /> <br /> 
    Age: <input max="99" min="1" name="age" step="1" type="number" value="18" /> <br />
    <input type="submit" value="Submit" />
</form>

<h1>HTML Tag List</h1>
<h2>Subtitle</h2>
<h3>Third Heading</h3>
<h4>Fourth One</h4>
<h5>Fifth-Order</h5>
<h6>Sixth is rarely used</h6>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Document Title</title>
    </head>
    <body>
        Content comes here
    </body>
</html>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Document Title</title>
    </head>
    <body>
        Content comes here
    </body>
</html>


<iframe style="overflow: hidden;" src="http://badhtml.com" width="300" height="250"></iframe>


<img src="/images/demo2x2.jpg" alt="2x2 cube" height="120" width="130" />


<form action="/action.php" method="post">
    text: <input type="text" name="yourname" maxlength="10" size="12" required /> <br /> 
    number: <input type="number" name="no" min="0" max="100" step="10" value="30"> <br /> 
    checkbox: <input type="checkbox" name="terms" value="tandc"> I accpept the terms <br />
    radio:  <input type="radio" name="gender" value="male" checked>Male 
            <input type="radio" name="gender" value="female">Female<br>
    email: <input type="email" name="yourmail"> <br /> 
    password: <input type="password" name="passw"> <br />
    color: <input type="color" name="yourcolor"> <br /> 
    date: <input type="date" name="birthday" min="1900-01-01" max="2010-01-01"> <br /> 
    time: <input type="time" name="mytime"> <br /> 
    date and time:<input type="datetime-local" name="time"> <br /> 
    week: <input type="week" name="yourweek"> <br /> 
    month: <input type="month" name="yourmonth"> <br /> 
    range: <input type="range" name="myrange" min="0" max="100"> <br /> 
    search: <input type="search" name="mysearch"> <br /> 
    tel: <input type="tel" name="myphone"> <br /> 
    url: <input type="url" name="website"> <br /> 
    <input type="submit" value="Submit" /> <input type="reset">
</form>


Ordered list:
<ol>
    <li>HTML</li>
    <li>CSS</li>
    <li>JS</li>
</ol>
Unordered bullet list:
<ul>
    <li>HTML</li>
    <li>CSS</li>
    <li>JS</li>
</ul>


<head>
    <link rel="stylesheet" type="text/css" href="tags.css">
    <link rel="icon" type="image/png" href="/favicon.ico" />
</head>


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Learn everything about HTML Tags">
    <meta name="keywords" content="html,tags" />
    <meta property="fb:admins" content="PippideePete" />
    <meta property="og:title" content="HTML Tags" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://html-css-js.com/html/tags/" />
    <meta property="og:image" content="https://html-css-js.com/images/og.jpg" />
    <meta property="og:description" content="Learn everything about HTML Tags" />
</head>

<ol start="10" type="I" reversed>
    <li>HTML</li>
    <li>CSS</li>
    <li>JS</li>
</ol>

<form action="/action.php" method="post">
    Name: <input name="name" type="text" /> <br /> 
    <select name="gender">
        <option selected="selected" value="male">Male</option>
        <option value="female">Female</option>
        <option value="undefined">Undefined</option>
    </select><br /> 
    <input type="submit" value="Submit" />
</form>

<p>A short demo paragraph.</p>
<p style="text-align: center;">The <strong>align</strong> attribute is not supported anymore so make sure to use CSS to position the text.</p>

<head>
    <script type="text/javascript" src="tags.js"></script>
</head>

<script>
    document.write('This text has been added with JavaScript');
</script>

<form action="/action.php" method="post">
    Name: <input name="name" type="text" /> <br /> 
    <select name="gender">
        <option selected="selected" value="male">Male</option>
        <option value="female">Female</option>
    </select><br /> 
    <input type="submit" value="Submit" />
</form>


She dyed her hair <span style="color: blue;">blue</span> 
for a <span style="font-size: 1.2em;">role</span>. <br />
<span onclick="alert('Hello');">Click here</span> 
to trigger a JS event.


<p>Let's test this!</p>
<style>
    p { 
        font-size: 30px;    
    }
</style>
<style media="print" type="text/css">
    body {  
        color: black;
        background: white;  
    }
</style>


<table>
    <caption>Big Companies</caption>
    <colgroup>
        <col style="background: #EFA692;" />
        <col style="background: #D0E0D2;" span="2" />
    </colgroup>
    <thead>
        <tr>
            <th>Company</th>
            <th>Country</th>
            <th>Headquarters</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Microsoft</td>
            <td>USA</td>
            <td>Redmond, WA</td>
        </tr>
        <tr>
            <td>Sony</td>
            <td colspan="2">Tokyo Japan</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td>Name</td>
            <td colspan="2">Address</td>
        </tr>
    </tfoot>
</table>


<table>
    <thead>
        <tr>
            <th>Company</th>
            <th>Country</th>
            <th>Headquarters</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Microsoft</td>
            <td>USA</td>
            <td>Redmond, WA</td>
        </tr>
        <tr>
            <td>Sony</td>
            <td colspan="2">Tokyo Japan</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td>Name</td>
            <td colspan="2">Address</td>
        </tr>
    </tfoot>
</table>


<form action="/action.php" method="post">
    Name: <input name="name" type="text" /> <br /> 
    <textarea cols="20" name="comments" rows="5">Comment</textarea><br />
    <input type="submit" value="Submit" />
</form>


<!DOCTYPE HTML>
<html>
    <head>
        <title>Document Title</title>
    </head>
    <body>
        Content comes here
    </body>
</html>


<table>
    <thead>
        <tr>
            <th>Company</th>
            <th>Country</th>
            <th>Headquarters</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Sony</td>
            <td colspan="2">Tokyo Japan</td>
        </tr>
        <tr>
            <td>Samsung</td>
            <td>South Korea</td>
            <td>Suwon</td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td>Name</td>
            <td colspan="2">Address</td>
        </tr>
    </tfoot>
</table>


<ul>
    <li>HTML</li>
    <li>CSS</li>
    <li>JS</li>
</ul>
<!------------Main Module------------> 
 <div id="primary" class="p1-primary-max p1-body">
	<div id="content" role="main">
    
    
    <!------------Admin Panel Module------------> 
        <?php get_template_part( 'template-parts/panel/url-image-upload' ); ?>
    <!------------Admin Panel Module Ends------------> 
    
    <div class="p1-section p1-style-curves p1-style-shadow">
        <h1>CONTACT</h1>
        <p>Have something awesome / terrible to say about us? Want to point a bug out? Or have a feature request which you just cannot do about? Well, don’t wait then. Just hit us with a message and we will have our interns run around for you ( and for fun :) ) </p>
        
        <label> Your Name (required)
            [text* your-name] </label>
        
        <label> Your Email (required)
            [email* your-email] </label>
        
        <label> Subject
            [text your-subject] </label>
        
        <label> Your Message
            [textarea your-message] </label>
        
        [submit "Send"]
    </div>
    
    <!------------Homepage Module------------> 
		<?php get_template_part( 'logic-parts/p1-homepage-featured' ); ?>
    <!------------Homepage Module Ends------------>
    
    
    
    <div class="p1-section p1-style-curves p1-style-shadow">
<?php //-------------------- p1-section p1-style-curves p1-style-shadow STARTS -----------------------// ?>
	<div class="p1-airdrop">
     <?php 
	 	//-------------- p1-airdrop STARTS --------------//
		$currentpage = get_query_var('paged');
		$custom_posts = new WP_Query( array(
			'post_type'=> 'airdrop',
			'order_by' => 'title',
			'order'    => 'desc',
			'posts_per_page' => 10,
			'paged' => $currentpage
		));
		
		if ( $custom_posts->have_posts() ) :
			while ( $custom_posts->have_posts() ) : $custom_posts->the_post(); 
			
	?> 
           
            <div class="p1-airdrop-item" data-postid="<?php the_id() ?>" data-url="<?php the_permalink() ?>">
				<?php  
			//------------------------p1-airdrop-item STARTS------------------------------//
                    $thumb_id = get_post_thumbnail_id();
                    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
                    $thumb_url[] =  $thumb_url_array;
					
					$pod = pods('airdrop', get_the_ID());
					$rate = $pod->field('rating') ;
					$users = $pod->field('no_of_users') ;
					$old_rating = 0;
					
					if ($rate >= 0 && $users >= 1) {
						 $old_rating = round( ( $rate / $users ), 2);
					}
					$logo = wp_get_attachment_image ($thumb_id); 
				?>
					
					<div class="logo"><?php echo $logo; // Printing Logo ?></div> 
                    
                 <?php      
                    $name = $pod->field('airdrop_name') ;
                    $sign =	"(" . get_the_title() . ")" ;	
					if($pod->field('estimated_value') != NULL){
                    $airdrop_value = "Value: " . $pod->field('estimated_value') . " " ;
                    }
					else $airdrop_value = NULL;
					
				  ?>
					
				<h1><?php echo $name . " " . $sign . " " . $airdrop_value; // Printing Name, Sign and Value of Airdrop ?></h1>
                    
                 <?php
					//-------------- SETTING STARS --------------//
							
					$temp_content = "";
					$star_value = "";
					$append_class = "star";
					if($old_rating > 4.75)
						 {
							$star_value = '<div class="icon-star ' . $append_class . '" value="5"></div>';
						 }
					else if($old_rating > 4.25)
						 {
							$star_value = '<div class="icon-star-half-o ' . $append_class . '" value="5"></div>';	
						 }
					else 
						{
							$star_value = '<div class="icon-star-o ' . $append_class . '" value="5"></div>';
						}
							$temp_content = $star_value . $temp_content ; // storing value for fifth star
						
					if($old_rating > 3.75)
						{
							$star_value = '<div class="icon-star ' . $append_class . '" value="4"></div>';
						}
					else if($old_rating > 3.25)
						{
							$star_value = '<div class="icon-star-half-o ' . $append_class . '" value="4"></div>';	
						}
					else 
						{
							$star_value = '<div class="icon-star-o ' . $append_class . '" value="4"></div>';
						}
							$temp_content = $star_value . $temp_content ; // storing value for fourth star
						
					if($old_rating > 2.75)
						{
							$star_value = '<div class="icon-star ' . $append_class . '" value="3"></div>';
						}
					else if($old_rating > 2.25) 
						{
							$star_value = '<div class="icon-star-half-o ' . $append_class . '" value="3"></div>';	
						}
					else 
						{
							$star_value = '<div class="icon-star-o ' . $append_class . '" value="3"></div>';
						}
							$temp_content = $star_value . $temp_content ; // storing value for third star
						
					if($old_rating > 1.75) 
						{
							$star_value = '<div class="icon-star ' . $append_class . '" value="2"></div>';
						}
					else if($old_rating > 1.25) 
						{
							$star_value = '<div class="icon-star-half-o ' . $append_class . '" value="2"></div>';	
						}
					else 
						{
							$star_value = '<div class="icon-star-o ' . $append_class . '" value="2"></div>';
						}
							$temp_content = $star_value . $temp_content ; // storing value for second star
						
					if($old_rating > 0.75) 
						{
							$star_value = '<div class="icon-star ' . $append_class . '" value="1"></div>';
						}
					else if($old_rating > 0.25) 
						{
							$star_value = '<div class="icon-star-half-o ' . $append_class . '" value="1"></div>';	
						}
					else 
						{
							$star_value = '<div class="icon-star-o ' . $append_class . '" value="1"></div>';
						}
							$temp_content = $star_value . $temp_content ; // storing value for first star
						
						if ( $users > 0 ) {	
							$starContent = '<div class = "star-rating" data-original = "' . $old_rating .  '">' 
							. $temp_content .'<input type="hidden" id="ratings-nonce" value="'. wp_create_nonce("ratings") . '">';
							$starUsers = '<div class = "star-users">(' . $users . ' Votes)</div></div>';
							
							$content = $starContent . $starUsers;
							echo $content;
						}
						else {	
							$content = '<div class = "star-rating" data-original = "' . $old_rating .  '">' 
							. $temp_content .'<input type="hidden" id="ratings-nonce" value="'. wp_create_nonce("ratings") . '">
							' . '</div>';
							echo $content ; // Displaying stars and no. of users rated
						}
						
                    
                    $about = $pod->field('brief_description');
					?>
                       <div class="about-format">
                            <div class="about"><?php echo $about ?></div>
                       </div>
                    
                   <?php $steps = get_the_content(); ?>
                        <div class="steps-format">
                            <button class="primary p1-steps-btn">Step by step guide </button>
                            <div class="show"><?php echo $steps ?></div>
                            <button class="primary p1-close-btn">CLOSE</button>
                        </div>
					<?php
                //-------------- GETTING REQUIRED LOGOS --------------//
				
					$requires = "";
					if ($pod->field('telegram_required') == true)
						{
							 $requires = $requires . " " . '<div class="icon icon-paper-plane"></div>';
						}
					if ($pod->field('twitter_required') == true)
						{
							$requires = $requires . " " . '<div class="class="icon-twitter"></div></br>';
						}
					if ($pod->field('facebook_required') == true) 
						{
							$requires = $requires . " " . '<div class="icon-facebook"></div></br>';
						}
					if ($pod->field('e-mail_required') == true)
						{
							$requires = $requires . " " . '<div class="icon-envelope"></div></br>';
						}
					if ($pod->field('reddit_required') == true)
						{
							$requires = $requires . " " . '<div class="icon-reddit"></div></br>';
						}
					if ($pod->field('instagram_required') == true)
						{
							$requires = $requires . " " . '<div class="icon-instagrem"></div></br>';
						}
					if ($pod->field('youtube_required') == true)
						{
							$requires = $requires . " " . '<div class="icon-youtube"></div></br>';
						}
					if ($pod->field('medium_required') == true)
						{
							$requires = $requires . " " . '<div class="icon-medium"></div></br>';
						}
					if ($pod->field('phone_required') == true)
						{
							$requires = $requires . " " . '<div class="icon-phone"></div></br>';
						}
					if ($pod->field('linkedin_required') == true)
						{
							$requires = $requires . " " . '<div class="icon-linkedin"></div></br>';
						}
					if ($pod->field('discord_required') == true)
						{
							$requires = $requires . " " . '<div class="icon-flickr"></div></br>';
						}
						
				?>
			
                    <div class="requires"><?php echo ("Requires: "); echo $requires; // Displaying required logos  ?></div> 
    
            </div>
			<?php
			 //-------------- p1-airdrop-item ENDS--------------//
				endwhile; 
			?>
            
            
		<?php endif; ?>
	</div>
    <?php //-------------- p1-airdrop ENDS --------------// ?>
    
    <div class="load-more-button" align="center">
        	<a><button data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>"class="primary p1-airdrop-load-more">Load More</button></a>
    </div>
</div>
<?php //-------------- p1-section p1-style-curves p1-style-shadow ENDS --------------// ?>

    
    
	</div><!-- #content -->
</div><!-- #primary -->
 
<!------------Main Module Ends------------> 


<!------------Footer Module------------> 
<?php
get_footer(); 
?>
<!------------Footer Module Ends------------>  
 
 
 
 
 
 