<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifikasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if($notifications->count() > 0)
                        <div class="flow-root">
                            <ul role="list" class="-my-5 divide-y divide-gray-200">
                                @foreach($notifications as $notification)
                                <li class="py-5">
                                    <div class="relative focus-within:ring-2 focus-within:ring-indigo-500">
                                        <h3 class="text-sm font-semibold text-gray-800">
                                            <a href="#" class="hover:underline focus:outline-none">
                                                <!-- Extend touch target to entire panel -->
                                                <span class="absolute inset-0" aria-hidden="true"></span>
                                                {{ $notification->title }}
                                            </a>
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-600 line-clamp-2">
                                            {!! preg_replace('~(https?://\S+)~', '<a href="$1" target="_blank" class="text-blue-600 hover:underline">$1</a>', e($notification->message)) !!}
                                        </p>
                                        <div class="mt-2 text-xs text-gray-400">
                                            {{ $notification->created_at->diffForHumans() }}
                                            @if(!$notification->is_read)
                                                <span class="inline-flex items-center rounded-full bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ml-2 ring-1 ring-inset ring-red-600/10">Baru</span>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <div class="mt-6">
                            {{ $notifications->links() }}
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <h3 class="mt-2 text-sm font-semibold text-gray-900">Tidak ada notifikasi</h3>
                            <p class="mt-1 text-sm text-gray-500">Kami akan memberi tahu Anda jika ada pembaruan penting mengenai janji temu Anda.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
