@foreach($items as $item)
  <li>
      @if(!$item->hasChildren())
      <a href="{{ $item->url() }}"><i class="fa fa-{{ $item->icon }}"></i>
      <span>{{ $item->title }}</span></a>
      @else
      <a href="#">
      <i class="fa fa-{{ $item->icon }}"></i>
            <span>{{ $item->title }}</span>
            </a>

       @endif

      @if($item->hasChildren())
        <ul>
              @include('partials.naviListelements', array('items' => $item->children()))
        </ul>
      @endif
  </li>
@endforeach