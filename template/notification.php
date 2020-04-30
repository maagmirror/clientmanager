
<!-- Flexbox container for aligning the toasts -->
<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center">

  <!-- Then put toasts within -->
  <div id="notification"  class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
    <div class="toast-header">
    <img src="https://nibiru.com.uy/favicon.ico" width="20px" class="rounded mr-2">
    <strong class="mr-auto">Notificacion</strong>
      <!-- <small>1 sec ago</small> -->
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
        <?php echo $message?>
    </div>
  </div>
</div>

