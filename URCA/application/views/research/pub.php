<?php
  if(isset($this->session->userdata['logged_in'])) {
  }else {
    redirect(base_url());
  }
?>
  <!-- Page Heading -->

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
                      <?php if($row->status == 'Approved'){ ?>
                      <a href="<?php echo base_url('research/view/'.$row->publication_id);?>">
                            <?php if(!empty($row->url)){ ?>
                                <?php echo implode(', ', $string) ?>
                                (<?php echo $row->year?>). <i><?php echo $row->title?></i> (Master’s / Doctoral dissertation).
                                <?php echo $row->location?>: <?php echo $row->institution?>. Retrieved from <?php echo $row->url?>
                            <?php }else{ ?>
                                <?php echo implode(', ', $string) ?>
                                (<?php echo $row->year?>). <i><?php echo $row->title?></i> (Master’s / Doctoral dissertation).
                                <?php echo $row->location?>: <?php echo $row->institution?>.
                            <?php } ?>
                      </a>
                     <?php }else{
                                if(!empty($row->url)){ ?>
                                <?php echo implode(', ', $string) ?>
                                (<?php echo $row->year?>). <i><?php echo $row->title?></i> (Master’s / Doctoral dissertation).
                                <?php echo $row->location?>: <?php echo $row->institution?>. Retrieved from <?php echo $row->url?>
                            <?php }else{ ?>
                                <?php echo implode(', ', $string) ?>
                                (<?php echo $row->year?>). <i><?php echo $row->title?></i> (Master’s / Doctoral dissertation).
                                <?php echo $row->location?>: <?php echo $row->institution?>.
                    <?php } } ?>
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
                $date = date_create("$row->date_presentation");     
            ?>
              <tr>
                <td>
                    <?php echo implode(', ', $string) ?>
                </td>
                <td><?php echo $row->department?></td>
                <td><?php echo $row->publication_type?></td>
                <td>
                <?php if($row->status == 'Approved'){ ?>
                  <a href="<?php echo base_url('research/view/'.$row->publication_id);?>">
                    <?php echo implode(', ', $string) ?>
                    (<?php echo date_format($date, "Y");?>, <?php echo date_format($date, "F");?>). <i><?php echo $row->title_conference;?></i>. Paper presented at the
                    <?php echo $row->title_conference;?>, <?php echo $row->place_conference;?>.
                  </a>
                <?php }else{ ?>
                    <?php echo implode(', ', $string) ?>
                    (<?php echo date_format($date, "Y");?>, <?php echo date_format($date, "F");?>). <i><?php echo $row->title_conference;?></i>. Paper presented at the
                    <?php echo $row->title_conference;?>, <?php echo $row->place_conference;?>.
                <?php } ?>
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
                      <?php if($row->status == 'Approved'){ ?>
                      <a href="<?php echo base_url('research/view/'.$row->publication_id);?>">
                        <?php echo implode(', ', $string) ?>
                        (<?php echo $row->year_published; ?>). <?php echo $row->title_article; ?>. <i><?php echo $row->title_journal; ?></i>.
                        <?php echo $row->vol_num; if(isset($row->issue_num)){ ?>(<?php echo $row->issue_num; ?>),<?php }else{ ?>, <?php } ?>
                        <?php echo $row->page_num; ?>.
                      </a>
                      <?php }else{ ?>
                        <?php echo implode(', ', $string) ?>
                        (<?php echo $row->year_published; ?>). <?php echo $row->title_article; ?>. <i><?php echo $row->title_journal; ?></i>.
                        <?php echo $row->vol_num; if(isset($row->issue_num)){ ?>(<?php echo $row->issue_num; ?>),<?php }else{ ?>, <?php } ?>
                        <?php echo $row->page_num; ?>.
                      <?php } ?>

                    <?php }elseif($row->published_type == 'Book / Textbook'){ ?>
                      <?php if($row->status == 'Approved'){ ?>
                      <a href="<?php echo base_url('research/view/'.$row->publication_id);?>">
                        <?php echo implode(', ', $string) ?>
                        (<?php echo $row->year_published; ?>). <i><?php echo $row->title_book; ?></i>. <?php echo $row->place_of_publication; ?>: 
                        <?php echo $row->publisher; ?>.
                      </a>
                      <?php }else{ ?>
                        <?php echo implode(', ', $string) ?>
                        (<?php echo $row->year_published; ?>). <i><?php echo $row->title_book; ?></i>. <?php echo $row->place_of_publication; ?>: 
                        <?php echo $row->publisher; ?>.
                      <?php } ?>

                    <?php }elseif($row->published_type == 'Book Chapter'){ ?>
                      <?php if($row->status == 'Approved'){ ?>
                      <a href="<?php echo base_url('research/view/'.$row->publication_id);?>">
                        <?php echo implode(', ', $string) ?>
                        (<?php echo $row->year_published; ?>). <?php echo $row->title_chapter; ?>. In <?php echo implode(', ', $string_ed) ?>(Eds.),
                        <i><?php echo $row->title_book; ?></i> (pp. <?php echo $row->page_num; ?>). <?php echo $row->place_of_publication; ?>: 
                        <?php echo $row->publisher; ?>.
                      </a>
                      <?php }else{ ?>
                        <?php echo implode(', ', $string) ?>
                        (<?php echo $row->year_published; ?>). <?php echo $row->title_chapter; ?>. In <?php echo implode(', ', $string_ed) ?>(Eds.),
                        <i><?php echo $row->title_book; ?></i> (pp. <?php echo $row->page_num; ?>). <?php echo $row->place_of_publication; ?>: 
                        <?php echo $row->publisher; ?>.
                      <?php } ?>

                    <?php }else{ ?>
                      <?php if($row->status == 'Approved'){ ?>
                      <a href="<?php echo base_url('research/view/'.$row->publication_id);?>">
                        <?php echo implode(', ', $string) ?>
                        (<?php echo $row->year_published; ?>). <?php echo $row->title_article; ?>. In <?php echo implode(', ', $string_ed) ?>(Eds.),<?php echo $row->place_of_conference; ?> 
                        (pp. <?php echo $row->page_num; ?>). <?php echo $row->place_of_publication; ?>: <?php echo $row->publisher; ?> 
                        <?php if(isset($row->url)){ ?>
                        .Retrieved from<?php echo $row->url; ?>
                        <?php }else{ ?>.<?php } ?>
                      </a>
                      <?php }else{ ?>
                        <?php echo implode(', ', $string) ?>
                        (<?php echo $row->year_published; ?>). <?php echo $row->title_article; ?>. In <?php echo implode(', ', $string_ed) ?>(Eds.),<?php echo $row->place_of_conference; ?> 
                        (pp. <?php echo $row->page_num; ?>). <?php echo $row->place_of_publication; ?>: <?php echo $row->publisher; ?> 
                        <?php if(isset($row->url)){ ?>
                        .Retrieved from<?php echo $row->url; ?>
                        <?php }else{ ?>.<?php } ?>
                      <?php } } ?>
                    </td>
                </tr>
            <?php }?>
            <?php foreach($creative as $row){ 
              $string = array();
                $i = 0;
                foreach($authors as $name){
                  if($row->publication_id == $name->publication_id){
                    if(isset($name->middle_initial)){
                      $string[$i] = $name->first_name . " " . $name->middle_initial . " " . $name->last_name;  
                    }else{
                      $string[$i] = $name->first_name . " " . $name->last_name;   
                    }
                    $i++;
                  }
                }
            ?>
                <tr>
                    <td><?php echo implode(', ', $string) ?></td>
                    <td><?php echo $row->department?></td>
                    <td><?php echo $row->publication_type?></td>
                    <td>
                      <?php if($row->status == 'Approved'){ ?>
                      <a href="<?php echo base_url('research/view/'.$row->publication_id);?>">
                        <?php echo $row->title_work?> By <?php echo implode(', ', $string) ?>
                      </a>
                      <?php }else{ ?>
                        <?php echo $row->title_work?> By <?php echo implode(', ', $string) ?>
                      <?php } ?>
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

