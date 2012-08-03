<?php $this->load->view('includes/header'); ?>

<?php $this->load->view('includes/nostrong_nav'); ?>
<?php $this->load->view('includes/aside'); ?>

<!--   <article> -->
<header>
    <h3>Properties For Rent</h3>
    <article>
        <section class="info_indiv">

                <?php
                if (isset($rows) && count($rows)):
                    foreach ($rows as $row) :
                        ?>
                        Location:  <?php echo $row->location ?>
                        <br />Type:  <?php echo $row->type ?>
                        <br />Price:  <?php echo $row->price ?> AED
                        <br />
                      <?php  echo anchor('site/get_house_by_id1/' . $row->id, 'more...', 'title="News title"'); ?>

                        <br /><br /><br />
                    <?php endforeach;
                else: ?>
                    <div id="blank_gallery">Error displaying the ad.</div>

                <?php endif; ?>

                <div class="clearfix"></div>


                <br />
            </section>
        <section>
         <?php  // echo $this->table->generate($rows); ?>
        
        <?php echo $this->pagination->create_links(); ?>
        </section>
    </article>