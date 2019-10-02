<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Tournament Teams Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('tournament_team/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Tournament Name</th>
						<th>Team Name</th>
						<th>Captain Name</th>
						<th>Vice Captain Name</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($tournament_teams as $t){ ?>
                    <tr>
						<td><?php echo $t['tournament_name']; ?></td>
						<td><?php echo $t['team_name']; ?></td>
						<td><?php echo $t['captain']; ?></td>
						<td><?php echo $t['vice_captain']; ?></td>
						<td>
                            <a href="<?php echo site_url('tournament_team/edit/'.$t['tournament_team_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('tournament_team/remove/'.$t['tournament_team_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>



