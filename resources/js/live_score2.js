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

	function init()
	{
		url = $('#url').val();

		scoreRuns();

		// Highlight batsman 1 by default
		$('#batsman1_onstrike').html('*');
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
						if (how_out === 'runout') {
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
						if (how_out === 'runout') {
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
					}
				}
			}
			else {
				perball['runs_scored'] = parseInt(runs);
				perball['wicket_type'] = how_out;
				if (how_out === 'runout') {
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
			//perball['overnumber'] = overnumber;

			perball['onstrike'] = onstrike;
			perball['onstrikeid'] = onstrikeid;
			//nextstrike = on_strike(parseInt(runs));

			//highlightStrike(nextstrike);

			// perball['nextstrike'] = nextstrike;

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

	function highlightStrike(nextstrike)
	{
		if (onstrike == batsman1) {
			$('#batsman1_highlight').css('font-weight', 'bold');
			$('#batsman1_onstrike').html('*');
			$('#batsman2_highlight').css('font-weight', 'normal');
			$('#batsman2_onstrike').html('');
		}
		else {
			$('#batsman2_highlight').css('font-weight', 'bold');
			$('#batsman2_onstrike').html('*');
			$('#batsman1_highlight').css('font-weight', 'normal');
			$('#batsman1_onstrike').html('');
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
				onstrikeid
				console.log(response);
				//ballid.val(res.ball_id);
			}
		});

	}

	return {
		init: init
	};
}();
