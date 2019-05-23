@if($errors)
<!-- 上面 AND以後不寫也可以 不寫應該比較好-->
  <ul>
    @foreach($errors->all() as $err)
      <li> {{ $err }}</li>
    @endforeach
  </ul>
@endif

