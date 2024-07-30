<div class="flex flex-col">
  <h3 class="text-2xl">{{ __('Search pets') }}</h3>

  <form action="{{ route('pets.search') }}" method="GET" class="flex flex-col space-y-4">
    <div class="flex flex-col space-y-2 pt-4">
      <label for="name">{{ __('Pet ID') }}</label>
      <input type="text" name="petId" class="border border-black" value="{{ \Request::query('petId') }}">
    </div>

    <div class="flex space-x-4">
      <button type="submit" class="w-fit py-2 px-4 text-white font-bold bg-blue-500 hover:bg-blue-700 rounded">
        {{ __('Search') }}
      </button>

      @if (\Request::has('petId'))
        <a href="{{ route('pets') }}" class="w-fit py-2 px-4 text-white font-bold bg-red-500 hover:bg-red-700 rounded">
          {{ __('Clear') }}
        </a>
      @endif
    </div>
  </form>
</div>
