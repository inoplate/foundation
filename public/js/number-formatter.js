(function() {
  this.NumberFormatter = (function() {
    function NumberFormatter(locale, options) {
      this.locale = locale || 'en';
      this.options = options || {};
      console.log(this.locale);
    }

    NumberFormatter.prototype.format = function(value) {
      $.when($.get("/vendor/inoplate-foundation/vendor/cldrjs/cldr/json/main/" + this.locale + "/numbers.json", function(result) {
        return Globalize.load(result);
      }), $.get("/vendor/inoplate-foundation/vendor/cldrjs/cldr/json/main/" + this.locale + "/currencies.json", function(result) {
        return Globalize.load(result);
      }), $.get("/vendor/inoplate-foundation/vendor/cldrjs/cldr/json/supplemental/currencyData.json", function(result) {
        return Globalize.load(result);
      }), $.get("/vendor/inoplate-foundation/vendor/cldrjs/cldr/json/supplemental/timeData.json", function(result) {
        return Globalize.load(result);
      }), $.get("/vendor/inoplate-foundation/vendor/cldrjs/cldr/json/supplemental/weekData.json", function(result) {
        return Globalize.load(result);
      }), $.get("/vendor/inoplate-foundation/vendor/cldrjs/cldr/json/supplemental/likelySubtags.json", function(result) {
        return Globalize.load(result);
      }), $.get("/vendor/inoplate-foundation/vendor/cldrjs/cldr/json/supplemental/plurals.json", function(result) {
        return Globalize.load(result);
      })).then((function(_this) {
        return function() {
          var formatter, globalize;
          globalize = Globalize("" + _this.locale);
          formatter = globalize.numberFormatter(_this.options);
          value = parseFloat(value);
          value = formatter(value);
          console.log(value);
          return formatter(value);
        };
      })(this));
    };

    return NumberFormatter;

  })();

}).call(this);

//# sourceMappingURL=number-formatter.js.map
