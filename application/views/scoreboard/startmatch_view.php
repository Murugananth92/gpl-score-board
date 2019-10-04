<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Select Match</h3>
			</div>
			<!-- /.box-header -->
			<!-- form start -->
			<form role="form" method="post" action="<?= site_url().'start_match/select_players'?>">
				<div class="box-body">

					<label>Select Match</label>
					<select class="form-control" name="matches" id="matches">
						<option value="">Select Match</option>
						<?php foreach ($matches as $m) { ?>
							<option value="<?php echo $m['match_id']; ?>"><?php echo $m['team_1'] . ' vs ' . $m['team_2']; ?></option>
						<?php } ?>
					</select>
					<small class=" <?php if(form_error('matches') != null){echo "text-danger";} ?>" id="matchesError"><?php if(form_error('matches') != null){ echo form_error('matches'); }?></small>

					<label>Team 1</label>
					<input type="text" class="form-control" placeholder="Team 1" name="team1" id="team1">
					<small class=" <?php if(form_error('team1') != null){echo "text-danger";} ?>" id="team1Error"><?php if(form_error('team1') != null){ echo form_error('team1'); }?></small>

					<label>Team 2</label>
					<input type="text" class="form-control" placeholder="Team 2" name="team2" id="team2">
					<small class=" <?php if(form_error('team2') != null){echo "text-danger";} ?>" id="team2Error"><?php if(form_error('team2') != null){ echo form_error('team2'); }?></small>

					<label>Date:</>
					<input type="date" class="form-control" name="match_date" id="match_date">
					<small class=" <?php if(form_error('match_date') != null){echo "text-danger";} ?>" id="matchDateError"><?php if(form_error('match_date') != null){ echo form_error('match_date'); }?></small>

					<label>Venue:</label>
					<input type="text" class="form-control" placeholder="Venue" name="match_venue" id="match_venue">
					<small class=" <?php if(form_error('match_venue') != null){echo "text-danger";} ?>" id="matchVenueError"><?php if(form_error('match_venue') != null){ echo form_error('match_venue'); }?></small>

					<label>Toss won by?</label>
						<div class="radio">
                    <label>
                      <input type="radio" name="team1_toss" id="team1_toss" value="">
                      <span id="team1_name"></span>
										</label>
										<label>
                      <input type="radio" name="team1_toss" id="team2_toss" value="">
                      <span id="team2_name"></span>
                    </label>
						</div>
						<small class=" <?php if(form_error('team1_toss') != null){echo "text-danger";} ?>" id="team1TossError"><?php if(form_error('team1_toss') != null){ echo form_error('team1_toss'); }?></small>

					<label>Opted to?</label>
					<div class="radio">
                    <label>
                      <input type="radio" name="toss_options" id="toss_options1" value="bat">
                      Bat
										</label>
										<label>
                      <input type="radio" name="toss_options" id="toss_options2" value="bowl">
                      Bowl
                    </label>
						</div>
						<small class=" <?php if(form_error('toss_options') != null){echo "text-danger";} ?>" id="tossOptionsError"><?php if(form_error('toss_options') != null){ echo form_error('toss_options'); }?></small>

					<label>Overs:</label>
					<input type="text" class="form-control" name="overs" id="overs" placeholder="Overs">
					<small class=" <?php if(form_error('overs') != null){echo "text-danger";} ?>" id="oversError"><?php if(form_error('overs') != null){ echo form_error('overs'); }?></small>
				</div>
				<!-- /.box-body -->

				<div class="box-footer">
					<button type="submit" name="select_players" class="btn btn-primary">Select Players</button>
				</div>
			</form>

		</div>
	</div>
</div>
<!-- jQuery 3.4.1 -->
<script src="<?php echo site_url('resources/js/jquery.min.js'); ?>"></script>
<script>
	$(document).ready(function ()
	{
		var matches = <?php echo json_encode($matches); ?>;

		$('#matches').on('change', function ()
		{
			var matchId = $(this).val();
			$.each(matches, function (key, value)
			{
				if (value.match_id == matchId) {
					$('#team1').val(value.team_1);
					$('#team2').val(value.team_2);
					$('#match_date').val(value.match_date);
					$('#match_venue').val(value.match_venue);
					$('#team1_name').text(value.team_1);
					$('#team2_name').text(value.team_2);
					$('#team1_toss').val(value.team_1);
					$('#team2_toss').val(value.team_2);
				}
			});

		});

	});
</script>
