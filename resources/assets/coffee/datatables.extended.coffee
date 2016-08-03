$('.datatable input[name="checkall"]').on 'ifChecked', (event) ->

    tableId = $ this
                .parents ".datatable"
                .attr "id"

    $ ".id-check", "##{tableId}"
        .iCheck "check"

    return

$.extend true, $.fn.dataTable.Buttons.defaults.dom,
    button: 
        tag: 'a'
    container:
        tag: 'div'
        className: 'box-buttons clearfix'

$.extend $.fn.dataTable.Buttons.defaults, buttons: [ 'reset', 'draw' ]

$ ".datatable"
    .on "change", ".id-check", (event) ->
        tableId = $ this 
                    .parents '.datatable' 
                    .attr 'id'

        isChecked = $ this 
                      .prop "checked"

        tr = $ this
                .parents tr

        table = $ "##{tableId}"
                    .DataTable()

        id = $ this
                .val()

        selected = table.settings()[0].oInit.selected

        index = $.inArray id, selected

        if isChecked
            if index == -1 
                table.settings()[0].oInit.selected.push id

        else
            if index != -1
                table.settings()[0].oInit.selected.splice index, 1

            $ "input[name='checkall']", "##{tableId}"
                .iCheck "uncheck"

        return 

$.fn.dataTable.ext.buttons.selected =
    init: ( dt, button, config )->
        that = this;

        dt.on 'change', '.id-check', () ->
            selected = dt.settings()[0].oInit.selected ? []
            
            enable = selected.length > 0

            that.enable enable
            return

        dt.on 'draw', (e, settings) ->
            selected = settings.oInit.selected ? []
            
            if selected.length > 0
                that.enable()
            else
                that.disable()
            return

        dt.on 'selected.reset', (e) ->
            that.disable()

        this.disable()
        return

$.fn.dataTable.ext.buttons.selectedSingle =
    init: ( dt, button, config )->
        that = this;

        dt.on 'change', '.id-check', () ->
            selected = dt.settings()[0].oInit.selected ? []
            enable = selected.length == 1

            that.enable enable
            return

        dt.on 'draw', (e, settings) ->
            selected = settings.oInit.selected ? []

            if selected.length == 1
                that.enable()
            else
                that.disable()
            return

        dt.on 'selected.reset', (e) ->
            that.disable()

        this.disable();

        return       

$.fn.dataTable.ext.buttons.bulk =
    init: ( dt, node, config )->
        $node = this.node()

        token = $ 'meta[name="csrf-token"]'
                    .attr 'content'

        formClass = if typeof config.formClass != 'undefined' then config.formClass else '';
        formId = if typeof config.formId != 'undefined' then "id=#{config.formId}" else '';

        method = config.method
        nodeInnerHTML = $node.html()

        attributes = $node.prop "attributes"
        $button = $ "<button type='submit'>#{nodeInnerHTML}</button>"
        buttonInnerHTML = $button.html()

        $.each attributes, ()->
            $button
                .attr this.name, this.value
                return

        $button
            .attr 'data-loading-text', "#{buttonInnerHTML} <i class='fa fa-circle-o-notch fa-spin'></i>"

        buttonOuterHTML = $button[0].outerHTML

        $form = $ "<form method='post' #{formId} class='ajax dt-draw #{formClass}'>
                    <input type='hidden' name='_method' value='#{method}'/>
                    <input type='hidden' name='_token' value='#{token}'/>
                    #{buttonOuterHTML}
                 </form>"

        $node.replaceWith $form

        $button = $ 'button', $form

        dt.on 'change', '.id-check', () ->
            selected = dt.settings()[0].oInit.selected ? []
            
            if selected.length > 0
                $button.removeClass 'disabled'
            else
                $button.addClass 'disabled'

            return

        dt.on 'draw', (e, settings) ->
            selected = settings.oInit.selected ? []
            
            if selected.length > 0
                $button.removeClass 'disabled'
            else
                $button.addClass 'disabled'
            return

        dt.on 'selected.reset', (e) ->
            $button.addClass 'disabled'

        $button.addClass 'disabled'

        ### Listen for ajax form's events ###

        $form
            .on 'ajax.form.beforeSend', (e, jqXHR, settings) =>
                ids = dt.settings()[0].oInit.selected.join()

                if typeof config.url == 'function'
                    action = config.url.apply(this, [ids])
                else
                    action = "#{config.url}/#{ids}"

                settings.url = action

                return

        $form
            .on 'ajax.form.success', () ->
                dt.settings()[0].oInit.selected = []
                setTimeout () ->
                    $button.addClass 'disabled'
                ,
                    0

                return

        $form
            .on 'ajax.form.error', () ->
                if dt.settings()[0].oInit.selected.length > 0
                    $button.removeClass 'disabled'

                return
        return

    action: (e, dt, node, config) ->
        selected = dt.settings()[0].oInit.selected.join()
        action = $ 'form', node
                        .prop 'action'
        
        action += '/' + selected

        $ 'form', node
            .prop 'action', action

        $ 'form', node
            .submit()

        return

