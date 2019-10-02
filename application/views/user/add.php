<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">User Add</h3>
            </div>
            <?php echo form_open('user/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="user_name" class="control-label"><span class="text-danger">*</span>User Name</label>
						<div class="form-group">
							<input type="text" name="user_name" value="<?php echo $this->input->post('user_name'); ?>" class="form-control" id="user_name" />
							<span class="text-danger"><?php echo form_error('user_name');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="user_email" class="control-label"><span class="text-danger">*</span>User Email</label>
						<div class="form-group">
							<input type="text" name="user_email" value="<?php echo $this->input->post('user_email'); ?>" class="form-control" id="user_email" />
							<span class="text-danger"><?php echo form_error('user_email');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="user_password" class="control-label"><span class="text-danger">*</span>User Password</label>
						<div class="form-group">
							<input type="password" name="user_password" value="<?php echo $this->input->post('user_password'); ?>" class="form-control" id="user_password" />
							<span class="text-danger"><?php echo form_error('user_password');?></span>
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