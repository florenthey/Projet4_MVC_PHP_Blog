<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="min-height: 200px;">

<div class="toast" data-delay="3000" style="position: absolute; top: 0; right: 0;">
    <div class="toast-header">
      <strong class="mr-auto">Message</strong>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      <?= $this->session->show('login') ?>
    </div>
  </div>
</div>
