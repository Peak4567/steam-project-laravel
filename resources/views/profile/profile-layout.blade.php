@extends('layout')

@section('content')
<section class="min-h-screen bg-[#F8F9FA] py-12">
    <div class="max-w-screen-xl mx-auto flex flex-col md:flex-row gap-8 px-6">
        
        <div class="flex-shrink-0">
            <x-frontend.profile.sidebar /> 
        </div>

        <div class="flex-grow w-full">
            @yield('profile-content') 
        </div>

    </div>
</section>
@endsection