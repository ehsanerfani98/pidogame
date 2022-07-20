<script>
    var hostUrl = "assets/";
    var templateDirectory = "<?php echo get_template_directory_uri() ?>";
</script>

<script src="<?php echo get_template_directory_uri() ?>/assets/plugins/global/plugins.bundle.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/plugins/custom/fslightbox/fslightbox.bundle.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/js/scripts.bundle.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/custom/js/scripts.bundle.js"></script>
<script>
       // Change attributes on modal (Buy product modal)
       var productBuyModal = document.getElementById('kt_modal_product_buy');
    if (productBuyModal) {
        productBuyModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            $(button).each(function () {
                $.each(this.attributes, function () {
                    if (this.specified && this.name.startsWith('data-bs-attribute')) {
                        var recipient = this.name.replace('data-bs-', '');
                        $('#kt_modal_product_buy').find('[name="' + recipient + '"]').val(this.value).trigger('change');
                    }
                });
            });
        })
    }
</script>

<?php wp_footer() ?>
</body>

</html>