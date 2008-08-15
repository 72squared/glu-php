// to set WMD's options programatically, define a "wmd_options" object with whatever settings
// you want to override.  Here are the defaults:
wmd_options = {
    // format sent to the server.  Use "Markdown" to return the markdown source.
    output: "Markdown",

    // line wrapping length for lists, blockquotes, etc.
    lineLength: 40,

    // toolbar buttons.  Undo and redo get appended automatically.
    buttons: "bold italic | link blockquote code image | ol ul heading hr",
    
    // option to automatically add WMD to the first textarea found.  See apiExample.html for usage.
    autostart: true
};