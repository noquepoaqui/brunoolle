(function($) {
    function findAncestor(el, cls) {
        while ((el = el.parentElement) && !el.classList.contains(cls));
        return el;
    }

    function unwrap(el) {
        var parent = el.parentNode;
        while (el.firstChild) parent.insertBefore(el.firstChild, el);
        parent.removeChild(el);
    }

    tinymce.PluginManager.add( 'columns', function( editor, url ) {
        // Add Button to Visual Editor Toolbar
        editor.addButton('columns', {
            title: 'Insert Column',
            cmd: 'columns',
            image: url + '/columns.png',
        });

        editor.addCommand('columns', function() {
            const selected_node = editor.selection.getNode();
            const selected_element = editor.selection.getSel().baseNode;
            const columnContainer = findAncestor(selected_element, 'two-columns');
            const rowContainer = findAncestor(selected_element, 'row');

            if (columnContainer) {
                unwrap(columnContainer);
                unwrap(rowContainer);
                return;
            }

            const selected_text = editor.selection.getContent({
                fomat: 'html'
            });
            if ( selected_text.length === 0 ) {
                alert( 'Please select some text.' );
                return;
            }

            let return_text = '';

            const open_column = '<div class="row"><div class="two-columns"><p>';
            const close_column = '</p></div><div class="two-columns"><p>&nbsp;</p></div></div>';
            return_text = open_column + selected_node.outerHTML + close_column;

            editor.execCommand('mceReplaceContent', false, return_text);
            return;
        });
    });
})(jQuery);
