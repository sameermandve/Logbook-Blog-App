@extends("layouts.profile")

@section("title", "Logbook | Profile")

@section("profile-content")

<!-- From ProfileController → selfProfileShow() => $user & $posts -->
<x-profile-page :user="$user" :posts="$posts" />

@endsection