<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Players Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('player/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Player Id</th>
						<th>Player Name</th>
						<th>Player Avatar</th>
						<th>Player Email</th>
						<th>Company</th>
						<th>Employee Id</th>
						<th>Player Role</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($players as $p){ ?>
                    <tr>
						<td><?php echo $p['player_id']; ?></td>
						<td><?php echo $p['player_name']; ?></td>
						<td><?php echo $p['player_avatar']; ?></td>
						<td><?php echo $p['player_email']; ?></td>
						<td><?php echo $p['company']; ?></td>
						<td><?php echo $p['employee_id']; ?></td>
						<td><?php echo $p['player_role']; ?></td>
						<td>
                            <a href="<?php echo site_url('player/edit/'.$p['player_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('player/remove/'.$p['player_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
