<script type="text/javascript">
$(function () {
    $("table.formDialog tr td.field,table.formDialog caption").addClass("ui-widget ui-widget-header");
    $("table.formDialog tr td").addClass("ui-widget ui-widget-content");
    $("table.formDialog tr td.noClass").removeClass("ui-widget ui-widget-content");
    $('input[readonly="readonly"]').addClass("readonly");
    $('input[readonly!="readonly"]').removeClass("readonly");
    $('label').each(function() {
        $(this).addClass('title');
    });
    $('.radio label').each(function() {
        $(this).removeClass('title');
    });
    $(".radio").buttonset();
});
</script>