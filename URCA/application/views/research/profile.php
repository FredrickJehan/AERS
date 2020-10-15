
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User Profile</h1>
    </div>

    <div class="card shadow mb-4">
    <div class="card-body">
      <table class="table table-bordered ">
        <tbody>
          <?php foreach($user_details as $row){ ?>
          <tr>
            <td width="200"><b>Name</b></td>
            <td><?php echo $row->last_name?>, <?php echo $row->first_name?> <?php echo $row->middle_name?></td>
          </tr>  
          <tr>
            <td width="200"><b>Email</b></td>
            <td><?php echo $row->email?></td>
          </tr>
          <tr>
            <td width="200"><b>Department</b></td>
            <td><?php echo $row->department?></td>
          </tr>
          <?php } ?>
          </tbody>
      </table>
    </div>
    </div>

  <div class="d-sm-flex align-items-center justify-content-between mb-2">
    <h5 class="mb-0 text-gray-800">Completed Research</h5>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <?php foreach($completed_research as $row){ ?>
      <div class="card">
        <div class="card-body">
        <a href="<?php echo base_url('research/view/'.$row->publication_id);?>">
      <?php
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
      <?php if(!empty($row->url)){ ?>
        <?php echo implode(', ', $string) ?> (<?php echo $row->year?>). <i><?php echo $row->title?></i> (Master’s / Doctoral dissertation).
        <?php echo $row->location?>: <?php echo $row->institution?>. Retrieved from <?php echo $row->url?>
        </a>
      <?php }else{ ?>
        <?php echo implode(', ', $string) ?>
        (<?php echo $row->year?>). <i><?php echo $row->title?></i> (Master’s / Doctoral dissertation).
        <?php echo $row->location?>: <?php echo $row->institution?>.
      <?php } ?>
      </a>
      </div>
    </div>
    <?php } ?>
  </div>
  </div>

  <div class="d-sm-flex align-items-center justify-content-between mb-2">
    <h5 class="mb-0 text-gray-800">Presented Research</h5>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <?php foreach($presented_research as $row){ ?>
      <div class="card">
        <div class="card-body">
        <a href="<?php echo base_url('research/view/'.$row->publication_id);?>">
        <?php
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
        <?php echo implode(', ', $string) ?> (<?php echo date_format($date, "Y");?>, <?php echo date_format($date, "F");?>). <i><?php echo $row->title_presented;?></i>. Paper presented at the
        <?php echo $row->title_conference;?>, <?php echo $row->place_conference;?>.
        </a>
      </div>
    </div>
    <?php } ?>
  </div>
  </div>

  <div class="d-sm-flex align-items-center justify-content-between mb-2">
    <h5 class="mb-0 text-gray-800">Published Research</h5>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <?php foreach($published_research as $row){ ?>
      <div class="card">
        <div class="card-body">
        <a href="<?php echo base_url('research/view/'.$row->publication_id);?>">
          <?php
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
          <?php if($row->published_type == 'Journal Article'){ ?>
            <?php echo implode(', ', $string) ?>
            (<?php echo $row->year_published; ?>). <?php echo $row->title_article; ?>. <i><?php echo $row->title_journal; ?></i>.
            <?php echo $row->vol_num; if(isset($row->issue_num)){ ?>(<?php echo $row->issue_num; ?>),<?php }else{ ?>, <?php } ?>
            <?php echo $row->page_num; ?>.

          <?php }elseif($row->published_type == 'Book / Textbook'){ ?>
            <?php echo implode(', ', $string) ?> (<?php echo $row->year_published; ?>). <i><?php echo $row->title_book; ?></i>. 
            <?php echo $row->place_of_publication; ?>: <?php echo $row->publisher; ?>.

          <?php }elseif($row->published_type == 'Book Chapter'){ ?>
            <?php echo implode(', ', $string) ?> (<?php echo $row->year_published; ?>). <?php echo $row->title_chapter; ?>. In <?php echo implode(', ', $string_ed) ?>(Eds.),
            <i><?php echo $row->title_book; ?></i> (pp. <?php echo $row->page_num; ?>). <?php echo $row->place_of_publication; ?>: 
            <?php echo $row->publisher; ?>.

          <?php }else{ ?>
            <?php echo implode(', ', $string) ?> (<?php echo $row->year_published; ?>). <?php echo $row->title_article; ?>. In <?php echo implode(', ', $string_ed) ?>(Eds.),<?php echo $row->place_of_conference; ?> 
            (pp. <?php echo $row->page_num; ?>). <?php echo $row->place_of_publication; ?>: <?php echo $row->publisher; ?> 
            <?php if(isset($row->url)){ ?>
              .Retrieved from<?php echo $row->url; ?>
            <?php }else{ ?>.<?php } ?>

          <?php } ?>
        </a>
      </div>
    </div>
    <?php } ?>
  </div>
</div>

  <div class="d-sm-flex align-items-center justify-content-between mb-2">
    <h5 class="mb-0 text-gray-800">Creative Works</h5>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <?php foreach($creative_research as $row){ ?>
      <div class="card">
        <div class="card-body">
        <a href="<?php echo base_url('research/view/'.$row->publication_id);?>">
          <?php if(isset($row->middle_initial)){ ?>
            <?php echo $row->title_work?> By <?php echo $row->first_name?> <?php echo $row->middle_initial?> <?php echo $row->last_name?>.
          <?php }else{ ?>
            <?php echo $row->title_work?> By <?php echo $row->first_name?> <?php echo $row->last_name?>.
          <?php } ?>
        </a>
      </div>
    </div>
    <?php } ?>
  </div>
  </div>

</div>
<!-- /.container-fluid -->