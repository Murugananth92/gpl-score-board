<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Edit Team</h3>
            </div>
			<?php echo form_open('team/edit/'.$team['team_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="team_name" class="control-label"><span class="text-danger">*</span>Team Name</label>
						<div class="form-group">
							<input type="text" name="team_name" value="<?php echo ($this->input->post('team_name') ? $this->input->post('team_name') : $team['team_name']); ?>" class="form-control" id="team_name" />
							<span class="text-danger"><?php echo form_error('team_name');?></span>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Save
				</button>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>
