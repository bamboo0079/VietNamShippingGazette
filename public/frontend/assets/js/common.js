$(document).ready(function() {
    // =============================================
    // Skip Links
    // =============================================
    var skipLinks = $('.skip-link');
    var skipContents = $('.skip-content');

    skipLinks.on('click', function (e) {
        e.preventDefault();

        let self = $(this);
        let target = self.attr('data-target-element') ? self.attr('data-target-element') : self.attr('href');
        let elem = $(target);
        var isSkipContentOpen = elem.hasClass('skip-active') ? 1 : 0;

        // Hide all stubs
        $('html').removeClass('nav-open');
        skipLinks.removeClass('skip-active');
        skipContents.removeClass('skip-active');

        // Toggle stubs
        if (isSkipContentOpen) {
            self.removeClass('skip-active');
        } else {
            self.addClass('skip-active');
            elem.addClass('skip-active');
            if(self.attr('data-action') == 'next' || self.attr('data-action') == 'back'){
                $(".playAudio").trigger('click');
                $("#nextAction").val(self.attr('data-action'));
            }
        }
    });

    // Click outSite hide Element
    $(document).mouseup(function (e){
        if(!$(e.target).closest(skipLinks).length && !$(e.target).closest(skipContents).length) {
            skipLinks.removeClass('skip-active');
            skipContents.removeClass('skip-active');
        }
    });
});

// Fix Auto Height TextArea
function autosize() {
  var el = this;
  var timer;

  clearTimeout(timer);

  timer = setTimeout(function() {
    el.style.cssText = 'height: auto;';
    el.style.cssText = 'height:' + el.scrollHeight + 'px';
  },0);
}