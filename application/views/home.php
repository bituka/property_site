<?php $this->load->view('includes/header'); ?>
        <?php $this->load->view('includes/home_nav'); ?>
        <?php $this->load->view('includes/aside'); ?>

        <!--   <article> -->
        <header>
            <h3>Recently Uploaded Property ads</h3>

            <div id="featured" >
                <ul class="ui-tabs-nav">

                    <?php
                    if (isset($house_slide) && count($house_slide)):
                        foreach ($house_slide as $h_slide) :
                            ?>
                            <li class="ui-tabs-nav-item" id="nav-fragment-<?php echo $h_slide['id'] ?>"><a href="#fragment-<?php echo $h_slide['id'] ?>"><img src="<?php echo base_url() . 'upload_images/' . $h_slide['photo'] ?>" alt="" /><span><?php echo $h_slide['details'] ?> </span></a></li>
                        <?php endforeach;
                    else: ?>
                        <div id="blank_gallery">Error in slide pic.</div>

                    <?php endif; ?>

                </ul>

                <?php
                if (isset($house_slide) && count($house_slide)):
                    foreach ($house_slide as $h_slide) :
                        ?>
                        
                        <div id="fragment-<?php echo $h_slide['id'] ?>" class="ui-tabs-panel ui-tabs-hide" style="">          
                            <a href=<?php echo base_url() . "site/get_house_by_id1/" . $h_slide['id'] . '/' ?>><img src="<?php echo base_url() . 'upload_images/' . $h_slide['photo'] ?>" alt="" /></a>
                            <div class="info" >
                                <h2>For <?php echo $h_slide['rs'] ?></h2>
                                <p><?php echo $h_slide['details'] ?></p>
                            </div>

                        </div>
                            
                    <?php endforeach;
                else: ?>
                    <div id="blank_gallery">Error in slide pic.</div>

                <?php endif; ?>

                <div id="slidesContainer">
                    <div id="slides">
                        <?php
//                
//                foreach ($house_details as $key => $hdetails) {
//                    echo '<section id="slide">';
//                    echo '<img alt= ' . $hdetails['photo'] . ' src="' . base_url() . 'upload_images/' . $hdetails['photo'] . ' " />';
//                    echo '<p> ' . $hdetails['details'] . '</p>';
//                    echo '</section>';
//                    echo '<div class="clearfix"></div>';
//                }
                        ?>
                    </div></div>

                <div class="clearfix"></div>
        </header>
        <!--  </article> -->
        <div class="clearfix"></div>
        <article>
            <h4>Browse the web.</h4>
            <?php
        echo form_open('');
        echo anchor('site/public_rent', 'Properties For Rent');
        echo '&nbsp;';
        echo anchor('login/forgot_password', 'Properties For Sale');
        echo form_close();
            ?>
        </article>

    </div>


