<?php
// Conditionally compiles any specified LESS files that have been modified
// into CSS using lessphp from https://github.com/leafo/lessphp .
//
// $file_bases is an array containing the base names of files to convert
// without the extensions.  For example:
//    compile_less( array( "codalogic", "lmx" ) );
// will convert 'codalogic.less' to 'codalogic.css' and 'lmx.less' to lmx.css'.

function compile_less( $file_bases )
{
    if( (@include "lessc.inc.php") !== FALSE ) {    // Absence of lessc.inc.php on production server means "don't attempt to compile LESS on the fly"
        $formatter = new lessc_formatter_lessjs;
        $formatter->break = "\r\n";

        $less = new lessc;
        $less->setFormatter( $formatter );
        foreach( $file_bases as $base )
            $less->checkedCompile( "$base.less", "$base.css" );
    }
}
?>
