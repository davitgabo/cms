<div wire:ignore>
    <textarea id="tiny-{{ $nameId }}" name="{{ $name }}">{{ old($name, $value) }}</textarea>
</div>

<script src="https://cdn.tiny.cloud/1/myncqh8aqgr9s8wqyp4mc0f7n75fmr6p0elix7zck5z8jy61/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Create a safe selector ID by replacing dots with underscores
        const selectorId = '{{ $nameId }}';
        const selector = '#tiny-' + selectorId;
        const fieldName = '{{ $name }}';
        const livewireFieldPath = '{{ $livewireFieldPath }}';

        if (tinymce.get(selector.substring(1))) {
            tinymce.get(selector.substring(1)).remove();
        }

        tinymce.init({
            selector: selector,
            plugins: 'lists link image table code media codesample emoticons wordcount fullscreen',
            toolbar: 'undo redo | styles fontsize | bold italic | alignjustify alignleft aligncenter alignright | bullist numlist | forecolor backcolor | blockquote table hr | image link media codesample emoticons | wordcount fullscreen',
            height: 600,
            fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
            block_formats: 'Paragraph=p; Header 1=h1; Header 2=h2; Header 3=h3; Preformatted=pre',
            file_picker_callback: function (callback, value, meta) {
                // Set the URL to open Laravel File Manager
                let route_prefix = '/filemanager'; // Adjust based on your route
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
            },
            setup: function (editor) {
                editor.on('init', function (e) {
                    // Initialize the editor with the content
                    // No need to set content manually as it's already in the textarea
                });

                editor.on('change keyup blur', function () {
                    // Save content to the original textarea
                    editor.save();

                    // Dispatch a Livewire set event with the updated content
                    // Using the proper path for the JSON field
                @this.set(livewireFieldPath, editor.getContent());
                });
            }
        });
    });
</script>
