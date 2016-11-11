<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My page</title>

    <!-- CSS dependencies -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>

    <p>Content here. <a class="alert" href="www.google.com" >Alert!</a></p>

    <!-- JS dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- bootbox code -->
    <script src="js/bootbox.min.js"></script>
    <script>
        $(document).on("click", ".alert", function(e) {
        	  e.preventDefault();
        	    var $link = $(this);
        	    bootbox.confirm("Are you Sure want to delete!", function (confirmation) {
        	        confirmation && document.location.assign($link.attr('href'));
        	    });     
        });
    </script>
</body>