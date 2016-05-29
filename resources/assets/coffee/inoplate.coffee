setInterval () ->
    $.get '/ping'
    return
,
    $ 'meta[name="ping-interval"]'
      .attr 'content'

window.getLocalStorage = (key) =>
    console.log isLocalStorageSupported()
    if !isLocalStorageSupported()
        null
    else
        value = localStorage.getItem(key)

        try
            JSON.parse value
        catch e
            value

window.setLocalStorage = (key, value) =>
    if isLocalStorageSupported()

        try
            if typeof value == 'object'
                value = JSON.stringify value

            localStorage.setItem(key, value)
        catch e
            console.error e


isLocalStorageSupported = () ->
    return typeof localStorage != 'undefined'
