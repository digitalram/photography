    // Create a jquery plugin that prints the given element.
    jQuery.fn.print = function(){
    // NOTE: We are trimming the jQuery collection down to the
    // first element in the collection.
    if (this.size() > 1){
    this.eq( 0 ).print();
    return;
    } else if (!this.size()){
    return;
    }
     
    // ASSERT: At this point, we know that the current jQuery
    // collection (as defined by THIS), contains only one
    // printable element.
     
    // Create a random name for the print frame.
    var strFrameName = ("printer-" + (new Date()).getTime());
     
    // Create an iFrame with the new name.
    var jFrame = $( "<iframe name='" + strFrameName + "'>" );
     
    // Hide the frame (sort of) and attach to the body.
    jFrame
    .css( "width", "1px" )
    .css( "height", "1px" )
    .css( "position", "absolute" )
    .css( "left", "-9999px" )
    .appendTo( $( "body:first" ) )
    ;
     
    // Get a FRAMES reference to the new frame.
    var objFrame = window.frames[ strFrameName ];
     
    // Get a reference to the DOM in the new frame.
    var objDoc = objFrame.document;
     
    // Grab all the style tags and copy to the new
    // document so that we capture look and feel of
    // the current document.
     
    // Create a temp document DIV to hold the style tags.
    // This is the only way I could find to get the style
    // tags into IE.
    var jStyleDiv = $( "<div>" ).append(
    $( "style" ).clone()
    );
     
    // Write the HTML for the document. In this, we will
    // write out the HTML of the current element.
    objDoc.open();
    objDoc.write( "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">" );
    objDoc.write( "<html>" );
    objDoc.write( "<head>" );
    objDoc.write( "<title>" );
    objDoc.write( document.title );
    objDoc.write( "</title>" );
    objDoc.write( jStyleDiv.html() );
	objDoc.write('<style type="text/css">');
	objDoc.write('#wrapper{	margin:0px auto;	width:100%;	min-width:800px;	margin-bottom:40px; }');
	objDoc.write('#wrapper .schedule{	padding-top:30px;	margin:0px 0px 0px 50px;	text-align:left; }');
	objDoc.write('#wrapper .schedule h1:first-child{	margin-top:0px; }');
	objDoc.write('#wrapper .schedule h1{	font-size:60px;		color:white;}');
	objDoc.write('#wrapper .schedule .section{	vertical-align: top;	width:325px;	min-height:275px;	display:inline-block;	padding:10px 10px; border:1px solid black;	background-color:white; } #wrapper .schedule .section h2{	margin:0px 20px;	font-size:20px; } #wrapper .schedule .section p.day, #wrapper .schedule .section p.table{	text-align:left;	display:inline-block;	padding-left:40px;	margin:2px;	font-style:italic; } #wrapper .schedule .section p.day{	padding-right:20px;	float:right;} #wrapper .schedule .section ul{	margin:0px;		padding:0px;} #wrapper .schedule .section ul li{ 	list-style-type:none;		width:100%;	padding:8px 0px;	margin-left:0px;	overflow:hidden; } #wrapper .schedule .section ul li:nth-child(even){ 	background-color:#EEE; } #wrapper .schedule .section ul li p{	font-size:16px;	display:inline-block;	padding:0px;	margin:0px;	} #wrapper .schedule .section ul li p.name{	text-align:left;	padding-left:30px;	width:230px; } #wrapper .schedule .section ul li p.time{	float:right;	text-align:left; width:60px; }');
	objDoc.write('</style>');
    objDoc.write( "</head>" );
	objDoc.write( '<body><div id="wrapper">' );
    objDoc.write( this.html() );
    objDoc.write( "</div></body>" );
    objDoc.write( "</html>" );
    objDoc.close();
     
    // Print the document.
    objFrame.focus();
    objFrame.print();
     
    // Have the frame remove itself in about a minute so that
    // we don't build up too many of these frames.
    setTimeout(
    function(){
    jFrame.remove();
    },
    (60 * 1000)
    );
    }