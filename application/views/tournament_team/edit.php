
<?php
 print_r($tournament_team);
// die;
 ?>
<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Tournament Team Edit</h3>
            </div>
			<?php echo form_open('tournament_team/edit/'.$tournament_team['tournament_team_id']); ?>
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
						<input type="hidden" name ="team_id" class='form-control' id="team_id" value="<?php echo $tournament_team['team_id'] ?>" >  
						<input disabled type="text" name ="team_name" class='form-control' id="team_name" value="<?php echo $tournament_team['team_name']; ?>" >
					</div>
					<div class="col-md-6">
						<label for="captain" class="control-label"><span class="text-danger">*</span>Captain</label>
						<select name="captain" id="captain" class='form-control'>
							<option value="">select player</option>
							<?php 
							foreach($all_players as $player)
							{
								$selected = ($player['player_id'] == $tournament_team['captain_id']) ? ' selected="selected"' : "";

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
								$selected = ($player['player_id'] == $tournament_team['vice_captain_id']) ? ' selected="selected"' : "";

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