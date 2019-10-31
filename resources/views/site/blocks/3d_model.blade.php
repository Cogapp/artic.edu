@php
    $model_url = $block->input('model_url');
    $model_id = $block->input('model_id');
    $caption = $block->input('model_caption');
    $embed_code = EmbedConverter::convertUrl($model_url);
    $thumbnail_url = $block->image('image');
    $guided_tour = $block->input('guided_tour');
    $artwork_id = Arr::first($block->browserIds('artworks'));
    $artwork = \App\Models\Api\Artwork::query()->find($artwork_id);
    $info_url = route('artworks.show', ['artwork' => $artwork]);
    switch($block->input('cc0_override')) {
        case 1:
            $cc0 = true;
            break;
        case 2:
            $cc0 = false;
            break;
        default:
            $cc0 = empty($artwork->copyright_notice) && $artwork->is_public_domain;
            break;
    }
    $camera_position = $block->input('camera_position');
    $camera_target = $block->input('camera_target');
    $annotation_list = $block->input('annotation_list');
@endphp

@if ($model_url)
    @component('components.molecules._m-media')
        @slot('variation', 'o-blocks__block')
        @slot('item', [
            'type' => 'embed',
            'size' => 's',
            'media' => ['embed' => $embed_code],
            'poster' => $thumbnail_url,
            'caption' => $caption
        ])
    @endcomponent
@endif

<!--<div>
    <h1>3D Model BLOCK HELLO</h1>
    <p>{{ $model_url }}</p>
    <p>{{ $model_id }}</p>
    <p>{{ $caption }}</p>
    <p>{{ $thumbnail_url }}</p>
    <p>{{ $info_url }}</p>
    <p>{{ $cc0 }}</p>
    <p>{{ $guided_tour }}</p>
    <p>{!! json_encode($camera_position) !!}</p>
    <p>{!! json_encode($camera_target) !!}</p>
    <p>{!! json_encode($annotation_list) !!}</p>
</div>-->