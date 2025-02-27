<div>
    <div x-data="{ characters: 0 }" x-init="characters = $refs.textArea.value.length">
        <div class="flex justify-between items-center">
            <x-inputs.label-form>
                <x-slot name="forName">{{ $colName }}</x-slot>
                <x-slot name="title">{{$labelTitle}}</x-slot>
                {{$labelTagline}}
            </x-inputs.label-form>

            <div class="p-2 rounded-md bg-roscuro text-white">
                <p>
                    <span x-html="characters"></span> /
                    <span x-html="$refs.textArea.maxLength"></span>
                </p>
            </div>
        </div>

        <textarea
            name="{{ $colName }}"
            id="{{ $colName }}"
            cols="30"
            rows="5"
            class="
                border
                border-solid
                border-gray-600
                rounded-md
                p-2
                w-full
                focus:outline
                focus:outline-2
                focus:outline-rclaro
            "
            maxlength="{{$maxlength}}"
            x-ref="textArea"
            x-on:keyup="characters = $refs.textArea.value.length"
        >{{ old($colName, $colPastData) }}</textarea>
    </div>

    {{$slot}}
</div>
