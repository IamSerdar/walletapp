@if($category->parent()->exists())
@include('include.parent-name', ['category' => $category->parent])
@endif
{{ $category->name }} =>
