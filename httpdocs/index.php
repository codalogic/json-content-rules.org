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

			<header>
			  <h1>JCR</h1>
			  <h2>JSON Content Rules</h2>
			</header>

			<hr />

			<section id="main_content">
			  <h3>
				<a id="overview" class="anchor" href="#overview" aria-hidden="true"><span class="octicon octicon-link"></span></a>Overview</h3>

				<p>JSON Content Rules (JCR) is a language for
				describing and testing the interchange of data in <a href='http://json.org'>JSON</a> 
				<a href='https://tools.ietf.org/html/rfc7159'>[RFC7159]</a>
				format used by computer protocols and processes.  The syntax of JCR
				is not JSON but is "JSON-like", possessing the conciseness and
				utility that has made JSON popular.</p>

				<p>As an example, the following JSON taken from RFC 7159:</p>

<pre>
{
    "Image": {
        "Width":  800,
        "Height": 600,
        "Title":  "View from 15th Floor",
        "Thumbnail": {
            "Url":    "http://www.example.com/image/481989943",
            "Height": 125,
            "Width":  100
        },
    "Animated" : false,
    "IDs": [116, 943, 234, 38793]
    }
}
</pre>
				<p>can be described using JCR as:</p>
<pre>
{
    "Image" : {
        "Width" : 0..1280,
        "Height" : 0..1024,
        "Title" : string,
        "Thumbnail" : {
            "Url" : uri,
            "Width" : 0..1280,
            "Height" : 0..1024
        },
        "Animated" : boolean,
        "IDs" : [ integer * ]
    }
}
</pre>
				<p>
					In the above, the sub-rules <code>"Width" : 0..1280</code> and <code>"Height" : 0..1024</code>
					are repeated multiple times.  To make this simpler and easier to manage, each can be defined in 
					their own named rule, and the rule name can be used in place of the sub-rules; giving:
				</p>
<pre>
{
    "Image" : {
        $width,
        $height,
        "Title" : string,
        "Thumbnail" : {
            "Url" : uri,
            $width,
            $height
        },
        "Animated" : boolean,
        "IDs" : [ integer * ]
    }
}

$width = "Width" : 0..1280
$height = "Height" : 0..1024
</pre>
		<p>
			As <code>$width</code> and <code>$height</code> are often used together, the above can
			be further simplified by putting them in a group and using the group as a mixin. Below,
			this is done in the group named <code>$dimensions</code>.
		</p>
<pre>
{
    "Image" : {
        $dimensions,
        "Title" : string,
        "Thumbnail" : {
            "Url" : uri,
            $dimensions
        },
        "Animated" : boolean,
        "IDs" : [ integer * ]
    }
}

$dimensions = ( $width, $height )
$width = "Width" : 0..1280
$height = "Height" : 0..1024
</pre>
		<p>
			Rules can also be used to specify types.  For example, below the <code>integer</code> type
			in the <code>"IDs"</code> object member is replaced by <code>$id</code>:
		</p>
<pre>
{
    "Image" : {
        $dimensions,
        "Title" : string,
        "Thumbnail" : {
            "Url" : uri,
            $dimensions
        },
        "Animated" : boolean,
        "IDs" : [ $id * ]
    }
}

$dimensions = ( $width, $height )
$width = "Width" : 0..1280
$height = "Height" : 0..1024
$id = integer
</pre>

				<h3>
				<a id="uses" class="anchor" href="#uses" aria-hidden="true"><span class="octicon octicon-link"></span></a>Uses</h3>
				<p>
					There are many uses for JCR throughout the protocol and product development life-cycle, and
					even into deployment.  These include:
				</p>
				<ul>
					<li>helping specification authors concisely and clearly describe complex JSON data
					  structures.</li>

					<li>aiding software developers to verify their implementations conform to
					  specifications by validating any generated JSON against
					  the specified JCR.</li>

					<li>aiding software developers by permitting specification of JCR based test sets.</li>

					<li>aiding software implementors to resolve interoperability issues.</li>

					<li>facilitating monitoring of JSON based protocols via comparison of observed
					  JSON messages against their JCR specification.</li>
				</ul>
				<p>
					One example of interoperability usage is
					<a href='https://github.com/arineng/nicinfo'>[NicInfo]</a>, an RDAP client which can use
					JCR to help RDAP server operators find compatibility issues.
				</p>

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

				<h3>
				<a id="get-involved" class="anchor" href="#get-involved" aria-hidden="true"><span class="octicon octicon-link"></span></a>Get Involved</h3>
				<p>Like JCR and want to know more?  Know of an implementation we can list?  Need help making JCR work for you?  Contact us at 
				<script>mk_e_link('org', 'json-content-rules', 'contact', 'Enter JCR subject:')</script>.</p>

			</section>
		</div>
    </div>
<?php
}
