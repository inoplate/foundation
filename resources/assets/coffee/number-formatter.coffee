class @NumberFormatter
    constructor: (locale, options) ->
        @locale = locale || 'en'
        @options = options || {}

        console.log @locale

    format: (value) ->
        $.when(
            $.get( "/vendor/inoplate-foundation/vendor/cldrjs/cldr/json/main/#{@locale}/numbers.json", (result) -> Globalize.load(result) ),
            $.get( "/vendor/inoplate-foundation/vendor/cldrjs/cldr/json/main/#{@locale}/currencies.json", (result) -> Globalize.load(result) ),
            $.get( "/vendor/inoplate-foundation/vendor/cldrjs/cldr/json/supplemental/currencyData.json", (result) -> Globalize.load(result) ),
            $.get( "/vendor/inoplate-foundation/vendor/cldrjs/cldr/json/supplemental/timeData.json", (result) -> Globalize.load(result) ),
            $.get( "/vendor/inoplate-foundation/vendor/cldrjs/cldr/json/supplemental/weekData.json", (result) -> Globalize.load(result) ),
            $.get( "/vendor/inoplate-foundation/vendor/cldrjs/cldr/json/supplemental/likelySubtags.json", (result) -> Globalize.load(result) ),
            $.get( "/vendor/inoplate-foundation/vendor/cldrjs/cldr/json/supplemental/plurals.json", (result) -> Globalize.load(result) )
        ).then () =>
            globalize = Globalize "#{@locale}"
            formatter = globalize.numberFormatter @options;
            value = parseFloat value
            value = formatter value
            console.log value
            return formatter value

        return