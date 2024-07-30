<x-app-layout>
  @if (session('message'))
    <div class="alert alert-success">
      {{ session('message') }}
    </div>
  @endif

  <form action="{{ route('pets.update', ['id' => $pet['id']]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="flex flex-col space-y-2">
      <label for="name">{{ __('Name') }}</label>
      <input type="text" name="name" value="{{ $pet['name'] }}">
    </div>

    <div class="flex flex-col space-y-2">
      <label for="name">{{ __('status') }}</label>
      <select name="status">
        <option value="available" {{ $pet['status'] === 'available' ? 'selected' : '' }}>{{ __('Available') }}</option>
        <option value="pending" {{ $pet['status'] === 'pending' ? 'selected' : '' }}>{{ __('Pending') }}</option>
        <option value="sold" {{ $pet['status'] === 'sold' ? 'selected' : '' }}>{{ __('Sold') }}</option>
      </select>
    </div>

    <div class="grid grid-cols-4 gap-4">
      <button type="submit">{{ __('Update') }}</button>
    </div>
  </form>

  <form action="{{ route('pets.destroy', ['id' => $pet['id']]) }}" method="GET">
    @csrf
    <button type="submit">{{ __('Delete') }}</button>
  </form>

  <a href="{{ route('pets') }}">{{ __('Back') }}</a>
</x-app-layout>