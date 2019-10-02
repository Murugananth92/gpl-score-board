<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Tournament Add</h3>
            </div>
            <?php echo form_open('tournament/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="tournament_name" class="control-label"><span class="text-danger">*</span>Tournament Name</label>
						<div class="form-group">
							<input type="text" name="tournament_name" value="<?php echo $this->input->post('tournament_name'); ?>" class="form-control" id="tournament_name" />
							<span class="text-danger"><?php echo form_error('tournament_name');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="tournament_year" class="control-label"><span class="text-danger">*</span>Tournament Year</label>
						<div class="form-group">
							<input type="text" name="tournament_year" value="<?php echo $this->input->post('tournament_year'); ?>" class="form-control" id="tournament_year" />
							<span class="text-danger"><?php echo form_error('tournament_year');?></span>
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