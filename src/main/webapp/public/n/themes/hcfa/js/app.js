(function(){

    $('#activeModel').click(function(e){
        e.preventDefault();
        var docHeight = $(document).height();
        $('#popup-model').css('display','block');
        $("body").append("<div id='overlay'></div>");
        $("#overlay")
            .height(docHeight)
            .css({
                'opacity' : 0.8,
                'position': 'absolute',
                'top': 0,
                'left': 0,
                'background-color': 'black',
                'width': '100%',
                'z-index': 200
            });
        $(".modal-wrapper").css({
            //'position': 'absolute',
            'top': '16%',
            'left': '10%',
            'z-index': 999
        });
    });

    $('.cancel-action').click(function(){
        $("#popup-model").css('display','none');
        $("#overlay").remove();
    });
})();