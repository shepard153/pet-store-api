<x-app-layout>
  <div class="flex space-x-10 mt-4">
    @include('partials.create-pet')
    @include('partials.search-pets')
  </div>

  @if ($pets)
    <h2 class="text-2xl mt-8">{{ __('Pets') }}</h2>

    <div class="flex flex-col space-y-2 mt-8">
      @foreach($pets as $pet)
        <div class="flex space-x-8">
          <span>{{ isset($pet['name']) ? $pet['name'] : '' }}</span>

          <a href="{{ route('pets.show', ['id' => $pet['id']]) }}"
             class="w-fit py-2 px-4 text-white font-bold bg-blue-500 hover:bg-blue-700 rounded"
          >
            {{ __('Edit') }}
          </a>

          <a href="{{ route('pets.destroy', ['id' => $pet['id']]) }}"
             class="w-fit py-2 px-4 text-white font-bold bg-red-500 hover:bg-red-700 rounded"
          >
            {{ __('Delete') }}
          </a>
        </div>
      @endforeach
    </div>
  @else
    <div class="mt-8 text-2xl">
      {{ __('No pets found') }}
    </div>
  @endif
</x-app-layout>