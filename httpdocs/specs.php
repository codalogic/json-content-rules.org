<?php
$config = array(
			"title" => "JSON Content Rules (JCR) Specifications &amp; Implementations",
			"menu_key" => "specs",
			"meta_keywords" => "JSON, Schema, JCR, IETF, validator",
			"meta_description" => "JSON Content Rules (JCR) Specifications &amp; Implementations" );

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
			  <h1>JCR Specifications & Implementations</h1>
			</header>

				<h3>
				<a id="specification" class="anchor" href="#specification" aria-hidden="true"><span class="octicon octicon-link"></span></a>Specification</h3>

				<p>For more details read the latest specification at
				<a href="https://www.ietf.org/internet-drafts/draft-newton-json-content-rules-09.txt">draft-newton-json-content-rules-09.txt</a>.</p>

				<p>JCR can also have co-constraints added to it via directives and annotations.  These are described in (expired)
				<a href="drafts/draft-cordell-jcr-co-constraints-00.txt">draft-cordell-jcr-co-constraints-00.txt</a>.</p>

				<h3>
				<a id="implementations" class="anchor" href="#implementations" aria-hidden="true"><span class="octicon octicon-link"></span></a>Implementations</h3>

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
