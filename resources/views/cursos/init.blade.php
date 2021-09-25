@extends('layouts.app')

@section('styles')
<style>
    /* Make the image fully responsive */
    .carousel-inner img {
      width: 50%;
      height: 90%;
    }
    </style>
@endsection

@section('content')
<div class="container">
    <h2>Bienvenido</h2>
    <h3>{{ Auth::user()->name }}</h3>
</div>
<div id="demo" class="carousel slide" data-ride="carousel" align="center">

    <!-- Indicators -->
    <ul class="carousel-indicators">
      <li data-target="#demo" data-slide-to="0" class="active"></li>
      <li data-target="#demo" data-slide-to="1"></li>
      <li data-target="#demo" data-slide-to="2"></li>
    </ul>
  
    <!-- The slideshow -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../assets/img/img1.png" alt="Los Angeles">
      </div>
      <div class="carousel-item">
        <img src="../assets/img/img2.png" alt="Chicago">
      </div>
      <div class="carousel-item">
        <img src="../assets/img/img3.png" alt="New York">
      </div>
    </div>
  
    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>
  
  </div>
  @endsection

    

