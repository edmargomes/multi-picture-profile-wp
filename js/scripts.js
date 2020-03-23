// Add events
jQuery(document).ready(($) => {

    multiPicture = () => {
        const $addButton = $('button.eg-upload');
        const $setProfileButton = $('button.eg-setprofile');
        const $removeButton = $('button.eg-remove');
        const maxImages = pluginSettings.maximum_profile_images || -1

        $addButton.on('click', event => {
            event.preventDefault();

            wp.media.editor.send.attachment = (props, attachment) => {
                if (attachment.type == "image") {
                    imageProfile = [
                        `<div class="picture-container-profile">`,
                            `<input type="hidden" name="eg_pictures_ids[]" value="${attachment.id}"/>`,
                            `<input type="radio" name="eg_profile" value="${attachment.id}">${Translates.set_profile}<BR>`,
                            `<img data-id="${attachment.id}" class="eg-thumb" src="${attachment.sizes.thumbnail.url}" alt="${attachment.title}"/>`,
                            `<button class="button eg-remove">${Translates.Remove}</button>`,
                        `<div>`
                    ].join('');
                    //Add thumbs image
                    if (maxImages == -1 || $('div.eg-images > div').length < maxImages)
                        $('div.eg-images').append(imageProfile)
                }
            };

            wp.media.editor.open();
        });

        $setProfileButton.each(function ($element, a) {
            $(a).on('click', (event) => {
                $(this).parent().addClass('selected')
                return false;
            })
        })

        $removeButton.each (function ($element, a){
            $(a).on('click', (event) => {
                $(this).parent().remove();
            })
        })
    }

    multiPicture();
});