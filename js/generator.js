$('.tools').popover({
    html : true,
    content: function() {
        return $("#generator-tools").html();
    },
    placement : "bottom"
});
$('.picker').colorpicker();