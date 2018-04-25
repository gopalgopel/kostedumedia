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
			window.location = '<?php echo base_url()?>admin/operation_ctrl'
		});
	});
</script>



<div class="span12 block">			
	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>					
		<h2>operation Data Editor</h2>
	</div>		<!-- .block_head ends -->		
	<?php if(strlen(validation_errors())>0){?>
		<div class="message errormsg" style="display: block; ">
			<p>There still error in form entry, please fix it</p>
		</div>
	<?php }?>
	<div class="block_content">
				<form action="<?php echo base_url()?>admin/operation_ctrl/save" method="post">
					<p>
						<label>operation_id * </label><br/>
						<input name="operation_id" type="text"
						value="<?php if(!empty($obj)) echo $obj->operation_id; ?>" <?php if(!empty($obj)) echo 'readonly'?>>
						<?php echo form_error('operation_id');?>					</p>
<p>
						<label>operation_name * </label><br/>
						<input name="operation_name" type="text"
						value="<?php if(!empty($obj)) echo $obj->operation_name; ?>" >
						<?php echo form_error('operation_name');?>					</p>
<p>
						<label>operation_description * </label><br/>
						<input name="operation_description" type="text"
						value="<?php if(!empty($obj)) echo $obj->operation_description; ?>" >
						<?php echo form_error('operation_description');?>					</p>
<p>
						<label>operation_start * </label><br/>
						<input name="operation_start" type="text"
						value="<?php if(!empty($obj)) echo $obj->operation_start; ?>" >
						<?php echo form_error('operation_start');?>					</p>
<p>
						<label>operation_end * </label><br/>
						<input name="operation_end" type="text"
						value="<?php if(!empty($obj)) echo $obj->operation_end; ?>" >
						<?php echo form_error('operation_end');?>					</p>

					<p>
						<input id="saveBtn" type="submit" class="submit small" value="<?php if(empty($obj)) echo 'Save'; else echo 'Edit' ;?> ">
						<input id="cancelBtn" type="reset" class="submit small" value="Cancel">
					</p>

				</form>					
	</div>		<!-- .block_content ends -->				
	<div class="bendl"></div>
	<div class="bendr"></div>					
</div>