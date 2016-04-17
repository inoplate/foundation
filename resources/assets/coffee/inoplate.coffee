setInterval () ->
    $.get 'ping'
    return
,
    $ 'meta[name="ping-interval"]'
      .attr 'content'