<?php
	// Conditionally compile LESS to CSS
    $CONDITIONALLY_COMPILE_LESS = 1;
    if( $CONDITIONALLY_COMPILE_LESS ) {
        require "less-compile.php";
        compile_less( array( "css/jcr" ) );
    }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<?php
		    echo "
		        <title>{$config['title']}</title>
	            <meta name='description' content='{$config['meta_description']}'>
	            <meta name='keywords' content='{$config['meta_keywords']}'>
		        ";
		?>

		<!-- Bootstrap -->
		<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,600italic,700italic,600' type='text/css'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Chivo:900' type='text/css'>
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		
		<!-- CSS -->
		<link rel="stylesheet" href="css/tactile.css">
		<link rel="stylesheet" href="css/jcr.css">
		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!--[if lt IE 8]>
    	<link rel="stylesheet" href="../css/bootstrap-ie7.css">
		<![endif]-->

		<script src="js/jcr.js"></script>
        <?php
            if( function_exists( 'head_extra' ) ) {
                head_extra();
            }
        ?>
	</head>

	<body>
		<div class='container narrow'>
            <?php
                //branding_bar();
                //menu_bar();
                main_content();
			    footer_bar();
			?>
		</div>
        <?php
            if( function_exists( 'body_end_extra' ) ) {
                body_end_extra();
            }
        ?>
	</body>
</html>

<?php

function branding_bar()
{
?>
	<div class="row">
        <div class="brandingbar">
	    </div>
	</div>
<?php
}

function menu_bar()
{
?>
	<div class="row">
		<nav role="navigation" class="navbar navbar-codalogic">
	        <div class="navbar-header">
	            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle collapsed">
	                <span class="sr-only">Toggle navigation</span>
	                <div class="icon-bar"></div> <!-- These three make up the hamburger icon -->
	                <div class="icon-bar"></div>
	                <div class="icon-bar"></div>
	            </button>
	        </div>
	        <!-- Collection of nav links and other content for toggling -->
            <div id="navbarCollapse" class="collapse navbar-collapse">
                <ul class="nav nav-codalogic nav-num-menu-options-xs-7">
	            <?php
	                menu_items();
	            ?>
                </ul>
            </div>
	    </nav>
	</div>
<?php
}

function menu_items()
{
	menu_item( 'home', 'Home', './' );
	menu_item( 'checker', 'JCR Checker', 'checker' );
}

function menu_item( $key, $label, $link )
{
	global $config;
	
	sub_menu_item( $config['menu_key'], $key, $label, $link );
}

// Example usage:
//     sub_menu_bar( 'download', [ [ 'overview', 'Overview', './' ], [ 'download', 'Download', 'download.php' ], [ 'buy', 'XML Schema Overview ', 'buy' ] ] );
// Second parameter to an array of arrays, where embedded array is [ <menu_key>, <display_text>, <url> ]
// If there are, for example, 5 menu options, then need to define a CSS style of .nav-num-menu-options-xs-5 etc.

function sub_menu_bar( $active_key, $options )
{
    $n_options = count( $options );

    echo "
	    <div class='row'>
		    <nav role='navigation' class='navbar navbar-codalogic'>
                <ul class='nav nav-codalogic nav-num-menu-options-xs-$n_options'>
        ";
        sub_menu_items( $active_key, $options );
    echo "
                </ul>
	        </nav>
	    </div>
	    ";
}

function sub_menu_items( $active_key, $options )
{
    foreach( $options as &$v )
        sub_menu_item( $active_key, $v[0], $v[1], $v[2] );
}

function sub_menu_item( $active_key, $key, $label, $link )
{
	$check_name = $link;
	if( strpos( $link, '.php' ) === false )
	    $check_name .= '.php';

    if( $link != './' && ! file_exists( $check_name ) )
        $link = "unimplemented?was=$link";

	echo "<li role='presentation'";     // role='presentation' is help assistive readers. Works with role='navigation' above
	if( $active_key == $key )
		echo " class='active'";
	echo "><a href='$link'><span>$label</span></a></li>\n";
}

function menu_dropdown( $keys, $label )
{
    // If needed, copy from PPSA rev2016 code
}

function menu_dropdown_end()
{
    // If needed, copy from PPSA rev2016 code
}

function humanity_check()
{
	$humanity_check_value_attribute = '';
	if( isset( $_REQUEST['humanity_check'] ) && $_REQUEST['humanity_check'] != '' )
		$humanity_check_value_attribute = " value='{$_REQUEST['humanity_check']}'";
	echo "<div class='humanity_check'>Comments: <input name='humanity_check'$humanity_check_value_attribute /></div>\n";
}

function footer_bar()
{
?>
	<div class="row">
        <footer class='footer'>
            JCR is maintained by <a href="https://github.com/codalogic">codalogic</a><br>
            This page was derived from <a href="https://pages.github.com">GitHub Pages</a>, Tactile theme by <a href="https://twitter.com/jasonlong">Jason Long</a>.<br>
            Copyright &copy; <?php echo @strftime("%Y");?>, <a href="https://codalogic.com">Codalogic Ltd</a>.
        </footer>
    </div>
<?php
}

function html_safe( $in )
{
    return htmlentities( $in, ENT_COMPAT | ENT_HTML401, 'UTF-8', false );
}

function html_safe_with_markup( $in )
{
    $ltkeep = '&ltkeep;';
    $gtkeep = '&gtkeep;';
    $in = preg_replace( '|<(/?)b>|', "$ltkeep$1b$gtkeep", $in );
    $in = htmlentities( $in, ENT_COMPAT | ENT_HTML401, 'UTF-8', false );
    $in = preg_replace( "|$ltkeep|", "<", $in );
    return preg_replace( "|$gtkeep|", ">", $in );
}
?>
