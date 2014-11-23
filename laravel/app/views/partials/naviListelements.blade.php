@foreach($items as $item)
  <li @if($item->hasChildren()) class="dropdown" @endif>
      <a href="{{ $item->url() }}"><i class="fa fa-{{ $item->icon }}"></i> {{ $item->title }} </a>
      @if($item->hasChildren())
        <ul class="dropdown-menu">
              @include('custom-menu-items', array('items' => $item->children()))
        </ul>
      @endif
  </li>
@endforeach