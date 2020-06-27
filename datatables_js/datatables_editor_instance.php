<?php

/*
* Example PHP implementation used for the index.html example
*/

// DataTables PHP library
include( "./Editor-PHP/php/DataTables.php" );

use
DataTables\Editor,
DataTables\Editor\Field,
DataTables\Editor\Format,
DataTables\Editor\Mjoin,
DataTables\Editor\Options,
DataTables\Editor\Upload,
DataTables\Editor\Validate,
DataTables\Editor\ValidateOptions;



Editor::inst( $db, 'lmr_mysql' )
->fields(
  Field::inst( 'ID' ),
  Field::inst( 'Date' ),
  Field::inst( 'Speaker' ),
  Field::inst( 'Article' ),
  Field::inst( 'Author' ),
  Field::inst( 'Journal' )
  )
  ->process( $_POST )
  ->json();
