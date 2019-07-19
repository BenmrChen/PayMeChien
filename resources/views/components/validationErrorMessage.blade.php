@if($errors)
  <ul>
    @foreach($errors->all() as $err)
      <li> {{ $err }}</li>
    @endforeach
  </ul>
@endif

