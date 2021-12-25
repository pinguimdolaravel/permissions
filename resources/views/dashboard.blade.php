<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg space-y-1">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>

                <div class="bg-indigo-50 p-6 border-b border-indigo-400">
                    User
                    @can('edit-articles')
                        can
                    @else
                        can't
                    @endif
                    edit-articles
                </div>

                @for($i = 1; $i < 100; $i ++)
                    <div class="bg-indigo-50 p-6 border-b border-indigo-400">
                        User
                        @can('edit-articles')
                            can
                        @else
                            can't
                        @endif
                        edit-articles
                    </div>
                @endfor
            </div>
        </div>
    </div>
</x-app-layout>
