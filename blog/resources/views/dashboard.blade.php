<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{ __("You're logged in!") }}
                        </div>
                    </div>
                </div>
            </div>

            @if(auth()->user()->isAdmin)
            <a href="{{ route('posts.create') }}" class="text-blue-500">Create a post</a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Search Users') }}
                    </h2>

                    <form action="{{ route('dashboard.search') }}" method="POST">
                        @csrf
                        <input type="text" name="search" placeholder="Search users...">
                        <button type="submit">Search</button>
                    </form>

                    <!-- showing the search results -->
                    @if(isset($search))
                    <h3>Search Results for "{{ $search }}":</h3>
                    @if($users->isEmpty())
                    <p>No users found.</p>
                    @else
                    <ul>
                        @foreach($users as $user)
                        <li><a href="{{ route('profile.profile', $user) }}">{{ $user->username }}</a></li>
                        @endforeach
                    </ul>
                    @endif
                    @endif
                </div>

                <div class="max-w-xl mt-8">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Posts') }}
                    </h2>

                    @foreach ($posts as $post)
                    <div class="bg-gray-100 p-4 mb-4">
                        <h3 class="text-xl font-bold">{{ $post->title }}</h3>
                        <p class="text-sm text-gray-500">{{ $post->publishing_date }}</p>
                        <img src="{{ asset($post->cover_image) }}" alt="{{ $post->title }}"
                            class="post-cover-image mt-2">
                        <div class="mt-2">{{ $post->content }}</div>
                        <!-- Admin-only buttons for editing and deleting -->
                        @if(auth()->user()->isAdmin)
                        <div class="mt-2">
                            <a href="{{ route('posts.edit',['post' => $post->postId]) }}" class="text-blue-500">Edit</a>
                            <form action="{{ route('posts.delete', ['post' => $post->postId]) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
