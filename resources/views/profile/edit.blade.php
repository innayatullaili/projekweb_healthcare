<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight">
            {{ __('Pengaturan Akun') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Sidebar (Visual Navigation) -->
                <div class="w-full md:w-1/4">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sticky top-24">
                        <div class="p-4 bg-gray-50 border-b border-gray-100">
                            <h3 class="font-bold text-gray-700">Menu</h3>
                        </div>
                        <nav class="flex flex-col p-2 space-y-1">
                            <a href="#profile-info" class="flex items-center px-4 py-2 text-sm font-medium text-primary bg-blue-50 rounded-md transition-colors">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                Profil Saya
                            </a>
                            <a href="#update-password" class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-md transition-colors">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                Keamanan
                            </a>
                            <a href="#delete-account" class="flex items-center px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50 rounded-md transition-colors">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Hapus Akun
                            </a>
                        </nav>
                    </div>
                </div>

                <!-- Main Content Area -->
                <div class="w-full md:w-3/4 space-y-6">
                    
                    <!-- Profile Information -->
                    <div id="profile-info" class="bg-white overflow-hidden shadow-sm sm:rounded-lg scroll-mt-24">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 border-b pb-4 mb-6">Informasi Pribadi</h3>
                            <div class="max-w-xl">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>
                    </div>

                    <!-- Update Password -->
                    <div id="update-password" class="bg-white overflow-hidden shadow-sm sm:rounded-lg scroll-mt-24">
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 border-b pb-4 mb-6">Update Password</h3>
                            <div class="max-w-xl">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>
                    </div>

                    <!-- Delete Account -->
                    <div id="delete-account" class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-red-100 scroll-mt-24">
                        <div class="p-6">
                            <div class="flex items-center mb-6 border-b border-red-100 pb-4">
                                <div class="bg-red-100 p-2 rounded-full mr-4 text-red-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                </div>
                                <h3 class="text-lg font-bold text-red-700">Zona Bahaya</h3>
                            </div>
                            <div class="max-w-xl">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
