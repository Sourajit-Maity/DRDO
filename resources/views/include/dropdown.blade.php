<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
ul.breadcrumb {
  padding: 10px 16px;
  list-style: none;
  background-color: #eee;
}
ul.breadcrumb li {
  display: inline;
  font-size: 18px;
}
ul.breadcrumb li+li:before {
  padding: 8px;
  color: black;
  content: ">>\00a0";
}
ul.breadcrumb li a {
  color: #0275d8;
  text-decoration: none;
}
ul.breadcrumb li a:hover {
  color: #01447e;
  text-decoration: underline;
}
</style>
</head>
<body>
@if (! empty($breadcrumbs))
<ul class="breadcrumb">
  <li class="breadcrumbs-bullet">
    <a href="{{ route('home') }}" class="breadcrumbs-link">
      <span class="breadcrumbs-link-text">Home</span>
    </a>
  </li>
  @foreach ($breadcrumbs as $label => $link)
  <li class="breadcrumbs-bullet">
    @if (is_int($label) && ! is_int($link))
    <a class="breadcrumbs-link">
      <span>{{ $link }}</span>
    </a>
    @else
    <a href="{{ $link }}" class="breadcrumbs-link">
      <span class="breadcrumbs-link-text">{{ $label }}</span>
    </a>
    @endif
  </li>
  @endforeach
</ul>
@endif

</body>
</html>