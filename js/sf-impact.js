


jQuery(window).load(function () {
    var flex = jQuery('.sfly-img-fit .sfly-img-fixed'); //get all of the slideshows on the screen


    flex.each(function () {
        var slider = jQuery(this);
        slider.attr('data-sfheight', slider.height());
        slider.attr('data-add', slider.parent().height() - slider.height()) //get the extra space for the parent);

        slider.find('li').each(function () {
            li = jQuery(this);
            li.attr('data-sfwidth', li.width());
            li.find('img').each(function () {
                img = jQuery(this);
                img.css('max-width', img.width().toString() + 'px'); //set the max width of the 
            });
        });

        flexfit();
    });
});
var resizeTimer;

jQuery(window).on('resize', function(e) {

 /* clearTimeout(resizeTimer);
  resizeTimer = setTimeout(function() {
      */
    flexfit();
/*  }, 250);*/

});
function flexfit() {
    var flex = jQuery('.sfly-img-fit .sfly-img-fixed');

    flex.each(function () {
        var slider = jQuery(this);
        var parent = slider.parent();
        var height;
        slider.find('li').each(function () {
            //    var originalwidth = jQuery(this).attr('data-sfwidth');
            var width = jQuery(window).width();
            var img = jQuery(this).find('img');
            var childwidth = img.width();
            var childheight = img.height();
            var max = jQuery(this).attr('data-sfwidth');

            if (childwidth > width) {
                img.css('height', 'auto');
                img.css('width', '100%');
            }

        });

    });
    
};