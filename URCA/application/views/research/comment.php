<link href="<?php echo base_url('URCstyles/css/comments.css');?>" rel="stylesheet">

<div class="card shadow mb-4">
<div class="card-body">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Comments</h1>
</div>
<?php  
    foreach($research_data as $row){ ?>
        <form method="post" action="<?php echo base_url('research/comment/'.$row->publication_id)?>">
            <textarea name="comment" placeholder="Enter Comment"></textarea>
            <input class="submit" type="submit" value="Submit">
        </form>              
    <?php }
?>

<?php
    foreach($comment_data as $row){ ?>
        <div class="namedesc1"><label class="label1">By <b><?php echo $row->first_name.' '.$row->last_name ?></b> on <i><?php echo $row->time_created?></i></label>
            <div class="commentsec1"><?php echo $row->message ?></div>
            <!-- <input class="reply1" type="submit" value="Reply"> -->
        </div>      
    <?php }
?>

</div>
</div>
<!-- <div class="namedesc2"><label class="label2">By <b>Ryan Christian Imperial</b> on <i>2020-03-02 23:30:19</i></label>
    <div class="commentsec2">Thanks!</div>
    <input class="reply2" type="submit" value="Reply">
</div> -->
