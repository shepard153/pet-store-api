<x-app-layout>
  @if (session('message'))
    <div class="alert alert-success">
      {{ session('message') }}
    </div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('pets.search') }}" method="GET">
    <div class="flex flex-col space-y-2">
      <label for="name">{{ __('ID') }}</label>
      <input type="text" name="petId" value="{{ \Request::query('petId') }}">
    </div>

    <div class="grid grid-cols-4 gap-4">
      <button type="submit">{{ __('Search') }}</button>
    </div>

    @if (\Request::query('petId'))
      <a href="{{ route('pets') }}">{{ __('Clear') }}</a>
    @endif
  </form>

  <form action="{{ route('pets.store') }}" method="POST">
    @csrf
    <div class="flex flex-col space-y-2">
      <label for="name">{{ __('Name') }}</label>
      <input type="text" name="name">
    </div>

    <div class="flex flex-col space-y-2">
      <label for="name">{{ __('status') }}</label>
      <select name="status">
        <option value="available">{{ __('Available') }}</option>
        <option value="pending">{{ __('Pending') }}</option>
        <option value="sold">{{ __('Sold') }}</option>
      </select>
    </div>

    <div class="grid grid-cols-4 gap-4">
      <button type="submit">{{ __('Create') }}</button>
    </div>
  </form>

  @if ($pets)
    <div class="flex flex-col">
      @foreach($pets as $pet)
        <div class="grid grid-cols-4 gap-4">
          <span>{{ $pet['name'] }}</span>
          <a href="{{ route('pets.show', ['id' => $pet['id']]) }}">{{ __('Edit') }}</a>
          <a href="{{ route('pets.destroy', ['id' => $pet['id']]) }}">{{ __('Delete') }}</a>
        </div>
      @endforeach
    </div>
  @else
    <div class="alert alert-info">
      {{ __('No pets found') }}
    </div>
  @endif
</x-app-layout>