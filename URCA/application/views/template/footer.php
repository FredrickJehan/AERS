
          </div>
          <!-- End of Main Content -->

      </div>
      <!-- End of Page Wrapper -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Ateneo de Naga University &copy; URCA</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php echo base_url('logout')?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

</body>

</html>
<script>
$(document).ready(function(){

  function load_unseen_notification(view = ''){
    $.ajax({
        url:"<?php echo base_url("notification");?>",
        method: "POST",
        data:{view:view},
        dataType: "json",
        success:function(data){
          $("#notif").html(data.load_notif);
          if(data.unseen_notif > 0){
            $("#count").html(data.unseen_notif);  
          }
        }
    });
  }

  load_unseen_notification();

$(document).on('click', '#dropdown', function(){
  $('#count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();
 }, 5000);
});
</script>
