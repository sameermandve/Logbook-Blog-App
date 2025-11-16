@extends("layouts.profile")

@section("title", "Logbook | Profile")

@section("profile-content")

<!-- From ProfileController → showUserProfile() => $user & $posts -->
<x-profile-page :user="$user" :posts="$posts" />

@endsection