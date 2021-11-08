<?php
/*Template name: Adding new believer */
get_header();
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();
 
            // Include the page content template.
            get_template_part( 'template-parts/content', 'page' );
 
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
 
            // End of the loop.
        endwhile;
        ?>
 
    </main><!-- .site-main -->
 
   
</div><!-- .content-area -->
 
<div class="user-form">
<form method="post" class="form-container" id="form">
<div class=" formcontrol">
<div class="col ">
<label for="name">Firstname</label>
</div>
<div class="col">
<input type="text" placeholder="Firstname"  class="formcontrol" id="validationDefault01" name='Firstname' required>
<i class="fas fa-check-circle"></i>
<i class="fas fa-exclamation-circle"></i>
<small>Error message</small>
</div>
</div>
<div class=" formcontrol ">
<div class="col">
<label for="name">Lastname</label>
</div>
<div class="col">
<input type="text" placeholder="Lastname (optional)"  class="formcontrol" id="validationDefault02" name='Lastname' >
<i class="fas fa-check-circle"></i>
<i class="fas fa-exclamation-circle"></i>
<small>Error message</small>
</div>
<div class=" formcontrol ">
<div class="col">
<label for="name">Mobile Number</label>
</div>
<div class="col">
<input type="tel" placeholder="91XXXXXXXXXX"  class="formcontrol" id="validationDefault03" name='Mnumber' required>
<i class="fas fa-check-circle"></i>
<i class="fas fa-exclamation-circle"></i>
<small>Error message</small>

<?php
$number = isset ($_POST['Mnumber']);
if($number){
  $mobile = array("phone" =>$_POST['Mnumber']); 
  $body = json_encode($mobile);
  $headers = array(
    'content-type' => 'application/json',
    'Token' => '11b77007d28fa4dcaf0ae2a040317ef9dada8be0664b01f5b83995dd7599b90066803bcc2500a810'
  );
  $args = array(
    'body' => $body,
    'headers' => $headers,
  );
  $response = wp_remote_post('https://api.wassenger.com/v1/numbers/exists',$args);
  $res= $response['body'];
  // Decode the JSON file
  $json_data = json_decode($res,true); 
}
?>
</div>
<div class=" formcontrol ">
<div class="col">
<label for="name">Gender</label>
</div>
<div class="col">
<select class="form-select" id="validationDefault04" name='gender' required>
      <option selected disabled value="male">Choose your Gender</option>
      <option>Male</option>
      <option>Female</option>
    </select><br>
<i class="fas fa-check-circle"></i>
<i class="fas fa-exclamation-circle"></i>
<small>Error message</small>
</div>

<div class=" formcontrol ">
<div class="col">
<label for="reason">REASON TO ATTEND THE CHURCH</label>
</div>
<div class="col">

<select class="form-select" id="validationDefault05" name='reason' required><br/>
      <option selected disabled value="">Choose...</option>
      <option>Sugam</option>
      <option>Asirvatham</option>
      <option>Samathanam</option>
      <option>Anbu</option>
      <option>Nithyavazhlvu</option>
      <option>Manamthirumbuthal</option>
      <option>Viduthalai</option>
    </select>
<br>
<i class="fas fa-check-circle"></i>
<i class="fas fa-exclamation-circle"></i>
<small>Error message</small>
</div>

</div>

<button class="btn btn-primary" type="submit" name='submitbtn' id='submitbutton' > Add New Believer </button>
</form>

<?php
$current_user = wp_get_current_user();
$id =$current_user->ID;
if(isset($_POST['submitbtn'])){
  $data = array(
    'Firstname' => $_POST['Firstname'],
    'Lastname' => $_POST['Lastname'],
    'phoneno' => $_POST['Mnumber'],
    'gender' => $_POST['gender'],
    'Category' => $_POST['reason'],
    'user_id' => $id
  );
  $table_name = 'wp_newbeleiver';
  $result = $wpdb -> insert($table_name,$data,$format = null);
  if($result==1){
    echo '<meta http-equiv="refresh" content="0;url=https://mylogin.churchgrowthfollowupministry.org/add-new-believer-2/" />';
  }else{
    echo '<meta http-equiv="refresh" content="0;url=https://mylogin.churchgrowthfollowupministry.org/404-error/" />';
  }
}
?>


<?php 
get_footer();
?>