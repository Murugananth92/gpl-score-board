
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Add Tournament Team</h3>
            </div>
            <?php echo form_open('tournament_team/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-12">
						<label class="control-label">Please add team for</label>  
						<label class="control-label"><?php echo $active_tournament['tournament_name']; ?> tournament</label>  
						<input type="hidden" name ="tournament_name" class='form-control' id="tournament_name" value="<?php echo $active_tournament['tournament_id']; ?>" >
					<span class="text-danger"><?php echo form_error('tournament_name');?></span>
					</div>
					
					<div class="col-md-6">
						<label for="team_name" class="control-label"><span class="text-danger">*</span>Team Name</label>
						<select name="team_name" class='form-control' id="team_name">
							<option value="">select team</option>
							<?php 
							foreach($all_teams as $team)
							{
								$selected = ($team['team_id'] == $this->input->post('team_id')) ? ' selected="selected"' : "";

								echo '<option value="'.$team['team_id'].'" '.$selected.'>'.$team['team_name'].'</option>';
							} 
							?>
						</select>
						<span class="text-danger"><?php echo form_error('team_name');?></span>
					</div>
					<div class="col-md-6">
						<label for="captain" class="control-label"><span class="text-danger">*</span>Captain</label>
						<select name="captain" id="captain" class='form-control'>
							<option value="">select player</option>
							<?php 
							foreach($all_players as $player)
							{
								$selected = ($player['player_id'] == $this->input->post('captain')) ? ' selected="selected"' : "";

								echo '<option value="'.$player['player_id'].'" '.$selected.'>'.$player['player_name'].' - '.$player['employee_id'].'</option>';
							} 
							?>
						</select>
						<span class="text-danger"><?php echo form_error('captain');?></span>
					</div>
					<div class="col-md-6">
						<label for="vice_captain" class="control-label"><span class="text-danger">*</span>Vice Captain</label>
						<select name="vice_captain" id="vice_captain" class='form-control'>
							<option value="">select player</option>
							<?php 
							foreach($all_players as $player)
							{
								$selected = ($player['player_id'] == $this->input->post('vice_captain')) ? ' selected="selected"' : "";

								echo '<option value="'.$player['player_id'].'" '.$selected.'>'.$player['player_name'].' - '.$player['employee_id'].'</option>';
							} 
							?>
						</select>
						<span class="text-danger"><?php echo form_error('vice_captain');?></span>
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
	$('#captain').on('change',function(){
		var captain = $(this).val();
		$("#vice_captain option").attr('disabled','disabled')
        .siblings().removeAttr('disabled');
		$("#vice_captain option[value='"+ captain + "']").attr('disabled', true); 
	});

	$('#vice_captain').on('change',function(){
		var vice_captain = $(this).val();
		$("#captain option").attr('disabled','disabled')
        .siblings().removeAttr('disabled');
		$("#captain option[value='"+ vice_captain + "']").attr('disabled', true); 
	});
});
</script>
