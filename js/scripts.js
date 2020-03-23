// Add events
jQuery(document).ready(($) => {

    multiPicture = () => {
        const $addButton = $('button.eg-upload');

        $addButton.on('click', event => {
            event.preventDefault();
            wp.media.editor.send.attachment = (props, attachment) => {
                if (attachment.type == "image") {
                    imageProfile = [
                        `<div class="picture-container-profile">`,
                            `<input type="hidden" name="eg_pictures_ids[]" value="${attachment.id}"/>`,
                            `<img data-id="${attachment.id}" class="eg-thumb" src="${attachment.sizes.thumbnail.url}" alt="${attachment.title}"/>`,
                            `<button class="button">${Translates.Remove}</button>`,
                        `<div>`
                    ].join('');
                    //Add thumbs image
                    $('div.eg-images').append(imageProfile)
                }
            };

            wp.media.editor.open();
        });
    }

    multiPicture();
});