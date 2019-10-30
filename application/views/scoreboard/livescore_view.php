
<div class="modal fade" id="modal-selectplayer" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Select Batsmen & Bowler</h4>
			</div>
			<div class="modal-body">
				<!--<form role="form" method="post" action='--><? //= base_url()?><!--live_score/updateBatBowl'>-->
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
					<input type="hidden" name="is_innings_progressing" id="isInningsProgressing" value="<?php echo $is_innings_progressing; ?>">
						<input type="hidden" name="url" id="url" value="<?php echo site_url(); ?>">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="startMatch">Start</button>
			</div>
			</form>
		</div>
	</div>
</div>

<section class="live_match">
<div class="row">
	<div class="col-md-12">
		<div class="box box-success">
			<div class="box-header with-border hidden-xs">
				<h3 class="box-title">Live Match</h3>
			</div>
			<form role="form">
				<div class="box-body">
					<table class="table">
						<tr>
							<th><?php echo $team1_name . ' vs ' . $team2_name; ?></th>
							<td>First Innining</td>
						</tr>
						<tr>
							<?php foreach ($team_playing as $playing) : ?>
								<th><?php echo $playing; ?> : <?php echo isset($match_details['runs']) ? $match_details['runs'] : '0'; ?>/
									<?php echo isset($match_details['wickets']) ? $match_details['wickets'] : '0'; ?></th>
							<?php endforeach; ?>
							<td>Overs : <span><?php echo isset($match_details['over']) ? $match_details['over'] : '0'; ?>.<?php echo isset($match_details['ball']) ? $match_details['ball'] : '0'; ?></td>
						</tr>
					</table>

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
								<td id="batsman1_highlight"><span id="batsman1_name"><?php echo isset($match_details['strike_batsman']) ? $match_details['strike_batsman'] : 'Batsman 1'; ?></span><span id="batsman1_onstrike"></span></td>
								<input type='hidden' id="batsman1_id" value=1>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
							</tr>
							<tr>
								<td id="batsman2_highlight"><span id="batsman2_name"><?php echo isset($match_details['batsman']) ? $match_details['batsman'] : 'Batsman 2'; ?></span><span id="batsman2_onstrike"></span></td>
								<input type='hidden' id="batsman2_id" value=1>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
							</tr>
							<tr>
								<th style="width: 500px">Bowler</th>
								<th style="width: 50px">Over</th>
								<th style="width: 50px">Runs</th>
								<th style="width: 50px">Wickets</th>
							</tr>
							<tr>
								<td id="bowler_name"><?php echo isset($match_details['bowler']) ? $match_details['bowler'] : 'Bowler'; ?></td>
								<input type='hidden' id="bowler_id" value=1>
								<td>0.0</td>
								<td>0</td>
								<td>0</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</form>
		</div>
	</div>

<section class="this_over">	
	<div class="col-md-12">
		<div class="box box-warning">
			<form role="form">
				<div class="box-body">
					<h4><b>This Over: </b><span class="1">1</span><span class="2">2</span><span class="3">3</span><span class="4">4</span><span class="5">5</span><span class="6">6</span>
					</h4>
				</div>
			</form>
		</div>
	</div>
</section>

<section class="extras_field">
	<div class="col-md-12">
		<div class="box box-danger">
			<form role="form">
				<div class="box-body">
					<div class="form-group">
						<!-- <h5><b>Extras</b></h5> -->
						<div class="row">
							<div class="col-md-4 col-xs-4">
								<!-- <div class="radio">							 -->
									<div class="radio">
									  <label><input type="radio" name="extras" id="wideoption" value="wide">Wide</label>
									</div>
									<div class="radio">
									  <label><input type="radio" name="extras" id="noballoption" value="noball">No Ball</label>
									</div>
							</div>
							<div class="col-md-4 col-xs-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="byes" id="byes">
										Byes
									</label>
								</div>
							</div>
							<div class="col-md-4 col-xs-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="wicket" id="wicket">
										Wicket
									</label>
								</div>
							</div>
						
							<div class="col-md-12 col-xs-12">					
								<div class="box-footer">
									<button class="btn btn-success">Retire</button>
									<button class="btn btn-success">Swap Batsman</button>
								</div>
							</div>
						</div>
				</div>
			</form>
		</div>
	</div>
</section>

