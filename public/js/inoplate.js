(function() {
  var isLocalStorageSupported;

  setInterval(function() {
    Pace.ignore(function() {
      $.get('/ping');
    });
  }, $('meta[name="ping-interval"]').attr('content'));

  window.getLocalStorage = (function(_this) {
    return function(key) {
      var e, error, value;
      console.log(isLocalStorageSupported());
      if (!isLocalStorageSupported()) {
        return null;
      } else {
        value = localStorage.getItem(key);
        try {
          return JSON.parse(value);
        } catch (error) {
          e = error;
          return value;
        }
      }
    };
  })(this);

  window.setLocalStorage = (function(_this) {
    return function(key, value) {
      var e, error;
      if (isLocalStorageSupported()) {
        try {
          if (typeof value === 'object') {
            value = JSON.stringify(value);
          }
          return localStorage.setItem(key, value);
        } catch (error) {
          e = error;
          return console.error(e);
        }
      }
    };
  })(this);

  isLocalStorageSupported = function() {
    return typeof localStorage !== 'undefined';
  };

}).call(this);

//# sourceMappingURL=inoplate.js.map
