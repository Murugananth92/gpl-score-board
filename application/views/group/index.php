<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Groups Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('group/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Group Name</th>
						<th>Tournament Id</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($groups as $g){ ?>
                    <tr>
						<td><?php echo $g['group_name']; ?></td>
						<td><?php echo $g['tournament_name']; ?></td>
						<td>
                        <a href="<?php echo site_url('group/edit/'.$g['group_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                        <a href="<?php echo site_url('group/remove/'.$g['group_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        <a href="<?php echo site_url('group_point/add'); ?>" class="btn btn-success btn-xs">Add teams</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
