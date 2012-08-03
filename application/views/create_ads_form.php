<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/home_nav'); ?>
	
	<div id="main" class="wrapper">
	<?php echo validation_errors('<p class="error">'); ?>	
<article>

	<div id ="create_ads_form">	
	
	<h1>Post your ads</h1>
<fieldset>
<legend>Real estate Information</legend>

<?php echo form_open('index.php/members/create_job'); ?>


<legend>Choose Location</legend>
<?php echo form_dropdown('location', $locations, set_value('location')); ?>
<legend>Type</legend>
<?php echo form_dropdown('type', $types, set_value('type')); ?>
<legend>For rent/sale</legend>
<?php $options = array(
                  'rent'  => 'rent',
                  'sale'    => 'sale',
                 );

echo form_dropdown('rs', $options, 'rent', set_value('rs'));
?>
<legend>Price</legend>
<?php echo form_input('price', set_value('price', 'Price')); ?>
<legend>Description/Details</legend>
<?php echo form_textarea('details', set_value('details', 'Details')); ?>
<legend></legend>

<?php echo form_submit('submit', 'Submit');?>
<?php echo form_close();?>
</fieldset>


</div>
</article>

</div><!-- end signup_form-->
			
	

