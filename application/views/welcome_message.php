<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Mesin pencari</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo base_url();?>assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>assets/css/starter-template.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo base_url();?>assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    	body{
    		padding-top: 50px;
    	}
    	.starter-template {
    		padding: 40px 15px;
    		text-align:center;
    	}
    </style>

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="<?php echo base_url();?>index.php/welcome/profil">Profil</a></li>
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
      <div class="starter-template">
        <h1>Mesin Pencari</h1>
     
          <form id="form_cari" class="navbar-form navbar-centre" method="post">
            <div class="form-group">
              <input name="query" id="query" type="text" size='90' placeholder="Masukan pencarian" class="form-control">
              <br></br>
              <div id="loading"></div>
            <button type="button" onclick="cari(this);"  class="btn btn-success">Telusuri</button>
          </form>
      </div>
        <div class="row">
          <div class="col-ls-12">
          <div id="data"></div>
          </div>
        </div>
          <div id="loading2"></div>
        <hr/>
         <!-- <div class="row"> -->
          <!-- <div class="col-ls-12"> -->
          <div id="data2"></div>
          <!-- </div> -->
        <!-- </div> -->
      </div>  
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo base_url();?>/assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="<?php echo base_url();?>/assets/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url();?>/assets/js/ie10-viewport-bug-workaround.js"></script>
       <script type="text/javascript">
    function cari(){
          str = $("#query").val();
      var n = str.length
        if(n >= 4){
        $.ajax({
            url: "<?php echo site_url();?>/welcome/pencarian",
            type: "POST",
            //dataType:'json',
            data: $("#form_cari").serialize(),
            beforeSend: function(){
                $("#loading").text("Mohon Tunggu Sebentar.."); 
            },
            success:function(data){
                $("#loading").text(""); 
                    $("#data").html(data); 
                
            },
            error:function(data){
                $("#loading").text(data);
            }        
        });
      }else{
         $("#data").html("Mimimal 4 Karakter");
      }
    }

 function details(){

   $.ajax({
            url: "<?php echo site_url();?>/welcome/details",
            type: "POST",
            //dataType:'json',
            data: "details:" + $("#detail").data("query") + "&link="+$("#detail").data("link"),
            beforeSend: function(){
                $("#loading2").text("Mohon Tunggu Sebentar.."); 
            },
            success:function(data){
                $("#loading2").text(""); 
                $("#data2").html(data); 
                
            },
            error:function(data){
                $("#loading").text(data);
            }        
        });
//alert($("#detail").data("query"));
}


    </script>
  </body>
</html>
