<?php
$config = array(
			"title" => "JCR Checker",
			"menu_key" => "checker",
			"meta_keywords" => "JSON, Schema, JCR, IETF, validator",
			"meta_description" => "Online JSON Content Rules (JCR) verification checker" );

$max_length = 5000;

include( 'layout.php' );

function head_extra()
{
}

function body_end_extra()
{
	//echo "<script>prettyPrint();</script>\n";
}

function main_content()
{
	global $max_length;

	echo "<div class='row margin-top-xs-30'>
        <div class='col-xs-12'>
			<header>
			  <h1>JCR Checker</h1>
			</header>
        ";

	if( ! isset($_REQUEST['op'] ) )
		mode_new();
	else if( $_REQUEST['op'] == 'compile' ) {
		if( isset( $_REQUEST['jcr'] ) && strlen( $_REQUEST['jcr'] ) > $max_length )
			mode_too_big();
		else
			mode_compile();
	}

    echo "
            </div>
        </div>
        ";
}

function mode_new()
{
	global $max_length;
	
	echo "<p>
			This page allows you to check a JCR ruleset on-line using the
			<a href='https://github.com/codalogic/cl-jcr-parser' target='_blank'>Codalogic C++ JSON Content Rules Parser</a>.
			<p>
			The JCR Checker is a 'work in progress' and so not all JCR features are currently supported.  Currently, only the syntax is
			checked.  Higher order functionality, such as checking specified target rules actually exist, and consistency of
			referenced rules will be supported in a future version.
			<p>
			Also, embarrassingly, blank lines are not taken into account when calculating line numbers for error messages!  Please bear this
			in mind when try to find any reported errors.
			<p>
			Note: To protect the server, the maximum allowed JCR input size is $max_length bytes.
			<p>
			Enter the JCR to be checked here:
			</p>
			";
	show_form();
}

function mode_too_big()
{
	global $max_length;

	echo "<h3>JCR Input Too Large</h3>
			<hr />
			<p>
			The protect the server, the maximum JCR input size for the on-line checker is limited to $max_length characters.
			<p>
			Please reduce the size of the JCR.
			</p>
			";
    $file_base = store_jcr();
	show_form( "$file_base.jcr" );
}

function mode_compile()
{
	echo "<h3>Results</h3>\n";
	
    $file_base = store_jcr();
    if ($handle = fopen("$file_base.jcr", 'w')) {
		fwrite($handle, stripslashes( $_REQUEST['jcr'] ) );
		fclose($handle);
    }
	$cmd = "../private/bin/jcrcheck $file_base.jcr 2>&1";
	$output = shell_exec( $cmd );
	show_checker_output( $output, $file_base );
	
	echo "<hr /><h3>Your JCR</h3>
	    <p>Edit and re-check your JCR if you wish...</p>\n";
	show_form( "$file_base.jcr" );
}

function store_jcr()
{
    $jcr_dir = "uploaded-jcr";
	$id = time() . '_' . (getmypid() % 10000);
    $file_base = "$jcr_dir/$id";
    if ($handle = fopen("$file_base.jcr", 'w')) {
		fwrite($handle, stripslashes( $_REQUEST['jcr'] ) );
		fclose($handle);
    }
    return $file_base;
}

function show_form( $jcr_file = '' )
{
	echo "<form action='checker' method='post'>
		<input type='hidden' name='op' value='compile' />
		<textarea name='jcr' rows='15' cols='80' wrap='off'>";

		if( $jcr_file != '' )
			output_file( $jcr_file );
			
		echo "</textarea>\n";
		humanity_check();
		echo "	<input type='submit' value='Check...' />
			</form>\n";
}

function output_file( $file )
{
	// Note: can't do code formatting inside a text box!

	$handle = @fopen( $file, "r");
	if ($handle) {
		while (!feof($handle)) {
			$buffer = fgets($handle);
			$buffer = html_safe( $buffer );
			echo $buffer;
		}
		fclose($handle);
	}
	else {
		echo "File not generated!!!";
	}
}

function show_checker_output( $output, $file_base = '' )
{
    $output = nl2br( html_safe( $output ) );
    if( $file_base != '' )
        $output = preg_replace( "|$file_base|", "input", $output );
    echo "<p class='exe-out'>$output</p>\n";
}
