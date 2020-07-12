<?php echo form_open('config/save_tab/', array('id' => 'tab_config_form', 'class' => 'form-horizontal')); ?>
    <div id="config_wrapper">
        <fieldset id="config_info">
            <div id="required_fields_message"><?php echo $this->lang->line('common_fields_required_message'); ?></div>
            <ul id="tab_error_message_box" class="error_message_box"></ul>

			<div class="form-group form-group-sm">	
				<?php echo form_label($this->lang->line('config_tab_enbabled'), 'tab_enable', array('class' => 'control-label col-xs-2')); ?>
				<div class='col-xs-1'>
					<?php echo form_checkbox(array(
						'name' => 'tab_enable',
						'value' => 'table_enable',
						'id' => 'table_enable',
						'checked' => $this->config->item('enable_tabs')));?>
				</div>
			</div>
            
            <?php echo form_submit(array(
                'name' => 'submit_table',
                'id' => 'submit_table',
                'value' => $this->lang->line('common_submit'),
                'class' => 'btn btn-primary btn-sm pull-right')); ?>
        </fieldset>
    </div>
<?php echo form_close(); ?>

<script type="text/javascript">
//validation and submit handling
$(document).ready(function()
{
	$('#tab_config_form').validate($.extend(form_support.handler, {
		submitHandler: function(form) {
			$(form).ajaxSubmit({
				success: function(response)	{
					$.notify({ message: response.message }, { type: response.success ? 'success' : 'danger'});
				},
				dataType: 'json'
			});
		},
		errorLabelContainer: "#tab_error_message_box",
	}));
});
</script>
