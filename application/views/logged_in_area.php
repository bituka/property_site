<!DOCTYPE html>
<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/nostrong_nav'); ?>
<div id="main" class="wrapper">
    <aside>
        <h5>Hi <?php echo $this->session->userdata('email_add'); ?>!</h5>
        <?php echo anchor('login/logout', 'Logout'); ?>
    </aside>

    <article>
    	
		<h3>My Profile Info</h3>    
    	<section>
    		<?php 
    		if(isset($profile) && count($profile)):
    		foreach ($profile as $prof) :
    		
    		?>
    		Username / Email: <?php echo $prof->email_add ?> 
    	<br />	First Name:  <?php echo $prof->first_name ?>
    	<br />	Last Name: <?php echo $prof->last_name ?>
    	<br /> 	Phone Number: <?php echo $prof->phone_number ?>
                                        
            <?php endforeach;
            else: ?>
                        <div id="blank_gallery">Error in Profile Details.</div>
    		
    		<?php endif; ?>
    		
    	
    	</section>
        <br /><br /><br /><br />        
        <h3>My Property Ads</h3>
		
		
		
        <?php if (isset($rows)):
            foreach ($rows as $r) : ?>
                <div id="records">
                </div>	
                
                    <?php
                    if (isset($images) && count($images === !null)):
                        foreach ($images as $image) :
                            if (($image->house_id === $r->id) &&  ($image->user_id === $this->session->userdata('user_id'))):
                              // echo $image->filename;
                                ?>
                                    <div id="photos">
                                    <img src = <?php echo base_url() ?>upload_images/<?php echo $image->filename ?> />                   	 
                                    <div id="photos_info"> 
                                    <?php // echo anchor('properties/delete_photo_c/' . $image->filename, 'Delete Photo') ?> 
                                    </div>  
                                    </div>     
                            <?php endif; ?>
                                        
                    <?php endforeach;
                    else: ?>
                        <div id="blank_gallery">No Image yet.</div>
        <?php endif; ?>
                 
                <br />
                <section id="info">
                    <br /><b>ID:</b> <?php echo $r->id; ?>  	
                    <br /><b>Location:</b> <?php echo $r->location; ?> 
                    <br /><b>Type:</b> <?php echo $r->type; ?> 
                    <br /><b>Price:</b> <?php echo $r->price; ?>
                    <br /><b>Details:</b> <?php echo $r->details; ?>  
                    
                    <br /><br /><?php echo anchor('properties/upload_photos_c/' . $r->id, 'Upload Photos') ?>
                    <?php echo anchor('properties/edit_info_c/' . $r->id, 'Edit Details') ?>
                    <?php echo anchor('properties/delete_info_c/' . $r->id, 'Delete Ad') ?>
                    <?php echo anchor('properties/delete_photopage/' . $r->id, 'Delete Photos') ?>
                  
                </section>
                      
                <hr />

    <?php endforeach; ?>
            <br /><br />

    <?php echo anchor('properties', 'Click here'); ?> to upload more property ads.</div>
<?php else: ?>
    <div id="blank_records">No ads yet. <?php echo anchor('properties', 'Click here'); ?> to upload property ads.</div>
<?php endif; ?>


</article>


</div><!-- end wrapper-->

<?php $this->load->view('includes/footer'); ?>

