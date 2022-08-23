<?php $options = get_option('pidogame_framework') ?>
<div class="modal fade" tabindex="-1" id="kt_notification_modal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="modal-title-label"></span><span class="badge badge-primary ms-2 modal-badge"></span><span class="notification-date badge badge-light ms-2 ss02"></span></h5>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body text-gray-700 <?php echo $options['opt-header-notifications-fs'] ?> <?php echo $options['opt-header-notifications-lh'] ?>"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><?php echo $options['opt-header-notifications-close-button'] ?></button>
            </div>
        </div>
    </div>
</div>