<?php print_r($params); ?>
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Select Match</h3>
			</div>
			<form role="form" method="post" action="<?= site_url().'start_match/select_players'?>">
				<div class="box-body">
					<label>Select Match</label>
					<select class="form-control" name="matches" id="matches">
						<option value="empty">Select Match</option>
						<?php foreach ($matches as $m) { ?>
							<option <?php if(isset($params['matches']) && $params['matches'] == $m['match_id']){echo "selected='selected'";}?> value="<?php echo $m['match_id']; ?>"><?php echo "Match: ".$m['match_id'].' - '.$m['team_1'] . ' vs ' . $m['team_2']; ?></option >
						<?php } ?>
					</select>
					<small class=" <?php if(form_error('matches') != null){echo "text-danger";} ?>" id="matchesError"><?php if(form_error('matches') != null){ echo form_error('matches'); }?></small>

					<label>Team 1</label>
					<input type="hidden" name="teamid_1" id="teamid_1" value="<?php if(isset($params['teamid_1'])){echo $params['teamid_1'];} ?>">
					<input type="text" class="form-control" placeholder="Team 1" name="team1" id="team1" value="<?php if(isset($params['team1'])){echo $params['team1'];} ?>">
					<small class=" <?php if(form_error('team1') != null){echo "text-danger";} ?>" id="team1Error"><?php if(form_error('team1') != null){ echo form_error('team1'); }?></small>

					<label>Team 2</label>
					<input type="hidden" name="teamid_2" id="teamid_2" value="<?php if(isset($params['teamid_2'])){echo $params['teamid_2'];} ?>">
					<input type="text" class="form-control" placeholder="Team 2" name="team2" id="team2" value="<?php if(isset($params['team2'])){echo $params['team2'];} ?>">
					<small class=" <?php if(form_error('team2') != null){echo "text-danger";} ?>" id="team2Error"><?php if(form_error('team2') != null){ echo form_error('team2'); }?></small>

					<label>Date:</>
					<input type="date" class="form-control" name="match_date" id="match_date" value="<?php if(isset($params['match_date'])){echo $params['match_date'];} ?>">
					<small class=" <?php if(form_error('match_date') != null){echo "text-danger";} ?>" id="matchDateError"><?php if(form_error('match_date') != null){ echo form_error('match_date'); }?></small>

					<label>Venue:</label>
					<input type="text" class="form-control" placeholder="Venue" name="match_venue" id="match_venue" value="<?php if(isset($params['match_venue'])){echo $params['match_venue'];} ?>">
					<small class=" <?php if(form_error('match_venue') != null){echo "text-danger";} ?>" id="matchVenueError"><?php if(form_error('match_venue') != null){ echo form_error('match_venue'); }?></small>
					<label>Toss won by?</label>
						<div class="radio">
					<?php if(isset($params['team1_toss'])) { ?>
						<label>
                      <input type="radio" <?php echo ($params['team1_toss'] == $params['team1']) ? 'checked' : ''; ?> name="team1_toss" class="team_toss" id="team1_toss" value="<?php echo $params['team1'] ?>">
                      <span id="team1_name"><?php echo $params['team1'] ?></span>
										</label>
										<label>
                      <input type="radio" <?php echo ($params['team1_toss'] == $params['team2']) ? 'checked' : ''; ?> name="team1_toss" class="team_toss" id="team2_toss" value="<?php echo $params['team2'] ?>">
                      <span id="team2_name"><?php echo $params['team2'] ?></span>
					<?php } else { ?>
						<label>
                      <input type="radio" name="team1_toss" class="team_toss" id="team1_toss" value="">
                      <span id="team1_name"></span>
										</label>
										<label>
                      <input type="radio" name="team1_toss" class="team_toss" id="team2_toss" value="">
                      <span id="team2_name"></span>
					</label>
					<?php } ?>
						</div>
						<small class=" <?php if(form_error('team1_toss') != null){echo "text-danger";} ?>" id="team1TossError"><?php if(form_error('team1_toss') != null){ echo form_error('team1_toss'); }?></small>

					<label>Opted to?</label>
					<div class="radio" value="<?php if(isset($params['toss_options'])){echo $params['toss_options'];} ?>">
                    <label>
                      <input type="radio" name="toss_options" id="toss_options1" value="bat" <?php if(isset($params['toss_options']) && $params['toss_options']=='bat'){ echo'checked';} else {' ';} ?> >
                      Bat
										</label>
										<label>
                      <input type="radio" name="toss_options" id="toss_options2" value="bowl" <?php if(isset($params['toss_options']) && $params['toss_options']=='bowl'){ echo'checked';} else {' ';} ?> >
                      Bowl
                    </label>
						</div>
						<small class=" <?php if(form_error('toss_options') != null){echo "text-danger";} ?>" id="tossOptionsError"><?php if(form_error('toss_options') != null){ echo form_error('toss_options'); }?></small>

					<label>Overs:</label>
					<input type="text" class="form-control" name="overs" id="overs" placeholder="Overs" value="<?php if(isset($params['overs'])){echo $params['overs'];} ?>">
					<small class=" <?php if(form_error('overs') != null){echo "text-danger";} ?>" id="oversError"><?php if(form_error('overs') != null){ echo form_error('overs'); }?></small>
				</div>
				<div class="box-footer">
					<button type="submit" name="select_players" class="btn btn-primary">Select Players</button>
				</div>
			</form>

		</div>
	</div>
</div>
<script>
	$(document).ready(function ()
	{	
		var matches = <?php echo json_encode($matches); ?>;

		$('#matches').on('change', function ()
		{
			var matchId = $(this).val();
			fieldMatch(matchId);
			
		});
		function fieldMatch(matchId) {
			$.each(matches, function (key, value)
			{
				if (value.match_id == matchId) {
					$('#team1').val(value.team_1);
					$('#team2').val(value.team_2);
					$('#teamid_1').val(value.teamid_1);
					$('#teamid_2').val(value.teamid_2);
					$('#match_date').val(value.match_date);
					$('#match_venue').val(value.match_venue);
					$('#team1_name').text(value.team_1);
					$('#team2_name').text(value.team_2);
					$('#team1_toss').val(value.team_1);
					$('#team2_toss').val(value.team_2);
				}
			});
		}
	});
</script>
