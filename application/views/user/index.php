<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Users</h3>
                <?php if($this->session->flashdata('msg')) { ?>
                    <div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> The user has been deleted.
                    </div>
                <?php } ?>
            	<div class="box-tools">
                </div>
            </div>
            <div class="box-body">
                <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
						<th>User Name</th>
						<th>User Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $u){ ?>
                    <tr>
						<td><?php echo $u['user_name']; ?></td>
						<td><?php echo $u['user_email']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
                </table>               
            </div>
        </div>
    </div>
</div>

