<?php $this->load->view('includes/nostrong_nav'); ?>
<?php $this->load->view('includes/aside'); ?>

<!-- start of the main content -->       

<article>
    <h3>Property ad details:</h3>
<section>
    <h4>Photos</h4>
    <br />
    <!-- Slideshow HTML -->
    <div id="slideshow">
        <div id="slidesContainer">
            <?php
            if (isset($images) && count($images)):
                foreach ($images as $image) :
                    ?>
                    <div class="slide" id="big_photos2">
                        <img src="<?php echo base_url() . 'upload_images/' . $image->filename ?> " alt="" />                                         
                    </div>

                <?php endforeach;
            else: ?>
                <div id="blank_gallery"> Error on photos. </div>

            <?php endif; ?>

        </div>
    </div>

    <!-- Slideshow HTML -->
    <!--
    <div id="big_photos">
        <img src = "http://localhost/site/upload_images/toilet-house.jpg" />
        <br />                  
        <img src = "http://localhost/site/upload_images/toilet-house.jpg" />
    </div>
    -->
</section>  

<br /> <br /><br /> <br /><br /> 
 
<section id="info" class="info_indiv">
    <?php
    if (isset($rows) && count($rows)):
        foreach ($rows as $row) :
            ?>
            <br /><h4>For  <?php echo $row->rs ?></h4>
            Location:  <?php echo $row->location ?>
            <br />Type:  <?php echo $row->type ?>
            <br />Price:  <?php echo $row->price ?> AED
            <br />Details:  <?php echo $row->details ?>

        <?php endforeach;
    else: ?>
        <div id="blank_gallery">Error displaying the ad.</div>

    <?php endif; ?>

    <div class="clearfix"></div>

    <br />
</section>

 </article>
</div><!-- end wrapper-->









