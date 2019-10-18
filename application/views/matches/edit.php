hiiihiii

<?php
		// echo"<pre>";
		// print_r($all_matches);
        // die;

?>

<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">edit match</h3>
            </div>
            <?php echo form_open(); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="team_1" class="control-label"><span class="text-danger">*</span>Team_1 Name</label>
						<div class="form-group">
                        <select name="team_1" class='form-control' id="team_1">
							<option value="">select team</option>
							<?php 
							foreach($all_teams as $team)
							{
								$selected = ($team['team_id'] == $all_matches[0]['team_1']) ? ' selected="selected"' : "";

								echo '<option value="'.$team['team_id'].'" '.$selected.'>'.$team['team_name'].'</option>';
							} 
							?>
						</select>
							<span class="text-danger"><?php echo form_error('team_1');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="team_2" class="control-label"><span class="text-danger">*</span>Team_2 Name</label>
						<div class="form-group">
                        <select name="team_2" class='form-control' id="team_2">
							<option value="">select team</option>
							<?php 
							foreach($all_teams as $team)
							{
								$selected = ($team['team_id'] == $all_matches[0]['team_2']) ? ' selected="selected"' : "";

								echo '<option value="'.$team['team_id'].'" '.$selected.'>'.$team['team_name'].'</option>';
							} 
							?>
						</select>
							<span class="text-danger"><?php echo form_error('team_2');?></span>
						</div>
					</div>
					<div class="col-md-6">
						<label for="match_date" class="control-label"><span class="text-danger">*</span>Match_date</label>
                        <input type="date" name="match_date" value="<?php echo ($this->input->post('match_date') ? $this->input->post('match_date') : $all_matches[0]['match_date']);?>" class="form-control" id="match_date" />						
						<span class="text-danger"><?php echo form_error('match_date');?></span>
					</div>
					<div class="col-md-6">
						<label for="match_venue" class="control-label"><span class="text-danger">*</span>Match_venue</label>
						<div class="form-group">
							<input type="text" name="match_venue" value="<?php echo ($this->input->post('match_venue') ? $this->input->post('match_venue') : $all_matches[0]['match_venue']);?>" class="form-control" id="match_venue" />
							<span class="text-danger"><?php echo form_error('match_venue');?></span>
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


<script>
$(document).ready(function() {
	$('#team_1').on('change',function(){
		var team_1 = $(this).val();
		$("#team_2 option").attr('disabled','disabled')
        .siblings().removeAttr('disabled');
		$("#team_2 option[value='"+ team_1 + "']").attr('disabled', true); 
	});

	$('#team_2').on('change',function(){
		var team_2 = $(this).val();
		$("#team_1 option").attr('disabled','disabled')
        .siblings().removeAttr('disabled');
		$("#team_1 option[value='"+ team_2 + "']").attr('disabled', true); 
	});
});
</script>

