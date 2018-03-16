<?php
$config = array(
			"title" => "JSON Content Rules (JCR) by example",
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

				<p>As an example, the following JSON is taken from RFC 7159:</p>

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
				<p>To give you a taste of JCR, it can be described using JCR as:</p>
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
					To continue exploring JCR using this example, have a look at the <a href='tutorial'>tutorial</a>.
					<p>
					For a more in-depth understanding of JCR take a look at the <a href='specs'>specifications</a>.
				</p>

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
				<a id="find-out-more" class="anchor" href="#find-out-more" aria-hidden="true"><span class="octicon octicon-link"></span></a>Find Out More</h3>
				<p>Find out more about JCR by looking at the <a href='specs'>specifications</a> and <a href='tutorial'>tutorial</a>.
				</p>
				<p>You can experiment with JCR using the <a href='checker'>online checker</a>, or by downloading one of the <a href='specs'>implementations</a>.</p>

				<h3>
				<a id="get-involved" class="anchor" href="#get-involved" aria-hidden="true"><span class="octicon octicon-link"></span></a>Get Involved</h3>
				<p>Like JCR and want to know more?  Know of an implementation we can list?  Need help making JCR work for you?  Contact us at 
				<script>mk_e_link('org', 'json-content-rules', 'contact', 'Enter JCR subject:')</script>.</p>

			</section>
		</div>
    </div>
<?php
}
