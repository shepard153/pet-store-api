<div class="flex flex-col">
  <h3 class="text-2xl">{{ __('Create a new pet') }}</h3>

  <form action="{{ route('pets.store') }}" method="POST" class="flex flex-col space-y-4">
    @csrf
    <div class="flex flex-col w-48 space-y-2">
      <label for="name">{{ __('Name') }}</label>
      <input type="text" id="name" name="name" class="border border-black">
    </div>

    <div class="flex flex-col w-48 space-y-2">
      <label for="status">{{ __('Status') }}</label>
      <select id="status" name="status">
        <option value="available">{{ __('Available') }}</option>
        <option value="pending">{{ __('Pending') }}</option>
        <option value="sold">{{ __('Sold') }}</option>
      </select>
    </div>

    <button type="submit" class="w-fit py-2 px-4 text-white font-bold bg-blue-500 hover:bg-blue-700 rounded">
      {{ __('Create') }}
    </button>
  </form>
</div>