<section id='wicket-options'>
	<div class="col-md-12">
		<div class="box box-secondary">
			<div class="box-body">
				<div id="wicket-dropdown">
					<label>Select Wicket Option</label>
					<select  class="form-control">
						<option value="" >--Select--</option>
						<option value="bowled">Bowled</option>
						<option value="catchout">Catch Out</option>
						<option value="runout">Run Out</option>
						<option value="stumped" >Stumped</option>
						<option value="hitwicket">Hit Wicket</option>
						<option value="ballhandled">Ball Handled</option>
						<option value="fieldobstruction">Field Obstruction</option>
					</select>
				</div>

				<div id="wicket-involved">
				<label>Select Player Involved</label>
					<select class="form-control" name="wicketInvolved" id="wicketInvolved">
						<option value="">--Select--</option>
						<?php foreach ($team2all as $team2_player_all) { ?>
							<option value="<?php echo $team2_player_all['player_id']; ?>" data-bowler="<?php echo $team2_player_all['player_name']; ?>"><?php echo $team2_player_all['player_name']; ?>
								- <?php echo $team2_player_all['employee_id']; ?></option>
						<?php } ?>
					</select>
				</div>

				<div id="new-batsman">
				<label>Select New Batsman</label>
					<select class="form-control" name="newBatsman" id="newBatsman">
						<option value="">--Select--</option>
						<?php foreach ($team1 as $team1_player) { ?>
							<option value="<?php echo $team1_player['player_id']; ?>" data-batsman1="<?php echo $team1_player['player_name']; ?>"><?php echo $team1_player['player_name']; ?>
								- <?php echo $team1_player['employee_id']; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- <section class="undo-btn">
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
</section> -->

<section class="runs_scored">
	<div class="col-md-12">
		<div class="box box-info">
			<form role="form">
				<div class="box-body">
					<!-- <div class="radio">
						<label>
							<input type="radio" name="optionsRadios" class="runs_options" id="optionsRadios1" value="option1" checked="">
							
							<span class="run_score">0</span>
						</label>

						<label>
							<input type="radio" name="optionsRadios" class="runs_options" id="optionsRadios2" value="option2">
							<span class="run_score">1</span>
						</label>
						<label>
							<input type="radio" name="optionsRadios" class="runs_options" id="optionsRadios3" value="option3">
							<span class="run_score">2</span>
						</label>
						<label>
							<input type="radio" name="optionsRadios" class="runs_options" id="optionsRadios3" value="option3">
							<span class="run_score">3</span>
						</label>
						<label>
							<input type="radio" name="optionsRadios" class="runs_options" id="optionsRadios3" value="option3">
							<span class="run_score">4</span>
						</label>
						<label>
							<input type="radio" name="optionsRadios" class="runs_options" id="optionsRadios3" value="option3">
							<span class="run_score">5</span>
						</label>
						<label>
							<input type="radio" name="optionsRadios" class="runs_options" id="optionsRadios3" value="option3">
							<span class="run_score">6</span>
						</label>
					</div> -->
					<div class="radio run_button">
					<input type="radio" id="runs0" class="runs" name="runs" value="0">
					<label for="runs0">0</label>
					<input type="radio" id="runs1" class="runs" name="runs" value="1">
					<label for="runs1">1</label>
					<input type="radio" id="runs2" class="runs" name="runs" value="2">
					<label for="runs2">2</label>
					<input type="radio" id="runs3" class="runs" name="runs" value="3">
					<label for="runs3">3</label>
					<input type="radio" id="runs4" class="runs" name="runs" value="4">
					<label for="runs4">4</label>
					<input type="radio" id="runs5" class="runs" name="runs" value="5">
					<label for="runs5">5</label> 
					<input type="radio" id="runs6" class="runs" name="runs" value="6">
       				<label for="runs6">6</label>   
					</div>
					
					<!-- <div class="run_button">
						<div class="btn-group">
							<button type="button" class=" runs btn btn-primary" value="0">0</button>
							<button type="button" class=" runs btn btn-primary" value="1">1</button>
							<button type="button" class=" runs btn btn-primary" value="2">2</button>
							<button type="button" class=" runs btn btn-primary" value="3">3</button>
							<button type="button" class=" runs btn btn-primary" value="4">4</button>
							<button type="button" class=" runs btn btn-primary" value="5">5</button>
							<button type="button" class=" runs btn btn-primary" value="6">6</button>
						</div>
					</div> -->

					<button class="btn btn-info">Others</button>
					<button class="btn btn-info">Undo</button>
				</div>
			</form>
		</div>
	</div>
</section>
</div>
</section>

<script src="<?php echo site_url('resources/js/live_score.js'); ?>"></script>
<script src="<?php echo site_url('resources/js/live_score2.js'); ?>"></script>

<script>
	$(document).ready(function ()
	{
		LiveScore.init();

		$('#batsman1').on('change', function() {
        var batsman1 = $(this).val();
        $("#batsman2 option").attr('disabled', 'disabled')
            .siblings().removeAttr('disabled');
        $("#batsman2 option[value='" + batsman1 + "']").attr('disabled', true);
    	});

		$('#batsman2').on('change', function() {
			var batsman2 = $(this).val();
			$("#batsman1 option").attr('disabled', 'disabled')
				.siblings().removeAttr('disabled');
			$("#batsman1 option[value='" + batsman2 + "']").attr('disabled', true);
		});

		$('#wicket-involved').hide();
		var selectedWicket='';

		$('input[name=wicket]').on('click init-post-format', function() {
			$('#wicket-options').toggle($('#wicket').prop('checked'));
			}).trigger('init-post-format');

			$('#wicket-dropdown').change(function(){
				var selectedWicket = $('#wicket-dropdown option:selected').val();
				if(selectedWicket == 'catchout' || selectedWicket == 'runout' || selectedWicket == 'stumped') {
				$('#wicket-involved').show();
			} else {
				$('#wicket-involved').hide();
			}	
			});
			
	});
</script>



