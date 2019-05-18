<?php
$config = array(
			"title" => "JSON Content Rules (JCR) Implementations",
			"menu_key" => "implementations",
			"meta_keywords" => "JSON, Schema, JCR, IETF, validator",
			"meta_description" => "JSON Content Rules (JCR) Implementations" );

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
?>
	<div class='row margin-top-xs-30'>
        <div class='col-xs-12'>
			<header>
			  <h1>JCR Implementations</h1>
			</header>

				<p>A number of implementations are under development to verify the JCR syntax.  These include:</p>

				<p>
					<a href="https://github.com/arineng/jcrvalidator">Ruby jcrvalidator (Work in Progress)</a><br>
					<a href="https://bitbucket.org/anewton_1998/jcr_java">Java JCR (Work in Progress)</a><br>
					<a href="https://github.com/codalogic/cl-jcr-parser">C++ cl-jcr-parser (Work in Progress)</a>
				</p>


        </div>
    </div>
<?php
}
