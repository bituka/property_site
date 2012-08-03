<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/home_nav'); ?>

<div id="main" class="wrapper">

    <article>
        <div id="pics">
            <?php
            if (isset($images) && count($images === !null)):
                foreach ($images as $image) :
                    if (($image->house_id === $this->uri->segment(3)) && ($image->user_id === $this->session->userdata('user_id'))):
                        // echo $image->filename;
                        ?>
                        <img src = <?php echo base_url() ?>upload_images/<?php echo $image->filename ?> />                   	 

                         <?php endif; ?>

                     <?php endforeach;
                 else: ?>
                     <div id="blank_gallery">No Image yet.</div>
			<?php endif; ?>

        </div>    


        <div id ="create_ads_form">
            <h1>Upload up to 3 images.</h1>
            <fieldset>
                <legend></legend>
                <?php
                if ($error) { //displaying the filename having the error
                    echo "<p class='error'>Error uploading file name: " . $filename . "</p>";
                }

                echo $error;
                ?>

                <?php
                echo form_open_multipart('properties/do_upload');                
                echo form_hidden('user_id', $rows[0]->id);
                echo form_hidden('house_id', $this->uri->segment(3));
                //  echo form_hidden('user_id', $rows[0]->id);
                ?>
                <legend></legend>

<!--  <input type="file" name="userfile" size="20" />  -->
                <br /><?php echo form_upload('userfile[]'); ?><br />
                <br /><?php echo form_upload('userfile[]'); ?><br />
                <br /><?php echo form_upload('userfile[]'); ?><br />

                <br /><br />

                <input type="submit" name="go" value="upload" />
                <?php echo anchor('site/members_area', 'Go back to profile page'); ?>
<?php echo form_close(); ?>

            </fieldset>


        </div>
    </article>

</div><!-- end signup_form-->


