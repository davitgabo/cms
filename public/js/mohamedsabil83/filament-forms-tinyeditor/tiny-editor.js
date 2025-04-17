document.addEventListener('DOMContentLoaded', function () {
    const sortableClass = [
        'fi-fo-builder-item',
        'fi-fo-repeater-item',
    ];

    Livewire.hook('morph.updated', (el) => {
        if (!window.tinySettingsCopy) {
            return;
        }

        const isModalOpen = document.body.classList.contains('tox-dialog__disable-scroll');

        if (!isModalOpen && sortableClass.some(i => el.el.classList.contains(i))) {
            removeEditors();
            setTimeout(reinitializeEditors, 1);
        }
    })

    const removeEditors = debounce(() => {
        window.tinySettingsCopy.forEach(i => tinymce.execCommand('mceRemoveEditor', false, i.target.id));
    }, 50);

    const reinitializeEditors = debounce(() => {
        window.tinySettingsCopy = window.tinySettingsCopy.filter(obj => document.getElementById(obj.id));

        // Modify each editor's settings before initialization
        window.tinySettingsCopy.forEach(settings => {
            // Add Laravel File Manager configuration
            settings.file_picker_callback = function (callback, value, meta) {
                // Set the URL to open Laravel File Manager
                let route_prefix = '/laravel-filemanager'; // Adjust based on your route
                let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                let y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                // Set the URL based on file type
                let cmsURL = route_prefix + '?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images"; // For images
                } else {
                    cmsURL = cmsURL + "&type=Files"; // For other files
                }

                // Open Laravel File Manager in a popup window
                tinyMCE.activeEditor.windowManager.openUrl({
                    url: cmsURL,
                    title: 'File Manager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: 'yes',
                    close_previous: 'no',
                    onMessage: (api, message) => {
                        callback(message.content); // Pass the selected file URL to TinyMCE
                    }
                });
            }

            // Override image upload behavior
            settings.file_picker_types = 'file image media';
            settings.images_upload_handler = function(blobInfo, success, failure) {
                failure('Please use the file manager');
            };

            // Initialize TinyMCE with the modified settings
            tinymce.init(settings);
        });
    });

    function debounce(callback, timeout = 100) {
        let timer;
        return (...args) => {
            clearTimeout(timer);
            timer = setTimeout(() => {
                callback.apply(this, args);
            }, timeout);
        };
    }
})
