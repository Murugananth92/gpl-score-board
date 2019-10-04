<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Users Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('user/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
						<th>User Name</th>
						<th>User Email</th>
						<th class="no-sort">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $u){ ?>
                    <tr>
						<td><?php echo $u['user_name']; ?></td>
						<td><?php echo $u['user_email']; ?></td>
						<td>
                            <a href="<?php echo site_url('user/remove/'.$u['user_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                </table>
                                
            </div>
        </div>
    </div>
</div>

