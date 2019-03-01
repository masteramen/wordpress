(function($) {
  jQuery.fn.scrollFix = function(height, dir) {
    height = height || 0;
    height = height == "top" ? 0 : height;
    return this.each(function() {
      
      if (height == "bottom") {
        height = document.documentElement.clientHeight - this.scrollHeight;
      } else if (height < 0) {
        height =
          document.documentElement.clientHeight - this.scrollHeight + height;
      }
      var that = $(this),
        oldHeight = false,
        p,
        r,
        l = that.offset().left;
      dir = dir == "bottom" ? dir : "top"; //默认滚动方向向下
      var holder = $('<div />').hide().insertAfter(that).height(that.height());
      if (window.XMLHttpRequest) {
        //非ie6用fixed

        function getHeight() {
          //>=0表示上面的滚动高度大于等于目标高度
          return (
            (document.documentElement.scrollTop || document.body.scrollTop) +
            height -
            that.offset().top
          );
        }
        $(window).scroll(function() {
          if (oldHeight === false) {
            if (
              (getHeight() >= 0 && dir == "top") ||
              (getHeight() <= 0 && dir == "bottom")
            ) {
              oldHeight = that.offset().top - height;
              that.css({
                position: "fixed",
                top: height,
                left: l
              });
              holder.show();
            }
          } else {
            if (
              dir == "top" &&
              (document.documentElement.scrollTop || document.body.scrollTop) <
                oldHeight
            ) {
              that.css({
                position: "static"
              });
              oldHeight = false;
              holder.hide();
            } else if (
              dir == "bottom" &&
              (document.documentElement.scrollTop || document.body.scrollTop) >
                oldHeight
            ) {
              that.css({
                position: "static"
              });
              oldHeight = false;
              holder.hide();
            }
          }
        });
      } 
    });
  };
})(jQuery);
jQuery(document).ready(function() {
  jQuery(".fixedme").scrollFix("top", "top");
});
