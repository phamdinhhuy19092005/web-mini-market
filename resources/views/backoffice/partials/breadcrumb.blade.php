
@section('breadcrumb')
@if(! empty($items))
<div class="k-content__head	k-grid__item">
    <div class="k-content__head-main">
        <div class="k-content__head-breadcrumbs ">
            <p class="mr-5" style="margin-bottom: 0; font-size: 20px">{{$title}}</p>
            <a href="#" class="k-content__head-breadcrumb-home">
                <i class="flaticon2-shelter"></i>
            </a>

            @foreach($items as $item)
                @php
                    $rawLabel = data_get($item, 'label', '');
                    $active = data_get($item, 'active', false);
                    $label = isset($ignoreTranslation) && $ignoreTranslation ? $rawLabel : __($rawLabel);
                @endphp
            <span class="k-content__head-breadcrumb-separator"></span>
                <a href="{{ data_get($item, 'href', '#') }}" class="k-content__head-breadcrumb-link">{{ $label }}</a>

                @if ($active)
                    <span class="k-content__head-breadcrumb-separator"></span>
                    <a href="{{ data_get($item, 'href', '#') }}" class="k-content__head-breadcrumb-link k-content__head-breadcrumb-link--active">{{ $label }}</a>
                @endif
            @endforeach

        </div>

    </div>
</div>
@endif
@endsection

