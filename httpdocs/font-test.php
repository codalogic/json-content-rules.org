<?php
$config = array(
			"title" => "JCR by example",
			"menu_key" => "home",
			"meta_keywords" => "JSON, Schema, JCR, IETF",
			"meta_description" => "Overview of JSON Content Rules (JCR) for defining JSON message content." );

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
	<div class='row margin-top-xs-20'>
		<div class='col-xs-12'>
<p>These should be proportional spacing:</p>
<pre style='font-family: unsupported, Courier'>
{
    Font: unsupported - what the font will look like if named font is not supported
}
</pre>
<pre style='font-family: Chivo, Courier'>
{
    Font: Chivo
}
</pre>
<pre style='font-family: "Helvetica Neue", Courier'>
{
    Font: "Helvetica Neue"
}
</pre>
<pre style='font-family: Helvetica, Courier'>
{
    Font: Helvetica
}
</pre>
<pre style='font-family: Arial, Courier'>
{
    Font: Arial
}
</pre>
<pre style='font-family: serif, Courier'>
{
    Font: serif
}
</pre>
<p>These should be fixed-width spacing:</p>
<pre style='font-family: unsupported, Times'>
{
    Font: unsupported - what the font will look like if named font is not supported
}
</pre>
<pre style='font-family: Monaco, Times'>
{
    Font: Monaco
}
</pre>
<pre style='font-family: "Bitstream Vera Sans Mono", Times'>
{
    Font: "Bitstream Vera Sans Mono"
}
</pre>
<pre style='font-family: "Lucida Console", Times'>
{
    Font: "Lucida Console"
}
</pre>
<pre style='font-family: Terminal, Times'>
{
    Font: Terminal
}
</pre>
<pre style='font-family: "Courier New", Times'>
{
    Font: "Courier New"
}
</pre>
<pre style='font-family: Courier, Times'>
{
    Font: Courier
}
</pre>
<pre style='font-family: monospace, Times'>
{
    Font: monospace
}
</pre>
		</div>
    </div>
<?php
}
