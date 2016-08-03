(function() {
  $('.datatable input[name="checkall"]').on('ifChecked', function(event) {
    var tableId;
    tableId = $(this).parents(".datatable").attr("id");
    $(".id-check", "#" + tableId).iCheck("check");
  });

  $.extend(true, $.fn.dataTable.Buttons.defaults.dom, {
    button: {
      tag: 'a'
    },
    container: {
      tag: 'div',
      className: 'box-buttons clearfix'
    }
  });

  $.extend($.fn.dataTable.Buttons.defaults, {
    buttons: ['reset', 'draw']
  });

  $(".datatable").on("change", ".id-check", function(event) {
    var id, index, isChecked, selected, table, tableId, tr;
    tableId = $(this).parents('.datatable').attr('id');
    isChecked = $(this).prop("checked");
    tr = $(this).parents(tr);
    table = $("#" + tableId).DataTable();
    id = $(this).val();
    selected = table.settings()[0].oInit.selected;
    index = $.inArray(id, selected);
    if (isChecked) {
      if (index === -1) {
        table.settings()[0].oInit.selected.push(id);
      }
    } else {
      if (index !== -1) {
        table.settings()[0].oInit.selected.splice(index, 1);
      }
      $("input[name='checkall']", "#" + tableId).iCheck("uncheck");
    }
  });

  $.fn.dataTable.ext.buttons.selected = {
    init: function(dt, button, config) {
      var that;
      that = this;
      dt.on('change', '.id-check', function() {
        var enable, ref, selected;
        selected = (ref = dt.settings()[0].oInit.selected) != null ? ref : [];
        enable = selected.length > 0;
        that.enable(enable);
      });
      dt.on('draw', function(e, settings) {
        var ref, selected;
        selected = (ref = settings.oInit.selected) != null ? ref : [];
        if (selected.length > 0) {
          that.enable();
        } else {
          that.disable();
        }
      });
      dt.on('selected.reset', function(e) {
        return that.disable();
      });
      this.disable();
    }
  };

  $.fn.dataTable.ext.buttons.selectedSingle = {
    init: function(dt, button, config) {
      var that;
      that = this;
      dt.on('change', '.id-check', function() {
        var enable, ref, selected;
        selected = (ref = dt.settings()[0].oInit.selected) != null ? ref : [];
        enable = selected.length === 1;
        that.enable(enable);
      });
      dt.on('draw', function(e, settings) {
        var ref, selected;
        selected = (ref = settings.oInit.selected) != null ? ref : [];
        if (selected.length === 1) {
          that.enable();
        } else {
          that.disable();
        }
      });
      dt.on('selected.reset', function(e) {
        return that.disable();
      });
      this.disable();
    }
  };

  $.fn.dataTable.ext.buttons.bulk = {
    init: function(dt, node, config) {
      var $button, $form, $node, attributes, buttonInnerHTML, buttonOuterHTML, formClass, formId, method, nodeInnerHTML, token;
      $node = this.node();
      token = $('meta[name="csrf-token"]').attr('content');
      formClass = typeof config.formClass !== 'undefined' ? config.formClass : '';
      formId = typeof config.formId !== 'undefined' ? "id=" + config.formId : '';
      method = config.method;
      nodeInnerHTML = $node.html();
      attributes = $node.prop("attributes");
      $button = $("<button type='submit'>" + nodeInnerHTML + "</button>");
      buttonInnerHTML = $button.html();
      $.each(attributes, function() {
        $button.attr(this.name, this.value);
      });
      $button.attr('data-loading-text', buttonInnerHTML + " <i class='fa fa-circle-o-notch fa-spin'></i>");
      buttonOuterHTML = $button[0].outerHTML;
      $form = $("<form method='post' " + formId + " class='ajax dt-draw " + formClass + "'> <input type='hidden' name='_method' value='" + method + "'/> <input type='hidden' name='_token' value='" + token + "'/> " + buttonOuterHTML + " </form>");
      $node.replaceWith($form);
      $button = $('button', $form);
      dt.on('change', '.id-check', function() {
        var ref, selected;
        selected = (ref = dt.settings()[0].oInit.selected) != null ? ref : [];
        if (selected.length > 0) {
          $button.removeClass('disabled');
        } else {
          $button.addClass('disabled');
        }
      });
      dt.on('draw', function(e, settings) {
        var ref, selected;
        selected = (ref = settings.oInit.selected) != null ? ref : [];
        if (selected.length > 0) {
          $button.removeClass('disabled');
        } else {
          $button.addClass('disabled');
        }
      });
      dt.on('selected.reset', function(e) {
        return $button.addClass('disabled');
      });
      $button.addClass('disabled');

      /* Listen for ajax form's events */
      $form.on('ajax.form.beforeSend', (function(_this) {
        return function(e, jqXHR, settings) {
          var action, ids;
          ids = dt.settings()[0].oInit.selected.join();
          if (typeof config.url === 'function') {
            action = config.url.apply(_this, [ids]);
          } else {
            action = config.url + "/" + ids;
          }
          settings.url = action;
        };
      })(this));
      $form.on('ajax.form.success', function() {
        dt.settings()[0].oInit.selected = [];
        setTimeout(function() {
          return $button.addClass('disabled');
        }, 0);
      });
      $form.on('ajax.form.error', function() {
        if (dt.settings()[0].oInit.selected.length > 0) {
          $button.removeClass('disabled');
        }
      });
    },
    action: function(e, dt, node, config) {
      var action, selected;
      selected = dt.settings()[0].oInit.selected.join();
      action = $('form', node).prop('action');
      action += '/' + selected;
      $('form', node).prop('action', action);
      $('form', node).submit();
    }
  };

  $.fn.dataTable.ext.buttons.draw = {
    text: '<i class="fa fa-refresh"></i>',
    className: 'btn btn-sm btn-default pull-left',
    key: '5',
    action: function(e, dt, node, config) {
      dt.draw(false);
    }
  };

  $.fn.dataTable.ext.buttons.reset = {
    extend: "selected",
    text: '<i class="fa fa-circle-o"></i>',
    className: 'btn btn-sm btn-default pull-left',
    key: 'r',
    action: function(e, dt, node, config) {
      var tableId, tableNode;
      dt.settings()[0].oInit.selected = [];
      tableNode = dt.table().node();
      tableId = $(tableNode).attr("id");
      $(".id-check", "#" + tableId).iCheck("uncheck");
      $(tableNode).trigger("selected.reset.dt");
    }
  };


  /*$.fn.dataTable.ext.errMode = 'none';
  
  $ document
      .on 'error.dt', (e, settings, techNote, message) ->
          console.log 'An error has been reported by DataTables: ', message
      .DataTable()
   */

  $.extend(true, $.fn.dataTable.defaults, {
    dom: '<"row"<"col-sm-12"B>><"row"<"col-sm-6"l><"col-sm-6"f>><"row"<"col-sm-12"rt>><"row"<"col-sm-5"i><"col-sm-7"p>>',
    serverSide: true,
    processing: true,
    retrieve: true,
    stateSave: false,
    ajax: {
      type: 'GET'
    },
    language: {
      processing: "<div class=\"loading\">Loading..</div>"
    },
    initComplete: function(settings, json) {
      var container;
      settings.oInit.selected = [];
      container = this.api().table().container();
      $(container).append('<div class="row"> <div clas="col-sm-12"> <div class="modal fade" data-backdrop="static" role="dialog" aria-labelledby="form-modal"></div> </div> </div>');
      $('.modal', container).modal({
        show: false
      });
    },
    drawCallback: function(settings) {
      $(this[0]).find('input[name="checkall"]').iCheck('uncheck');
    },
    createdRow: function(row, data, index) {
      var api, exist, ref, selected;
      api = this.api();
      selected = (ref = api.settings()[0].oInit.selected) != null ? ref : [];

      /*
          Set for as selection column 0
       */
      $('td:eq(0)', row).html("<div class=\"checkbox icheck\"><input class=\"id-check\" type=\"checkbox\" value=\"" + data[0] + "\" /></div>");
      exist = $.inArray(data[0], selected);
      if (exist !== -1) {
        $('.id-check', row).prop('checked', true);
      }
      $('input[data-method], select[data-method]', row).each(function() {
        var content, form, td;
        form = attachForm(this);
        td = $(this).parents('td');
        content = td.html();

        /*
         * Reset td inner html with form
         */
        td.html(form);

        /*
         * Append real content to form
         */
        return $(content).appendTo($('form', td));
      });
      $('select', row).select2();
      $(':checkbox', row).iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '',
        labelHover: false,
        handle: 'checkbox'
      });
    }
  });

  $(document).on('ajax.form.success', '.dataTables_wrapper form.dt-draw', function() {
    var dt;
    dt = $(this).parents('.dataTables_wrapper').find('.dataTable').DataTable();
    return dt.draw(false);
  });

}).call(this);

//# sourceMappingURL=datatables.extended.js.map
