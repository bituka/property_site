<!DOCTYPE html>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/nostrong_nav'); ?>
<div id="main" class="wrapper">
    <aside>
        <h5>Hi <?php echo $this->session->userdata('email_add'); ?>!</h5>
        <?php echo anchor('login/logout', 'Logout'); ?>
    </aside>
    
    <article>
        <?php echo form_open('properties/delete_photo_c'); ?>
        
        <h4>Select photos you want to delete.</h4>    
        
        <?php
        if (isset($images) && count($images === !null)):
            foreach ($images as $image) :
        ?>              
                <div id="photos">
                    
                    
                    <?php //TODO echo anchor(base_url(). 'upload_images/' . $image->filename , img('upload_images/'. $image->filename])); ?> 
                   
                    <img src = <?php echo base_url() ?>upload_images/<?php echo $image->filename ?> /> 
                         <div id="photos_info">
                                                  <?php echo form_checkbox('check_file[]', $image->filename); ?>                       

                             <?php // echo anchor('properties/delete_photo_c/' . $image->filename, 'Delete Photo') ?> 
                             
                      </div>  
                </div>     
                
            <?php endforeach;
            echo '<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /> ';
            echo form_submit('submit', 'Delete');
            echo  form_close();
        else: ?>
            <div id="blank_gallery">No photos to delete.</div>
        <?php endif; ?>
        
        <br />
        <section id="info">

        </section>

      
</article>


</div><!-- end wrapper-->

<?php // $this->load->view('includes/footer'); ?>

