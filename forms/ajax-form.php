<?php
/*
* Template Name: Ajax Form
*/
get_header();
?>
<div class="container">
    <div class="row">
        <div class="col-lg-8" role="main" id="main">
            <?php while(have_posts()):the_post(); ?>
            <form id="applicant-form" enctype="multipart/form-data" method="POST" action="<?php echo admin_url('admin-ajax.php'); ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" name="applicant_email" class="form-control" id="inputEmail4" placeholder="Email">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Password</label>
                        <input type="password" name="applicant_password" class="form-control" id="inputPassword4" placeholder="Password">
                    </div>
                </div> 
                <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputAddress">Address</label>
                    <input type="text" name="applicant_inputAddress" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputAddress2">Address 2</label>
                    <input type="text" name="applicant_inputAddress2" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>
                </div>

                <div class="form-row ">
                    <div class="form-group col-md-6">
                        <label for="inputCity">City</label>
                        <input type="text" name="applicant_inputCity" class="form-control" id="inputCity">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputState">State</label>
                        <select id="inputState" name="applicant_inputState" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputZip">Zip</label>
                        <input type="text" name="applicant_inputZip" class="form-control" id="inputZip">
                    </div>
                </div>
               <!--  <div class="form-group">
                    <div class="form-check">
                        <input name="applicant_gridCheck" class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Check me out
                        </label>
                    </div>
                </div> -->
                <div class="form-group">
    <label for="exampleFormControlFile1">Example file input</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1">
  </div>
                <input type="hidden" name="action" value="create_applicant">
                <button type="submit" name="applicant_submit" class="btn btn-primary">Sign in</button>
            </form>
            <?php endwhile; ?>
</div>
    </div>
</div>

<?php get_footer();
?>
<script type="text/javascript">
jQuery(document).ready(function($){
    $("#applicant-form").ajaxForm({

        success: function(response){
            console.log(response);
        },
        error: function(response){
            console.log(response);

        },
        uploadProgress(event, position, total, percentComplete){
            console.log(percentComplete);

        },
        resetForm: true
    });
});
</script>
