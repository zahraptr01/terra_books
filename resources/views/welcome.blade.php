@extends('layouts.master')

@section('title')
    Home
@endsection

@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger">
    {{session('error')}}
</div>
@endif
    <h2>Selamat datang di TerraBooks!</h2>  
    <p>TerraBooks adalah platform perpustakaan digital yang menyediakan berbagai koleksi buku dari berbagai genre.</p> 
    <p>Kenapa TerraBooks?</p> 
    <ol>
        <li><b>Akses Mudah & Fleksibel</b> - Baca kapan saja dan di mana saja </li>
        <li><b>Koleksi Beragam</b> - Dari fiksi hingga akademik, semua ada di sini</li>
        <li><b>Fitur Interaktif</b> - Tambahkan komentar dan ulasan pada buku favoritmu</li>
    </ol>

    <p>Di halaman utama, pengguna dapat : </p>
    <ol>
        <li>Menjelajahi <b>koleksi buku</b> yang tersedia</li>
        <li>Melihat <b>daftar genre</b> untuk menemukan bacaan favorit </li>
        <li>Bergabung dalam komunitas pembaca dengan <b>fitur komentar</b></li>
        <li>Login atau daftar untuk pengalaman membaca yang lebih personal </li>
    </ol>
    <p><b>Mari jelajahi dunia melalui buku bersama TerraBooks!</b></p>
@endsection
