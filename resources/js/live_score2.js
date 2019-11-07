var ballnumber = 0;
var overnumber = 0;
var batsman1 = $('#batsman1_name').html();
var batsman2 = $('#batsman2_name').html();
var batsman1id = $('#batsman1_id').val();
var batsman2id = $('#batsman2_id').val();
var onstrike = batsman1;
var onstrikeid = batsman1id;
var url = $('#url').val();

// Highlight batsman 1 by default
$('#batsman1_onstrike').html('*');
$('#batsman1_highlight').css('font-weight', 'bold');

$('.runs').click(function() {
    var runs = $("input[name='runs']:checked").val();
    var extras = $("input[name='extras']:checked").val();
    var is_extras = $('input[name="extras"]').is(':checked') ? true : false;
    var is_byes = $('input[name="byes"]').is(':checked') ? true : false;
	var is_wicket = $('input[name="wicket"]').is(':checked') ? true : false;
	var how_out = $('#wicket-type').val();
	var wicketInvolved = $('#wicketInvolved').val();
	var wicketInvolved2 = $('#wicketInvolved2').val();
	var outBatsman = $("input[name='outBatsman']:checked").val();
	var newBatsman= $('#newBatsman').val();
	var inning_id = $('#inningId').val();
    var perball = {};

	perball['inning_id'] = inning_id;
	
    if (!is_extras && !is_wicket) {
        if (is_byes) {
            perball['byes'] = parseInt(runs);
            ballnumber++;
        } else {
            perball['runs_scored'] = parseInt(runs);
            ballnumber++;
        }
    } else if (is_extras) {
        if (extras == 'wide') {
            perball['wide'] = 1;
            if (runs > 0) {
                perball['byes'] = parseInt(runs);
            }
            if (is_wicket) {
				perball['wicket_type'] = how_out;
				if(how_out === 'runout') {
					perball['runout'] = 1;
					perball['wicket_assist'] = wicketInvolved;
					if(!wicketInvolved2 == '') {
						perball['wicket_assist2'] = wicketInvolved2;
					}
					perball['out_batsman'] = outBatsman;
					perball['new_batsman'] = newBatsman;
				} else if(how_out === 'catchout' || how_out === 'stumped') {
					perball['wicket'] = 1;
					perball['wicket_assist'] = wicketInvolved;
					perball['out_batsman'] = outBatsman;
					perball['new_batsman'] = newBatsman;
				} else {
					perball['wicket'] = 1;
					perball['out_batsman'] = outBatsman;
					perball['new_batsman'] = newBatsman;
				}
            }
        } else {
            perball['noball'] = 1;
            if (is_byes) {
                perball['byes'] = parseInt(runs);
            } else {
                perball['runs_scored'] = parseInt(runs);
            }
            if (is_wicket) {
                perball['wicket_type'] = how_out;
				if(how_out === 'runout') {
					perball['runout'] = 1;
					perball['wicket_assist'] = wicketInvolved;
					if(!wicketInvolved2 == '') {
						perball['wicket_assist2'] = wicketInvolved2;
					}
					perball['out_batsman'] = outBatsman;
					perball['new_batsman'] = newBatsman;
				} else if(how_out === 'catchout' || how_out === 'stumped') {
					perball['wicket'] = 1;
					perball['wicket_assist'] = wicketInvolved;
					perball['out_batsman'] = outBatsman;
					perball['new_batsman'] = newBatsman;
				} else {
					perball['wicket'] = 1;
					perball['out_batsman'] = outBatsman;
					perball['new_batsman'] = newBatsman;
				}
            }
        }
    } else {
		perball['runs_scored'] = parseInt(runs);
		perball['wicket_type'] = how_out;
        if(how_out === 'runout') {
			perball['runout'] = 1;
			perball['wicket_assist'] = wicketInvolved;
			if(!wicketInvolved2 == '') {
				perball['wicket_assist2'] = wicketInvolved2;
			}
			perball['out_batsman'] = outBatsman;
			perball['new_batsman'] = newBatsman;
		} else if(how_out === 'catchout' || how_out === 'stumped') {
			perball['wicket'] = 1;
			perball['wicket_assist'] = wicketInvolved;
			perball['out_batsman'] = outBatsman;
			perball['new_batsman'] = newBatsman;
		} else {
			perball['wicket'] = 1;
			perball['out_batsman'] = outBatsman;
			perball['new_batsman'] = newBatsman;
		}
        ballnumber++;
	}
	
    if (ballnumber === 7) {
        ballnumber = 1;
        overnumber++;
    }

    perball['ballnumber'] = ballnumber;
    perball['overnumber'] = overnumber;

	perball['onstrike'] = onstrike;
	perball['onstrikeid'] = onstrikeid;
	nextstrike = on_strike(parseInt(runs));
	
	highlightStrike(nextstrike);
	
    perball['nextstrike'] = nextstrike;

    var bowler = $('#bowler_id').val();
    

    perball['bowler'] = bowler;
    perball['batsman1'] = batsman1id;
	perball['batsman2'] = batsman2id;
	
	console.log(perball);
	
    // Function to insert Ball records
	insertBallRecords(perball);	

	// Reset to default
	resetDefault();

});

function resetDefault() {
	$('input[type="radio"]').prop('checked', false);
	$('input[type="checkbox"]').prop('checked', false);
	$('#wicket-type').prop('selectedIndex',0);
	$('#wicketInvolved').prop('selectedIndex',0);
	$('#wicketInvolved2').prop('selectedIndex',0);
	$('#newBatsman').prop('selectedIndex',0);
	$('#wicket-options').hide();
}

function on_strike(runs) {
    if (runs % 2 != 0) {
        if (onstrike == batsman1) {
			onstrike = batsman2;
			onstrikeid = batsman2id;
        } else {
			onstrike = batsman1;
			onstrikeid = batsman1id;
        }
    }
    return onstrike;
}

function highlightStrike(nextstrike) {
    if (onstrike == batsman1) {
        $('#batsman1_highlight').css('font-weight', 'bold');
        $('#batsman1_onstrike').html('*');
        $('#batsman2_highlight').css('font-weight', 'normal');
        $('#batsman2_onstrike').html('');
    } else {
        $('#batsman2_highlight').css('font-weight', 'bold');
        $('#batsman2_onstrike').html('*');
        $('#batsman1_highlight').css('font-weight', 'normal');
        $('#batsman1_onstrike').html('');
    }
}

function insertBallRecords(perball) {
    // temp value for over_id and batsman_id
    perball['over_id'] = $('#overId	').val();
    var ballid = $('#ballid');

    $.ajax({
        url: url + 'Live_score/insertBallRecords',
        type: "POST",
        data: perball,
        success: function(data) {

			var res = JSON.parse(data);
			// console.log(res);
			// console.log(res.ball_id);
			ballid.val(res.ball_id);
			
        }
    });

}
