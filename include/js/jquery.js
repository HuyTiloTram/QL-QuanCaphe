/*! jQuery v1.12.4 | (c) jQuery Foundation | jquery.org/license | WordPress 2019-05-16 */
$( "div" ).click(function() {
  var color = $( this ).css( "background-color" );
  $( "p" ).html( "That div is " + color + "." );
});
