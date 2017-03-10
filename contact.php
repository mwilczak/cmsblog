<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>


   <?php



    if(isset($_POST['submit'])){

        $submit = $_POST['submit'];
        
        $to = 'mwilczak88@gmail.com';
        $subject = wordwrap($_POST['subject'], 70);
        $body = $_POST['body'];
//        $header = "From: " . $_POST['email'];
//$header =  'MIME-Version: 1.0' . "\r\n"; 
//$header .= 'From: '.  $_POST['email'] . "\r\n";
//$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        mail($to, $subject, $body, $header );

    
      if(!$submit) {
                
                die ("Failed");
            }
            
        $message = 'Wysłano mail';
     
        }else {
            
        $message = 'Pola nie mogą być puste';
        }






?>
   

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1 class="text-center">Contact</h1>
                <h6 class="text-center"><?php echo $message;?></h6>   
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                        </div>
                         <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
                        </div>                         
                        <div class="form-group">
                                <textarea class="form-control" name="body" id="body" cols="50" rows="10"></textarea>
                        </div>


                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send Message">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
