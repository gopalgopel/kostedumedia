<script type="text/javascript">
	$(document).ready(function(){
		$('#saveBtn').click(function (){
			var edit = $.trim($(this).prop('value')).toLowerCase();

			if( edit==='edit'){
				$(this).prop('value', 'Save');
				$('input[type=text]').prop('readonly',false);
				return false;
			}else{
				var form = $('input[type=submit]').closest("form");
				form.submit();
			}
		});

		$('#cancelBtn').click(function(){
			window.location = '<?php echo base_url()?>admin/personnel_ctrl'
		});
	});
</script>



<div class="span12 block">			
	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>					
		<h2>personnel Data Editor</h2>
	</div>		<!-- .block_head ends -->		
	<?php if(strlen(validation_errors())>0){?>
		<div class="message errormsg" style="display: block; ">
			<p>There still error in form entry, please fix it</p>
		</div>
	<?php }?>
	<div class="block_content">
				<form action="<?php echo base_url()?>admin/personnel_ctrl/save" method="post">
					<p>
						<label>per_id * </label><br/>
						<input name="per_id" type="text"
						value="<?php if(!empty($obj)) echo $obj->per_id; ?>" <?php if(!empty($obj)) echo 'readonly'?>>
						<?php echo form_error('per_id');?>					</p>
<p>
						<label>ship_stat_id * </label><br/>
						<input name="ship_stat_id" type="text"
						value="<?php if(!empty($obj)) echo $obj->ship_stat_id; ?>" <?php if(!empty($obj)) echo 'readonly'?>>
						<?php echo form_error('ship_stat_id');?>					</p>
<p>
						<label>imo * </label><br/>
						<input name="imo" type="text"
						value="<?php if(!empty($obj)) echo $obj->imo; ?>" <?php if(!empty($obj)) echo 'readonly'?>>
						<?php echo form_error('imo');?>					</p>
<p>
						<label>hull_number * </label><br/>
						<input name="hull_number" type="text"
						value="<?php if(!empty($obj)) echo $obj->hull_number; ?>" <?php if(!empty($obj)) echo 'readonly'?>>
						<?php echo form_error('hull_number');?>					</p>
<p>
						<label>per_name * </label><br/>
						<input name="per_name" type="text"
						value="<?php if(!empty($obj)) echo $obj->per_name; ?>" <?php if(!empty($obj)) echo 'readonly'?>>
						<?php echo form_error('per_name');?>					</p>
<p>
						<label>is_captain * </label><br/>
						<input name="is_captain" type="text"
						value="<?php if(!empty($obj)) echo $obj->is_captain; ?>" <?php if(!empty($obj)) echo 'readonly'?>>
						<?php echo form_error('is_captain');?>					</p>

					<p>
						<input id="saveBtn" type="submit" class="submit small" value="<?php if(empty($obj)) echo 'Save'; else echo 'Edit' ;?> ">
						<input id="cancelBtn" type="reset" class="submit small" value="Cancel">
					</p>

				</form>					
	</div>		<!-- .block_content ends -->				
	<div class="bendl"></div>
	<div class="bendr"></div>					
</div>