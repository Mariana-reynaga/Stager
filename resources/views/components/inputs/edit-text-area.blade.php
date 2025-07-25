<div>
    <div x-data="{ characters: 0 }" x-init="characters = $refs.textArea.value.length">
        <div class="flex justify-between items-center">
            <div class="lg:w-3/4">
                <x-inputs.label-form>
                    <x-slot name="forName">{{ $colName }}</x-slot>
                    <x-slot name="title">{{$labelTitle}}</x-slot>
                    {{$labelTagline}}
                </x-inputs.label-form>
            </div>

            <div class="lg:mb-2 p-2 lg:w-fit lg:self-end rounded-md bg-roscuro text-white">
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
                p-2
                w-full
                border
                border-solid
                border-gray-600
                rounded-md
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
