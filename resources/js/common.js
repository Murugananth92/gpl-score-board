$(document).ready(function(){
    $("#startMatch").click(function(e){
		
        var team1Count = 0;
        $( ".team_1" ).each(function() {
            if($(this).prop("checked") == true){
                team1Count++;
             }
        });
        var team2Count = 0;
        $( ".team_2" ).each(function() {
            if($(this).prop("checked") == true){
                team2Count++;
             }
        });
        if(team1Count !== 11 || team2Count !== 11){
            swal("Error", "Each team should select only 11 players", "error");
                return;
        }   
        else{
            $("#playins_elevens").submit();
        } 
    
    });        
    
});
