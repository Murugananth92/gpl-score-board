<div class="modal fade" id="modal-selectplayer" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Select Batsmen & Bowler</h4>
			</div>
			<div class="modal-body">
				<!--			  <form role="form" method="post" action='--><? //= base_url()?><!--live_score/updateBatBowl'>-->
				<form role="form" method="post" action='#'>

					<label>Select Striker</label>
					<select class="form-control" name="batsman1" id="batsman1">
						<option value="empty">Select Striker</option>
						<?php foreach ($team1 as $team1_player) { ?>
							<option value="<?php echo $team1_player['player_id']; ?>" data-batsman1="<?php echo $team1_player['player_name']; ?>"><?php echo $team1_player['player_name']; ?>
								- <?php echo $team1_player['employee_id']; ?></option>
						<?php } ?>
					</select>
					<label>Select Non Striker</label>
					<select class="form-control" name="batsman2" id="batsman2">
						<option value="empty">Select Non Striker</option>
						<?php foreach ($team1 as $team1_player) { ?>
							<option value="<?php echo $team1_player['player_id']; ?>" data-batsman2="<?php echo $team1_player['player_name']; ?>"><?php echo $team1_player['player_name']; ?>
								- <?php echo $team1_player['employee_id']; ?></option>
						<?php } ?>
					</select>
					<label>Select Bowler</label>
					<select class="form-control" name="bowler" id="bowler">
						<option value="empty">Select Bowler</option>
						<?php foreach ($team2 as $team2_player) { ?>
							<option value="<?php echo $team2_player['player_id']; ?>" data-bowler="<?php echo $team2_player['player_name']; ?>"><?php echo $team2_player['player_name']; ?>
								- <?php echo $team2_player['employee_id']; ?></option>
						<?php } ?>
					</select>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="startMatch">Start</button>
			</div>
			</form>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Live Match</h3>
			</div>
			<form role="form">
				<div class="box-body">
					<h5 class="col-xs-6"> <?php echo $team1_name.' vs '. $team2_name;?>- <span> First Innining</span></h5>
					<?php foreach($team_playing as $playing) : ?>
					<h1 class="col-xs-12"> <?php echo $playing; ?> : 0 / 0</h1>
						<?php endforeach; ?>
					<h2 class="col-xs-12">Overs : <span>0</span></h2>
					<div class="box-header">
					</div>
					<div class="box-body no-padding">
						<table class="table table-striped">
							<tbody>
							<tr>
								<th style="width: 500px">Batsman</th>
								<th style="width: 50px">Runs</th>
								<th style="width: 50px">Balls</th>
								<th style="width: 50px">4s</th>
								<th style="width: 50px">6s</th>
							</tr>
							<tr>
								<td id="batsman1_name">Batsman 1</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
							</tr>
							<tr>
								<td id="batsman2_name">Batsman 2</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
							</tr>
							<tr>
								<th style="width: 500px">Bowler</th>
								<th style="width: 50px">Over</th>
								<th style="width: 50px">Maiden</th>
								<th style="width: 50px">Runs</th>
								<th style="width: 50px">Wickets</th>
							</tr>
							<tr>
								<td id="bowler_name">Bowler</td>
								<td>0.0</td>
								<td>0</td>
								<td>0.0</td>
								<td>0</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-warning">
			<form role="form">
				<div class="box-body">
					<h4><b>This
							Over: </b><span class="1">1</span>&nbsp;<span class="2">2</span>&nbsp;<span class="3">3</span>&nbsp;<span class="4">4</span>&nbsp;<span class="5">5</span>&nbsp;<span class="6">6</span>&nbsp;<span class="7"></span>&nbsp;<span class="8"></span>
					</h4>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-12">
		<div class="box box-danger">
			<form role="form">
				<div class="box-body">
					<div class="form-group">
						<div class="checkbox">
							<label>
								<input type="checkbox">
								Wide
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox">
								No Ball
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox">
								Byes
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox">
								Leg Byes
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox">
								Wicket
							</label>
						</div>
					</div>
					<div class="box-footer">
						<button class="btn btn-success">Retire</button>
						<button class="btn btn-success">Swap Batsman</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-2">
		<div class="box box-info">
			<form role="form">
				<div class="box-body">
					<div class="form-group">
						<button class="btn btn-info form-control">Undo</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-10">
		<div class="box box-info">
			<form role="form">
				<div class="box-body">
					<div class="radio">
						<label>
							<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
							0
						</label>

						<label>
							<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
							1
						</label>
						<label>
							<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
							2
						</label>
						<label>
							<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
							3
						</label>
						<label>
							<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
							4
						</label>
						<label>
							<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
							5
						</label>
						<label>
							<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
							6
						</label>
					</div>
					<button class="btn btn-info">Others</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="<?php echo site_url('resources/js/live_score.js');?>"></script>
<script>
	$('document').ready(function ()
	{	
		if(localStorage.batsman_name1 != "" && localStorage.batsman_name2 != "" && localStorage.bowler_name1 != "")
		{
			$('#batsman1_name').text(localStorage.batsman_name1);
			$('#batsman2_name').text(localStorage.batsman_name2);
			$('#bowler_name').text(localStorage.bowler_name1);
		}
		var batsman1_name;
		var batsman2_name;
		var bowler_name;

		var matchStatus = '<?php echo $match_data; ?>';
		if (parseInt(matchStatus) === 0) {
			$('#modal-selectplayer').modal('show');
		}

		$('#startMatch').on('click', function ()
		{
			var batsman1 = $('#batsman1').val();
			var batsman2 = $('#batsman2').val();
			var bowler = $('#bowler').val();

			localStorage.batsman_name1 = $('#batsman1 option:selected').attr('data-batsman1');
			localStorage.batsman_name2 = $('#batsman2 option:selected').attr('data-batsman2');
			localStorage.bowler_name1 = $('#bowler option:selected').attr('data-bowler');

			var request = $.ajax({
				url: "<?php echo site_url('Live_score/start_innings'); ?>",
				type: "POST",
				data: {batsman1: batsman1, batsman2: batsman2, bowler: bowler},
				success: function (data)
				{
					$('#modal-selectplayer').modal('hide');
					$('#inningId').val(data.inning_id);
					$('#overId').val(data.over_id);
					$('#batsman1_name').text(localStorage.batsman_name1);
					$('#batsman2_name').text(localStorage.batsman_name2);
					$('#bowler_name').text(localStorage.bowler_name1);
				}
			});
		})
	});
</script>

