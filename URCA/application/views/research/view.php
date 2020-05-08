<h4 class="my-4">View</h4>
    
<div class="card shadow mb-4">
<div class="card-body">
        <!-- Table of Submitees -->
        <table class="table table-bordered ">
        <tbody>
            <tr>
                <td width="200"><b>Author Name</b></td>
                <?php foreach ($research_data as $row){ ?>
                <td><?php echo $row->last_name?>, <?php echo $row->first_name?> <?php echo $row->middle_initial?></td>
            </tr>
            <tr>
                <td width="200"><b>Title of Research</b></td>
                <td><?php echo $row->title?></td>
            </tr>
            <!-- <tr>
                <td width="200"><b>Type of Research</b></td>
                <td><php echo $row->title?></td>
            </tr> -->
            <tr>
                <td width="200"><b>Status</b></td>
                <td>
                <?php 
                  if($row->status == '0'){
                    echo 'Not Yet Reviewed';
                  }else if($row->status == '1'){
                    echo 'Rejected'; echo $row->feedback;
                  }else if($row->status == '2'){
                    echo 'Approved';
                  }
                  ?>
                  </td>
            </tr>
            <tr>
                <td width="200"><b>Email</b></td>
                <td><?php echo $row->email?></td>
            </tr>
            <tr> 
                  <td width="200"><b>File</b></td></td>
                  <td><a href="<?=base_url().'pdf/'.$row->file;?>" target="_blank"><?php echo $row->file; ?></a></td>
                  <?php }?>
            </tr>
        </tbody>
        </table>
  </div>
  </div>
<?php
    if($publication_type == '1'){
        foreach($research_data as $row){?>
        <?php
            if($row->completed_type == '1'){?>
        
              
        <?php
            }else if($row->completed_type == '2'){
                echo 'technical';
            }   
        }
    }else if($publication_type == '2'){
        foreach($research_data as $row){?>
            <div class="form-group" style="text-align:center;">
            <a href="#" class="btn btn-primary">Go Back</a>
            <a href="<?php echo base_url('research/edit/'.$row->publication_id)?>" name="edit" class="btn btn-primary">Edit</a>
            </div><?php
            if($row->presented_type == '3'){
                echo 'paper';
            }else if($row->presented_type == '4'){
                echo 'poster';
            }   
        }
    }
?>
<?php
  if (isset($this->session->userdata['logged_in'])) {
    $user_type = ($this->session->userdata['logged_in']['user_type']);
  }else {
    redirect('login');
  }
?>
<?php
    foreach($research_data as $row){
      if($user_type == '1'){ ?>
        <div class="form-group" style="text-align:center;">
          <a class="btn btn-danger" href="#" id="reject" data-toggle="modal" data-target="#rejectModal">Reject</a>
          <a href="<?php echo base_url('admin/review/'.$row->publication_id);?>" class="btn btn-primary">Accept</a>
          <a href="<?php echo base_url('research/edit/'.$row->publication_id)?>" name="edit" class="btn btn-primary">Edit</a> 
        </div><?php 
      }else if($user_type == '0'){ ?>
            <div class="form-group" style="text-align:center;">
                <a href="" class="btn btn-primary">Go Back</a>
                <a href="<?php echo base_url('research/edit/'.$row->publication_id)?>" name="edit" class="btn btn-primary">Edit</a>
            </div>
    <?php }
      }
?>

<!-- Logout Modal-->
  <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Send Feedback</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <form method="post" action="<?php echo base_url('admin/review/'.$row->publication_id)?>">
          <div class="modal-body">
            <textarea name="feedback" class="form-control" placeholder="Enter Feedback" rows="5"></textarea>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <input class="btn btn-primary" value="Submit" type="submit"></input>
          </div>
        </form>
      </div>
    </div>
  </div>