
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

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show position-fixed" role="alert"
     id="error-alert"
     style="top: 90px; right: 20px; max-width: 300px; z-index: 1050;">
    <ul class="list-unstyled mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

</div>

<script>
    setTimeout(() => {
        const alertBox = document.getElementById('error-alert');
        if (alertBox) {
            alertBox.classList.remove('show');
            alertBox.classList.add('fade');
            setTimeout(() => alertBox.remove(), 700); 
        }
    }, 3000);
</script>
@endif


@endsection

