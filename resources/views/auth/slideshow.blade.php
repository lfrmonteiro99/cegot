<?php
$images = [];

$images[] = '/images/2016.05.-Brasil.05-(21).JPG';
$images[] = '/images/20180418165229_EN_222_1_portugalBX2.jpg';
$images[] = '/images/2018.07.-Agueda-(41).JPG';
$images[] = '/images/DSC_8505.JPG';
$images[] = '/images/FOTO_MMartins.jpg';
$images[] = '/images/krakow-1BX3.jpg';

$imagesToShow = [];
$usedRand = [];

while(count($imagesToShow) < 3){
    $rand = rand(0, 4);
    if (!in_array($rand, $usedRand)) {
        $imagesToShow[] = $images[$rand];
        $usedRand[] = $rand;
    }
}

?>
<div id="carouselExampleIndicators" style="position: absolute; width: 100%; top: 0" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        @foreach($imagesToShow as $key => $image)

        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$key}}" @if($key==0) class="active" @endif></li>
        @endforeach
    </ol>
    <div class="carousel-inner" style="max-height: 100vh">
        @foreach($imagesToShow as $key => $image)
        <div class="carousel-item @if($key == 0) active @endif">
            <img height="100%" src="{{ $image }}" class="d-block w-100" alt="{{$image}}">
        </div>
        @endforeach

    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </a>
</div>