<div>
    <form action="{{ route($route, [$param=> $paramValue]) }}" method="POST">
        @method($method)
        @csrf
        <input type="hidden" value="{{ $valueKey }}" name="{{ $inputName }}" id="{{ $inputName }}">

        <button type="submit" class="{{ $classes }}">{{ $slot }}</button>
    </form>
</div>
