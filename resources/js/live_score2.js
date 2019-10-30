var ball_number = 0;
var overnumber = 0;
var batsman1 = $('#batsman1_name').html();
var batsman2 = $('#batsman2_name').html();
var onstrike = batsman1;
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
    // var test = [];
    var perball = {};
    var perover = {};

    if (!is_extras && !is_wicket) {
        if (is_byes) {
            perball['byes'] = parseInt(runs);
            perball['runs_scored'] = 0;
            perover['byes'] += parseInt(runs);
            perover['runs_scored'] += 0;
            ball_number++;
        } else {
            perball['byes'] = 0;
            perball['runs_scored'] = parseInt(runs);
            perover['byes'] += 0;
            perover['runs_scored'] += parseInt(runs);
            ball_number++;
        }
    } else if (is_extras) {
        if (extras == 'wide') {
            perball['wide'] = 1;
            perover['wide'] += 1;
            if (runs > 0) {
                perball['byes'] = parseInt(runs);
                perball['runs_scored'] = 0;
                perover['byes'] += parseInt(runs);
                perover['runs_scored'] += 0;
            } else {
                perball['byes'] = 0;
                perball['runs_scored'] = 0;
                perover['byes'] += 0;
                perover['runs_scored'] += 0;
            }
            if (is_wicket) {
                perball['wicket'] = 1;
                perover['wicket'] += 1;
            }
        } else {
            perball['noball'] = 1;
            perover['noball'] += 1;
            if (is_byes) {
                perball['byes'] = parseInt(runs);
                perball['runs_scored'] = 0;
                perover['byes'] += parseInt(runs);
                perover['runs_scored'] += 0;
            } else {
                perball['byes'] = 0;
                perball['runs_scored'] = parseInt(runs);
                perover['byes'] += 0;
                perover['runs_scored'] += parseInt(runs);
            }
            if (is_wicket) {
                perball['wicket'] = 1;
                perover['wicket'] += 1;
            }
        }
    } else {
        perball['byes'] = 0;
        perball['wide'] = 0;
        perball['noball'] = 0;
        perball['runs_scored'] = parseInt(runs);
        perball['wicket'] = 1;
        perover['byes'] += 0;
        perover['wide'] += 0;
        perover['noball'] += 0;
        perover['runs_scored'] += parseInt(runs);
        perover['wicket'] += 1;
        ball_number++;
    }
    if (ball_number === 7) {
        ball_number = 1;
        overnumber++;
    }

    perball['ball_number'] = ball_number;
    perball['overnumber'] = overnumber;

    perball['onstrike'] = onstrike;
    nextstrike = on_strike(parseInt(runs));
    highlightStrike(nextstrike);
    perball['nextstrike'] = nextstrike;

    var bowler = $('#bowler_id').val();
    var batsman1id = $('#batsman1_id').val();
    var batsman2id = $('#batsman2_id').val();
    // console.log(bowler);
    perball['bowler'] = bowler;
    perball['batsman1'] = batsman1id;
    perball['batsman2'] = batsman2id;
    console.log(perball);
    // Function to insert Ball records
    //test.push(perball);
    insertBallRecords(perball);

    $('input[type="radio"]').prop('checked', false);
    $('input[type="checkbox"]').prop('checked', false);
});

function on_strike(runs) {
    if (runs % 2 != 0) {
        if (onstrike == batsman1) {
            onstrike = batsman2;
        } else {
            onstrike = batsman1;
        }
    }
    return onstrike;
};

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
    perball['over_id'] = 1;
    perball['batsman'] = 1;

    $.ajax({
        url: url + 'Live_score/insertBallRecords',
        type: "POST",
        data: perball,
        success: function(data) {
            console.log(data);
        }
    });

}