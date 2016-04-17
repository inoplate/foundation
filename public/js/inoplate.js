(function() {
  setInterval(function() {
    $.get('ping');
  }, $('meta[name="ping-interval"]').attr('content'));

}).call(this);

//# sourceMappingURL=inoplate.js.map