$.fn.dataTable.ext.buttons.draw =
    text: '<i class="fa fa-refresh"></i>'
    className: 'btn btn-sm btn-default pull-left'
    key: '5'
    action: (e, dt, node, config) ->
        dt.draw false
        return

$.fn.dataTable.ext.buttons.reset =
    extend: "selected"
    text: '<i class="fa fa-circle-o"></i>'
    className: 'btn btn-sm btn-default pull-left'
    key: 'r'
    action: (e, dt, node, config) ->
        dt.settings()[0].oInit.selected = []

        tableNode = dt.table()
                    .node()

        tableId = $ tableNode
                    .attr "id"

        $ ".id-check", "##{tableId}"
            .iCheck("uncheck")

        $ tableNode
          .trigger "selected.reset.dt"

        return

###$.fn.dataTable.ext.errMode = 'none';

$ document
    .on 'error.dt', (e, settings, techNote, message) ->
        console.log 'An error has been reported by DataTables: ', message
    .DataTable()###

$.extend true, $.fn.dataTable.defaults,
    dom: '<"row"<"col-sm-12"B>><"row"<"col-sm-6"l><"col-sm-6"f>><"row"<"col-sm-12"rt>><"row"<"col-sm-5"i><"col-sm-7"p>>'
    serverSide: true
    processing: true
    retrieve: true
    stateSave: false
    ajax: 
        type: 'GET'
    language:
        processing: "<div class=\"loading\">Loading..</div>"
    initComplete: (settings, json) ->
        settings.oInit.selected = []

        container = this.api().table().container()

        $ container
            .append '<div class="row">
                        <div clas="col-sm-12">
                            <div class="modal fade" data-backdrop="static" role="dialog" aria-labelledby="form-modal"></div>
                        </div>
                    </div>'

        $ '.modal', container
            .modal
                show: false

        return
    drawCallback: (settings) ->
        $ @[0]
          .find 'input[name="checkall"]'
          .iCheck 'uncheck'

        return
    createdRow: (row, data, index) ->
        api = this.api()
        selected = api.settings()[0].oInit.selected ? []

        ###
            Set for as selection column 0
        ###

        $ 'td:eq(0)', row
            .html "<div class=\"checkbox icheck\"><input class=\"id-check\" type=\"checkbox\" value=\"#{data[0]}\" /></div>"

        exist = $.inArray data[0], selected

        if exist != -1
            $ '.id-check', row
              .prop 'checked', true

        $ 'input[data-method], select[data-method]', row
            .each () ->
                form = attachForm this

                td = $ this
                        .parents 'td'

                content = td.html()

                ###
                # Reset td inner html with form
                ###

                td.html form    

                ###
                # Append real content to form
                ###
                $ content
                  .appendTo $('form', td)

        $ 'select', row
            .select2();

        $ ':checkbox', row
            .iCheck
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '',
                labelHover: false,
                handle: 'checkbox'

        return

$ document
    .on 'ajax.form.success', '.dataTables_wrapper form.dt-draw', () ->
        dt = $ this
                .parents '.dataTables_wrapper'
                .find '.dataTable'
                .DataTable()

        dt.draw false