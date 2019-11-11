var LiveScore2 = function ()
{
	var batsman1;
	var batsman2;
	var batsman1id;
	var batsman2id;
	var ballnumber;
	var onstrike;
	var onstrikeid;
	var url;

	/* Fields*/
	var batsmanId1Field;
	var batsmanId2Field;
	var onStrikeField;

	var batsman1NameField;
	var batsman1Runs;
	var batsman1balls;
	var batsman1Fours;
	var batsman1Sixes;

	var batsman2NameField;
	var batsman2Runs;
	var batsman2balls;
	var batsman2Fours;
	var batsman2Sixes;

	var bowlerIdField;
	var bowlerName;
	var bowledOver;
	var bowlerRuns;
	var bowlerWickets;

	var currentOverRuns;

	var ballNumberField;
	var inningIdField;
	var overIdField;
	var ballidField;
	var overNumberField;

	var totalScore;
	var totalWickets;
	var displayOver;
	var displayBalls;

	/* END */

	var newBowlerModal;

	function init()
	{
		url = $('#url').val();
		newBowlerModal = $('#selectBowlermodal');
		scoreRuns();
		undoFunction();

		// Highlight batsman 1 by default
		$('#batsman1_highlight').css('font-weight', 'bold');


		batsmanId1Field = $('#batsman1_id');
		batsmanId2Field = $('#batsman2_id');
		onStrikeField = $('#on_strike_batsman');

		batsman1NameField = $('#batsman1_name');
		batsman1Runs = $('#batsman1_runs');
		batsman1balls = $('#batsman1_balls');
		batsman1Fours = $('#batsman1_fours');
		batsman1Sixes = $('#batsman1_sixes');

		batsman2NameField = $('#batsman2_name');
		batsman2Runs = $('#batsman2_runs');
		batsman2balls = $('#batsman2_balls');
		batsman2Fours = $('#batsman2_fours');
		batsman2Sixes = $('#batsman2_sixes');

		bowlerIdField = $('#bowler_id');
		bowlerName = $('#bowler_name');
		bowledOver = $('#bowled_over');
		bowlerRuns = $('#bowler_runs');
		bowlerWickets = $('#bowler_wickets');

		currentOverRuns = $('#currentOverRuns');

		ballNumberField = $('#ballNumber');
		inningIdField = $('#inningId');
		overIdField = $('#overId');
		ballidField = $('#ballid');
		overNumberField = $('#overNumber');

		totalScore = $('#totalScore');
		totalWickets = $('#totalWickets');
		displayOver = $('#displayOver');
		displayBalls = $('#displayBalls');
		highlightStrike();

	}

	function scoreRuns()
	{
		$('.runs').click(function ()
		{
			batsman1 = $('#batsman1_name').html();
			batsman2 = $('#batsman2_name').html();
			batsman1id = $('#batsman1_id').val();
			batsman2id = $('#batsman2_id').val();
			ballnumber = $('#ballNumber').val();
			onstrike = batsman1;
			onstrikeid = $('#on_strike_batsman').val();


			var runs = $("input[name='runs']:checked").val();
			var extras = $("input[name='extras']:checked").val();
			var is_extras = $('input[name="extras"]').is(':checked') ? true : false;
			var is_byes = $('input[name="byes"]').is(':checked') ? true : false;
			var is_wicket = $('input[name="wicket"]').is(':checked') ? true : false;
			var how_out = $('#wicket-type').val();
			var wicketInvolved = $('#wicketInvolved').val();
			var wicketInvolved2 = $('#wicketInvolved2').val();
			var outBatsman = $("input[name='outBatsman']:checked").val();
			var newBatsman = $('#newBatsman').val();
			var inning_id = $('#inningId').val();
			var perball = {};

			perball['inning_id'] = inning_id;
			perball['runs_scored'] = parseInt(runs);
			perball['byes'] = 0;
			perball['noball'] = 0;
			perball['runout'] = 0;
			perball['wicket'] = 0;
			perball['wide'] = 0;

			console.log(wicketInvolved);
			if (!is_extras && !is_wicket) {
				if (is_byes) {
					perball['byes'] = parseInt(runs);
					ballnumber++;
				}
				else {
					perball['runs_scored'] = parseInt(runs);
					ballnumber++;
				}
			}
			else if (is_extras) {
				if (extras == 'wide') {
					perball['wide'] = 1;
					if (runs > 0) {
						perball['byes'] = parseInt(runs);
					}
					if (is_wicket) {
						perball['wicket_type'] = how_out;
						if (how_out === 'Run Out') {
							perball['runout'] = 1;
							perball['wicket_assist'] = wicketInvolved;
							if (!wicketInvolved2 == '') {
								perball['wicket_assist2'] = wicketInvolved2;
							}
							perball['out_batsman'] = outBatsman;
							perball['new_batsman'] = newBatsman;
						}
						else if (how_out === 'Catch Out' || how_out === 'Stumped') {
							perball['wicket'] = 1;
							perball['wicket_assist'] = wicketInvolved;
							perball['out_batsman'] = outBatsman;
							perball['new_batsman'] = newBatsman;
						}
						else {
							perball['wicket'] = 1;
							perball['out_batsman'] = outBatsman;
							perball['new_batsman'] = newBatsman;
						}
					}
				}
				else {
					perball['noball'] = 1;
					if (is_byes) {
						perball['byes'] = parseInt(runs);
					}
					else {
						perball['runs_scored'] = parseInt(runs);
					}
					if (is_wicket) {
						perball['wicket_type'] = how_out;
						if (how_out === 'Run Out') {
							perball['runout'] = 1;
							perball['wicket_assist'] = wicketInvolved;
							if (!wicketInvolved2 == '') {
								perball['wicket_assist2'] = wicketInvolved2;
							}
							perball['out_batsman'] = outBatsman;
							perball['new_batsman'] = newBatsman;
						}
						else if (how_out === 'Catch Out' || how_out === 'Stumped') {
							perball['wicket'] = 1;
							perball['wicket_assist'] = wicketInvolved;
							perball['out_batsman'] = outBatsman;
							perball['new_batsman'] = newBatsman;
						}
						else {
							perball['wicket'] = 1;
							perball['out_batsman'] = outBatsman;
							perball['new_batsman'] = newBatsman;
						}
					}
				}
			}
			else {
				perball['runs_scored'] = parseInt(runs);
				perball['wicket_type'] = how_out;
				if (how_out === 'Run Out') {
					perball['runout'] = 1;
					perball['wicket_assist'] = wicketInvolved;
					if (!wicketInvolved2 == '') {
						perball['wicket_assist2'] = wicketInvolved2;
					}
					perball['out_batsman'] = outBatsman;
					perball['new_batsman'] = newBatsman;
				}
				else if (how_out === 'catchout' || how_out === 'stumped') {
					perball['wicket'] = 1;
					perball['wicket_assist'] = wicketInvolved;
					perball['out_batsman'] = outBatsman;
					perball['new_batsman'] = newBatsman;
				}
				else {
					perball['wicket'] = 1;
					perball['out_batsman'] = outBatsman;
					perball['new_batsman'] = newBatsman;
				}
				ballnumber++;
			}

			perball['ballnumber'] = ballnumber;
			perball['onstrike'] = onstrike;
			perball['onstrikeid'] = onstrikeid;

			var bowler = $('#bowler_id').val();
			perball['bowler'] = bowler;
			perball['batsman1'] = batsman1id;
			perball['batsman2'] = batsman2id;

			// Function to insert Ball records
			insertBallRecords(perball);
			// Reset to default
			resetDefault();

		});
	}

	function resetDefault()
	{
		$('input[type="radio"]').prop('checked', false);
		$('input[type="checkbox"]').prop('checked', false);
		$('#wicket-type').prop('selectedIndex', 0);
		$('#wicketInvolved').prop('selectedIndex', 0);
		$('#wicketInvolved2').prop('selectedIndex', 0);
		$('#newBatsman').prop('selectedIndex', 0);
		$('#wicket-options').hide();
	}

	function highlightStrike()
	{
		$('.highlight-batsman').css('font-weight', '');

		if (onStrikeField.val() == batsmanId1Field.val()) {
			$('#batsman1_highlight').css('font-weight', 'bold');
		}

		if (onStrikeField.val() == batsmanId2Field.val()) {
			$('#batsman2_highlight').css('font-weight', 'bold');
		}
	}

	function insertBallRecords(perball)
	{
		// temp value for over_id and batsman_id
		perball['over_id'] = $('#overId	').val();
		var ballid = $('#ballid');

		$.ajax({
			url: url + 'Live_score/insertBallRecords',
			type: "POST",
			data: perball,
			success: function (data)
			{
				var response = JSON.parse(data);
				updateScoreData(response);
				verifyBallNumber();
				highlightStrike();
			}
		});
	}

	function updateScoreData(res)
	{
		batsmanId1Field.val(res.batsman1);
		batsmanId2Field.val(res.batsman2);
		onStrikeField.val(res.on_strike_batsman);

		batsman1NameField.text(res.batsman_record[0].player_name);
		batsman1Runs.text(res.batsman_record[0].runs == null ? 0 : res.batsman_record[0].runs);
		batsman1balls.text(res.batsman_record[0].balls);

		batsman1Fours.text(res.batsman_record[0].total_4 == null ? 0 : res.batsman_record[0].total_4);
		batsman1Sixes.text(res.batsman_record[0].total_6 == null ? 0 : res.batsman_record[0].total_6);

		batsman2NameField.text(res.batsman_record[1].player_name);
		batsman2Runs.text(res.batsman_record[1].runs == null ? 0 : res.batsman_record[1].runs);
		batsman2balls.text(res.batsman_record[1].balls);
		batsman2Fours.text(res.batsman_record[1].total_4 == null ? 0 : res.batsman_record[1].total_4);
		batsman2Sixes.text(res.batsman_record[1].total_6 == null ? 0 : res.batsman_record[1].total_6);

		updateBowlerRecords(res);

		ballNumberField.val(res.ballnumber);
		inningIdField.val(res.team_score.inning_id);
		overIdField.val(res.team_score.over_id);
		ballidField.val(res.team_score.ball_id);
		overNumberField.val(res.team_score.overs);

		totalScore.text(res.team_score.total_team_score);
		totalWickets.text(res.team_score.wickets);
		displayOver.text(res.team_score.overs);
		displayBalls.text(res.team_score.balls);

		var overRuns = displayCurrentOverRuns(res.current_over_records);
		currentOverRuns.text(overRuns);

	}

	function updateBowlerRecords(res)
	{
		bowlerIdField.val(res.bowler_record.bowler);
		bowlerName.text(res.bowler_record.player_name);
		bowledOver.text(res.bowler_record.over_number + '.' + res.bowler_record.ball_number);
		bowlerRuns.text(res.bowler_record.bowler_runs_gave == null ? 0 : res.bowler_record.bowler_runs_gave);
		bowlerWickets.text(res.bowler_record.bowler_wickets == null ? 0 : res.bowler_record.bowler_wickets);
	}


	function displayCurrentOverRuns(data)
	{
		var overRuns = '';
		$.each(data, function (key, value)
		{
			overRuns += ' ' + value.runs;
		});
		return overRuns;
	}

	function verifyBallNumber()
	{
		var currentBall = ballNumberField.val();
		if (parseInt(currentBall) == 6) {
			newBowlerModal.modal({backdrop: 'static', keyboard: false, show: true});
			$('#selectNewBowler').on('click', function ()
			{
				var newBowler = $('#newBowler').val();
				return $.ajax({
					url: url + 'Live_score/new_over',
					type: "POST",
					data: {'bowler': newBowler, 'inning_id': inningIdField.val()},
					success: function (data)
					{
						newBowlerModal.modal('hide');
						ballNumberField.val(0)
						var response = JSON.parse(data);
						if (response.innings_status != 'completed') {
							overIdField.val(response.over_id);
							updateBowlerRecords(response);
						}
						else {
							alert('Inning completed');
						}

					}
				});


			});
		}

	}

	function undoFunction()
	{
		$('#undoRecord').on('click', function (e)
		{
			e.preventDefault();
			var ballid = $('#ballid').val();
			$.ajax({
				url: url + 'Live_score/undoBall',
				type: "POST",
				data: {ballid: ballid},
				success: function (data)
				{
					var response = JSON.parse(data);
					updateScoreData(response);
				}
			});

		});
	}

	return {
		init: init
	};
}();
