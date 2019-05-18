<?php
$config = array(
			"title" => "JSON Content Rules (JCR) Specifications",
			"menu_key" => "specs",
			"meta_keywords" => "JSON, Schema, JCR, IETF, validator",
			"meta_description" => "JSON Content Rules (JCR) Specifications" );

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
			  <h1>JCR Specifications</h1>
			</header>

				<p>
				The latest internal working drafts are
				<a href="drafts/json-content-rules-10.txt">json-content-rules-10.txt</a> and
				<a href="drafts/json-content-rules-10.html">json-content-rules-10.html</a>.
				</p>

				<p>JCR can also have co-constraints added to it via directives and annotations.  These are described in (expired)
				<a href="drafts/draft-cordell-jcr-co-constraints-00.txt">draft-cordell-jcr-co-constraints-00.txt</a>.</p>

				<p>
				The last specification submitted to the IETF is
				<a href="drafts/draft-newton-json-content-rules-09.txt">draft-newton-json-content-rules-09.txt</a> and
				<a href="drafts/draft-newton-json-content-rules-09.html">draft-newton-json-content-rules-09.html</a>.
				</p>

        </div>
    </div>
<?php
}
