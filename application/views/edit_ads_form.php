<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('includes/nostrong_nav'); ?>
	
	<div id="main" class="wrapper">
	<?php echo validation_errors('<p class="error">'); ?>	
<article>

	<div id ="create_ads_form">	
	
	<h1>Post your ads</h1>
<fieldset>
<legend>Real estate Information</legend>

<?php echo form_open('properties/edit_ads_c'); ?>
<?php //if (isset($rows) && count($rows)):
//print_r($rows);
//foreach ($rows as $r):
echo form_hidden('user_id', $rows[0]->id);
echo form_hidden('house_id', $house_selected['id']);
//echo $house['location']; 
//endforeach;
/*
foreach ($house as $hselected):
    echo $hselected->location;
endforeach;
 */
?>

<legend>Choose Location</legend>
<?php echo form_dropdown('location', $locations, $house_selected['location']); ?> 
<legend>Type</legend>
<?php echo form_dropdown('type', $types, $house_selected['type']); ?>
<legend>For rent/sale</legend>
<?php $options = array(
                  'rent'  => 'rent',
                  'sale'    => 'sale',
                 );

echo form_dropdown('rs', $options, 'rent', $house_selected['rs']);
?>
<legend>Price</legend>
<?php echo form_input('price', set_value('price', $house_selected['price'])); ?>
<legend>Description/Details</legend>
<?php echo form_textarea('details', set_value('details', $house_selected['details'])); ?>
<legend></legend>
<?php echo form_submit('submit', 'Update');?>
<?php echo form_close();?>
</fieldset>


</div>
</article>

</div><!-- end signup_form-->
			
	

