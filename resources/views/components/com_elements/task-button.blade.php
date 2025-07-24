<div class="flex justify-center items-center">
    <form action="{{ route($route, [$param=> $paramValue]) }}" method="POST">
        @method($method)
        @csrf
        <input type="hidden" value="{{ $valueKey }}" name="{{ $inputName }}" id="{{ $inputName }}">
        <input type="hidden" value="2" name="tabNum" id="tabNum">

        <button type="submit" class="{{ $classes }}">{{ $slot }}</button>
    </form>
</div>
