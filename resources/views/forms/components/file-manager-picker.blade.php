<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        x-data="{
            state: $wire.entangle('{{ $getStatePath() }}'),
            openFileManager() {
                // Define SetUrl globally before opening the popup
                window.SetUrl = (url) => {
                    // Set the state to the selected image url
                    this.state = url[0].url;
                };

                window.open('/filemanager?type=Images', 'FileManager', 'width=900,height=600');
            }
        }"
        class="space-y-2"
    >
        <div class="flex items-center space-x-2">
            <input
                type="text"
                class="filament-input w-full"
                x-model="state"
                readonly
                @click="openFileManager"
                placeholder="{{ __('Select an image') }}"
            />
        </div>

        <template x-if="state">
            <div class="mt-2 ">
                <img :src="state" class="h-24 rounded-md border" />
            </div>
        </template>

    </div>
</x-dynamic-component>
