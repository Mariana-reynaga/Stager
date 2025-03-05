<div>
    <div x-data="{currentVal: {{$percent}}, minVal: 0, maxVal: 100, calcPercentage(min, max, val){return (((val-min)/(max-min))*100).toFixed(0)} }" class="h-10 w-full mt-3 flex bg-gray-200 rounded-lg">

        @if ($percent != 0)
            <div class="h-full flex justify-center items-center rounded-lg bg-green-200" x-bind:style="`width: ${calcPercentage(minVal, maxVal, currentVal)}%`">
                <p>{{$percent}}%</p>
            </div>

        @else
            <div class="h-full w-full flex justify-center items-center">
                <p>{{$percent}}%</p>
            </div>
        @endif
    </div>
</div>
