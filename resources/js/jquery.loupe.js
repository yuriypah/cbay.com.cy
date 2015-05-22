function loupe(obj) {
    var image = $('<img/>', {
        class: 'loupeImage',
        src : obj.attr('src')
    }).css({
        width: (obj.width * 2) + 'px',
        height: (obj.height * 2) + 'px'

    });
    var offset = obj.offset(), bg = $('<div/>', {
        'class': 'loupe'
    }).css({
        'position': 'absolute',
        'background': 'url(/resources/images/loupe.png)',
        'position': 'absolute',
        'top': offset.top,
        'left': offset.left,
        width: '200px',
        height: '127px'
    });
    image.appendTo(bg);
    bg.appendTo('body');

}