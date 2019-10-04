<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Tournament Players Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('tournament_player/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
						<th>Tournament Team Name</th>
						<th>Player Name</th>
						<th class="no-sort">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($tournament_players as $t){ ?>
                    <tr>
						<td><?php echo $t['team_name']; ?></td>
						<td><?php echo $t['player_name']; ?></td>
						<td>
                            <a href="<?php echo site_url('tournament_player/remove/'.$t['tournament_players_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>
