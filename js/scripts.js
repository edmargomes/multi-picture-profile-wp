// Add events
jQuery(document).ready(($) => {

    multiPicture = () => {
        const $addButton = $('button.eg-upload');

        $addButton.on('click', event => {
            event.preventDefault();
            wp.media.editor.send.attachment = (props, attachment) => {
                if (attachment.type == "image") {
                    $('input.mm-sua-attachment-id').val(attachment.id);
                    $('div.eg-images').append(`<img data-id="${attachment.id}" class="eg-thumb" 
                        src="${attachment.sizes.thumbnail.url}" alt="${attachment.title}"/>`)
                    $('div.eg-images').append(`<button class="button">${Translates.Remove}</button>`)
                }
            };

            wp.media.editor.open();
        });
    }

    multiPicture();
});