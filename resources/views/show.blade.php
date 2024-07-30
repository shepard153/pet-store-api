<x-app-layout>
  <form action="{{ route('pets.update', ['id' => $pet['id']]) }}" method="POST" class="flex flex-col space-y-4">
    @csrf
    @method('PUT')
    <div class="flex flex-col w-48 space-y-2">
      <label for="name">{{ __('Name') }}</label>
      <input type="text" id="name" name="name" class="border border-black" value="{{ $pet['name'] }}">
    </div>

    <div class="flex flex-col w-48 space-y-2">
      <label for="status">{{ __('status') }}</label>
      <select id="status" name="status">
        <option value="available" {{ $pet['status'] === 'available' ? 'selected' : '' }}>{{ __('Available') }}</option>
        <option value="pending" {{ $pet['status'] === 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
        <option value="sold" {{ $pet['status'] === 'sold' ? 'selected' : '' }}>{{ __('Sold') }}</option>
      </select>
    </div>

    <button type="submit" class="w-fit py-2 px-4 text-white font-bold bg-blue-500 hover:bg-blue-700 rounded">
      {{ __('Update') }}
    </button>
  </form>

  <form action="{{ route('pets.destroy', ['id' => $pet['id']]) }}" method="GET" class="flex mt-4">
    @csrf
    <button type="submit" class="w-fit py-2 px-4 text-white font-bold bg-red-500 hover:bg-red-700 rounded">
      {{ __('Delete') }}
    </button>

    <a href="{{ route('pets') }}" class="w-fit ml-2 py-2 px-4 text-white font-bold bg-sky-500 hover:bg-sky-700 rounded">
      {{ __('Back') }}
    </a>
  </form>
</x-app-layout>