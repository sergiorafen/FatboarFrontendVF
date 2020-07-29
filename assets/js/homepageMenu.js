function selectedActive(elem) {
    var selectedAttr = $(elem),
            selectionID = "." + $(selectedAttr).data("select");

    $(".selecton a").removeClass("active");
    $(selectedAttr).addClass("active");
    $(".food-menu").removeClass("active");

    if (selectionID == ".*") $(".food-menu").addClass("active");
    else $(selectionID).addClass("active");
    }

    var selectedAttr = $('[data-select].active');
    selectedActive(selectedAttr);

    $('[data-select]').on("click", function () {
            var selectedAttr = $(this);
            selectedActive(selectedAttr);
            return false;
});