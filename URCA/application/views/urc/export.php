<?php
  if(isset($this->session->userdata['logged_in'])) {
  }else {
    redirect(base_url());
  }
?>
  <!-- Page Heading -->
  <div class="container">
    <div class="row">
            <div class="col-2">
                <form method="POST"action="<?php echo base_url()?>admin/pdfdetails">
                    <input type="submit" value="Export PDF" class="btn btn-info" />
                </form>
            </div>
            <div class="col-1.5">
                <form method="POST" action="<?php echo base_url(); ?>admin/export_excel">
                    <input type="submit" name="export" class="btn btn-success" value="Export Excel" />
                </form>
            </div>
            <div class="col-2">
                <form method="POST" action="<?php echo base_url(); ?>admin/export_json">
                    <input type="submit" class="btn btn-info" value="Export JSON" />
                </form>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-8">
                <form method="POST" action="<?php echo base_url(); ?>admin/import_json" enctype="multipart/form-data">
                    <label><b>Note: Upload text file with json code: </b></label>
                    <br />
                    <input type="submit" onclick="click()" class="btn btn-info" value="Import JSON">
                    <input type="file" name="file">
                </form>
                <?php if(isset($export_response)){
                    echo $export_response;
                } ?>
                <?php if(isset($error)){
                    echo $error;
                } ?>
                <?php if(isset($response)){
                    echo $response;
                } ?>
            </div>
        </div>
  </div>
  <br />
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" cellspacing="0">
            <thead>
              <tr>
                <th width="150">Name</th>
                <th width="200">Department</th> 
                <th width="180">Type of Research</th>
                <th>Citation</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($completed as $row){ 
                $string = array();
                $i = 0;
                foreach($authors as $name){
                  if($row->publication_id == $name->publication_id){
                    if(isset($name->middle_initial)){
                      $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . ". " . $name->middle_initial; 
                    }else{
                      $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . "."; 
                    }
                    $i++;
                  }
                }    
            ?>
                <tr>
                    <td>
                        <?php echo implode(', ', $string) ?>
                    </td>
                    <td><?php echo $row->department?></td>
                    <td><?php echo $row->publication_type?></td>
                    <td>
                        <?php if(!empty($row->url)){ ?>
                            <?php echo implode(', ', $string) ?>
                            (<?php echo $row->year?>). <i><?php echo $row->title?></i> (Master’s / Doctoral dissertation).
                            <?php echo $row->location?>: <?php echo $row->institution?>. Retrieved from <?php echo $row->url?>
                        <?php }else{ ?>
                            <?php echo implode(', ', $string) ?>
                            (<?php echo $row->year?>). <i><?php echo $row->title?></i> (Master’s / Doctoral dissertation).
                            <?php echo $row->location?>: <?php echo $row->institution?>.
                        <?php } ?>
                    </td>
                </tr>
            <?php }?>

            <?php foreach($presented as $row){ 
                $string = array();
                $i = 0;
                foreach($authors as $name){
                  if($row->publication_id == $name->publication_id){
                    if(isset($name->middle_initial)){
                      $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . ". " . $name->middle_initial; 
                    }else{
                      $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . "."; 
                    }
                    $i++;
                  }
                }    
            ?>
              <tr>
                <td>
                    <?php echo implode(', ', $string) ?>
                </td>
                <td><?php echo $row->department?></td>
                <td><?php echo $row->publication_type?></td>
                <td>
                    <?php echo implode(', ', $string) ?>
                    (<?php echo $row->date_presentation;?>). <i><?php echo $row->title_conference;?></i>. Paper presented at the
                    <?php echo $row->title_conference;?>, <?php echo $row->place_conference;?>.</a>
                </td>
              </tr>
            <?php } ?>

            <?php foreach($published as $row){ 
                $string = array();
                $i = 0;
                foreach($authors as $name){
                  if($row->publication_id == $name->publication_id){
                    if(isset($name->middle_initial)){
                      $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . ". " . $name->middle_initial; 
                    }else{
                      $string[$i] = $name->last_name . ", " . substr($name->first_name, 0, 1) . "."; 
                    }
                    $i++;
                  }
                }
                $string_ed = array();
                $x = 0;
                foreach($editors as $ed){
                  if($row->published_id == $ed->published_id){
                    if(isset($ed->editor_mi)){
                      $string_ed[$x] = substr($ed->editor_fn, 0, 1) . ". " . $ed->editor_mi . " " . $ed->editor_ln; 
                    }else{
                      $string_ed[$x] = substr($ed->editor_fn, 0, 1) . ". " . $ed->editor_ln; 
                    }
                    $x++;
                  }
                }    
            ?>
                <tr>
                    <td>
                        <?php echo implode(', ', $string) ?>
                    </td>
                    <td><?php echo $row->department?></td>
                    <td><?php echo $row->publication_type?></td>
                    <td>
                    <?php if($row->published_type == 'Journal Article'){ ?>
                        <?php echo implode(', ', $string) ?>
                        (<?php echo $row->year_published; ?>). <?php echo $row->title_article; ?>. <i><?php echo $row->title_journal; ?></i>.
                        <?php echo $row->vol_num; if(isset($row->issue_num)){ ?>(<?php echo $row->issue_num; ?>),<?php }else{ ?>, <?php } ?>
                        <?php echo $row->page_num; ?>.

                    <?php }elseif($row->published_type == 'Book / Textbook'){ ?>
                        <?php echo implode(', ', $string) ?>
                        (<?php echo $row->year_published; ?>). <i><?php echo $row->title_book; ?></i>. <?php echo $row->place_of_publication; ?>: 
                        <?php echo $row->publisher; ?>.

                    <?php }elseif($row->published_type == 'Book Chapter'){ ?>
                        <?php echo implode(', ', $string) ?>
                        (<?php echo $row->year_published; ?>). <?php echo $row->title_chapter; ?>. In <?php echo implode(', ', $string_ed) ?>(Eds.),
                        <i><?php echo $row->title_book; ?></i> (pp. <?php echo $row->page_num; ?>). <?php echo $row->place_of_publication; ?>: 
                        <?php echo $row->publisher; ?>.

                    <?php }else{ ?>
                        <?php echo implode(', ', $string) ?>
                        (<?php echo $row->year_published; ?>). <?php echo $row->title_article; ?>. In <?php echo implode(', ', $string_ed) ?>(Eds.),<?php echo $row->place_of_conference; ?> 
                        (pp. <?php echo $row->page_num; ?>). <?php echo $row->place_of_publication; ?>: <?php echo $row->publisher; ?> 
                        <?php if(isset($row->url)){ ?>
                        .Retrieved from<?php echo $row->url; ?>
                        <?php }else{ ?>.<?php } ?>

                    <?php } ?>
                    </td>
                </tr>
            <?php }?>
            <?php foreach($creative as $row){ ?>
                <tr>
                    <td>
                        <?php foreach($author as $name){ 
                            if(isset($name->middle_initial)){
                        ?>
                                <?php echo $name->last_name?>,<?php echo substr($name->first_name, 0, 1)?>
                                <?php echo $name->middle_initial?>
                        <?php }else{ ?>
                                <?php echo $row->last_name?>,<?php echo substr($row->first_name, 0, 1)?>
                        <?php } } ?>
                    </td>
                    <td><?php echo $row->department?></td>
                    <td><?php echo $row->publication_type?></td>
                    <td>
                        <?php echo $row->title_work?> By <?php foreach($author as $name){
                            if(isset($name->middle_initial)){
                        ?>
                                        <?php echo $row->last_name?>,<?php echo substr($row->first_name, 0, 1)?>
                                        <?php echo $row->middle_initial?>
                        <?php }else{ ?>
                                        <?php echo $row->last_name?>,<?php echo substr($row->first_name, 0, 1)?>
                        <?php } } ?>
                    </td>
                </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>
<script>
  function click(){
    alert("Text file has been exported to directory");
  }
</script>
