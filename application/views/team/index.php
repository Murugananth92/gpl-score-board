<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Teams Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('team/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Team Name</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($teams as $t){ ?>
                    <tr>
						<td><?php echo $t['team_name']; ?></td>
						<td>
                            <a href="<?php echo site_url('team/edit/'.$t['team_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('team/remove/'.$t['team_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
