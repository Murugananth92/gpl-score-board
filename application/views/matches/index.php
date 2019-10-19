<!-- hiii -->
<?php  
// echo"<pre>";
//         print_r($matches);
//         die;

?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Matches</h3>
                <?php if($this->session->flashdata('msg')) { ?>
                    <div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> The match has been deleted.
                    </div>
                <?php } ?>
                <?php if($this->session->flashdata('edit_msg')) { ?>
                    <div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> The match detail has been edited.
                    </div>
                <?php } ?>
                <?php if($this->session->flashdata('add_msg')) { ?>
                    <div class="alert alert-success alert-dismissible fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> The match has been added.
                    </div>
                <?php } ?>
            	<div class="box-tools">
                    <a href="<?php echo site_url('matches/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                
                <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                            <tr>
                                <th>Match_no</th>
                                <th>Team 1</th>
                                <th>Team 2</th>
                                <th>Match_date</th>
                                <th>Match_Venue</th>
                                <th>Status</th>
                                <th class="no-sort">Actions</th>
                            </tr>
                    </thead>
                    <tbody>
                        <?php foreach($matches as $m){ ?>
                            <tr>
                                <td><?php echo $m['match_id']; ?></td>
                                <td><?php echo $m['team1']; ?></td>
                                <td><?php echo $m['team2']; ?></td>
                                <td><?php echo $m['match_date']; ?></td>
                                <td><?php echo $m['match_venue']; ?></td>
                                <td><?php echo "not_started"; ?></td>
                                <td>
                                    <a href="<?php echo site_url('matches/delete/'.$m['match_id']); ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-xs"><span class="fa fa-pencil"></span> Delete</a>
                                    <a href="<?php echo site_url('start_match/index/'.$m['match_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Start match</a> 
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>      
                              
            </div>
        </div>
    </div>
</div>


