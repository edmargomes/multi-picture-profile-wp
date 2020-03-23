// Add events
jQuery(document).ready(($) => {

    multiPicture = () => {
        const $addButton = $('button.eg-upload');

        $addButton.on('click', event => {
            event.preventDefault();
            wp.media.editor.open();
        });
    }

    multiPicture();
});