<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Edit Group</h3>
            </div>
			<?php echo form_open('group/edit/'.$group['group_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="group_name" class="control-label"><span class="text-danger">*</span>Group Name</label>
						<div class="form-group">
							<input type="text" name="group_name" value="<?php echo ($this->input->post('group_name') ? $this->input->post('group_name') : $group['group_name']); ?>" class="form-control" id="group_name" />
							<span class="text-danger"><?php echo form_error('group_name');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="tournament_name" class="control-label"><span class="text-danger">*</span>Tournament Name</label>
						<div class="form-group">
						<input type="hidden" name="tournament_id" value="<?php echo $all_tournaments[0]['tournament_id'];?>" class="form-control" id="group_name" />
							<input disabled type="text" name="tournament_name" value="<?php $all_tournaments[0]['tournament_id']; print_r($all_tournaments[0]['tournament_name']);?>" class="form-control" id="group_name" />
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
