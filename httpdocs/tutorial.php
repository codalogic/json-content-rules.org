<?php
$config = array(
			"title" => "JSON Content Rules (JCR) Tutorial",
			"menu_key" => "tutorial",
			"meta_keywords" => "JSON, Schema, JCR, IETF, validator",
			"meta_description" => "JSON Content Rules (JCR) Tutorial" );

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
			  <h1>JCR Tutorial</h1>
			</header>

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
				<p>It can be described using JCR as:</p>
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
			this is done in the group named <code>$dimensions</code>:
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
		<p>
			Or, perhaps the entire <code>"Thumbnail"</code> member could be
			extracted into a separate rule:
		</p>
<pre>
{
    "Image" : {
        $dimensions,
        "Title" : string,
        $thumbnail,
        "Animated" : boolean,
        "IDs" : [ $id * ]
    }
}

$thumbnail =
    "Thumbnail" : {
        "Url" : uri,
        $dimensions
    }

$dimensions = ( $width, $height )
$width = "Width" : 0..1280
$height = "Height" : 0..1024
$id = integer
</pre>
		<p>
			If the <code>"Thumbnail"</code> member was optional, this can be
			indicated using the Kleene <code>?</code> operator:
		</p>
<pre>
{
    "Image" : {
        $dimensions,
        "Title" : string,
        $thumbnail ?,
        "Animated" : boolean,
        "IDs" : [ $id * ]
    }
}

$thumbnail =
    "Thumbnail" : {
        "Url" : uri,
        $dimensions
    }

$dimensions = ( $width, $height )
$width = "Width" : 0..1280
$height = "Height" : 0..1024
$id = integer
</pre>
		<p>
			JCR allows modular message specification using <code>#import</code> directives.  As screen and image dimensions
			might be a common, cross-protocol feature, they can be separated into a separate module.
			Such a module would be incorporated into the example as:
		</p>
<pre>
#import org.ietf.geometry as geometry

{
    "Image" : {
        $geometry.dimensions,
        "Title" : string,
        $thumbnail ?,
        "Animated" : boolean,
        "IDs" : [ $id * ]
    }
}

$thumbnail =
    "Thumbnail" : {
        "Url" : uri,
        $geometry.dimensions
    }

$id = integer
</pre>
		<p>
			Where <code>org.ietf.geometry</code> might be defined as:
		</p>
<pre>
#ruleset-id org.ietf.geometry

$dimensions = ( $width, $height )
$width = "Width" : 0..1280
$height = "Height" : 0..1024
</pre>
		<p>
			JCR has many more features to help protocol and software developers.  Have a look at the <a href='specs'>specification</a> to
			find out more.
		</p>

        </div>
    </div>
<?php
}
