<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All labels') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <section class="max-w-xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <a href="{{ route('labels.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">{{ __('Create Label') }}</a>

            @forelse ($labels as $label)
                <article class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                    <div class="relative flex gap-8 items-start justify-between">
                        <div class="p-6 text-gray-900 dark:text-gray-100 flex-1">
                            <div class="flex flex-row gap-2 items-center w-full">
                                <div class="flex-1">
                                    <div class="flex gap-2 items-baseline">
                                        <p class="text-gray-500 text-xl">#{{ $label->id }}</p>
                                        <h1>{{ $label->name }}</h1>
                                    </div>
                                    <p class="text-sm text-muted-foreground">Tâches assignées : {{ $label->tasks_count }}</p>
                                </div>
                                <div style="--bg-color: {{ $label->color }}" class="flex-none size-8 rounded-full bg-[--bg-color]"></div>
                            </div>
                        </div>

                        <x-dropdown>
                            <x-slot name="trigger">
                                <button class="inline-flex items-center p-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-4 fill-current"><circle cx="12" cy="12" r="1"/><circle cx="12" cy="5" r="1"/><circle cx="12" cy="19" r="1"/></svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('labels.edit', $label)">
                                    {{ __('Edit label') }}
                                </x-dropdown-link>
                                <form action="{{ route('labels.destroy', $label) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="block w-full px-4 py-2 text-start text-sm leading-5 text-red-700 dark:text-red-300 hover:bg-red-100 dark:hover:bg-red-800 focus:outline-none focus:bg-red-100 dark:focus:bg-red-800 transition duration-150 ease-in-out">{{ __('Delete label') }}</button>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </article>
            @empty
                <div class="flex min-w-0 flex-1 flex-col items-center justify-center gap-6 rounded-lg border-dashed p-6 text-center text-balance md:p-12 from-gray-600/50 to-bg-gray-900 h-full bg-gradient-to-b from-30%">
                    <div class="mb-2 [&_svg]:pointer-events-none [&_svg]:shrink-0 bg-gray-600 text-white flex size-10 shrink-0 items-center justify-center rounded-lg [&_svg:not([class*='size-'])]:size-6">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10.656V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h12.344"/><path d="m9 11 3 3L22 4"/></svg>
                    </div>
                    <div class="flex max-w-sm flex-col items-center gap-2 text-center">
                        <div class="text-white text-lg font-medium tracking-tight">Aucun label à afficher</div>
                        <div class="text-gray-500 [&>a:hover]:text-primary text-sm/relaxed [&>a]:underline [&>a]:underline-offset-4">Vous n'avez pas encore créé de label. Créez-en un dès maintenant !</div>
                    </div>
                    <div class="flex w-full max-w-sm min-w-0 flex-col items-center gap-4 text-sm text-balance">
                        <a href="{{ route('labels.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">{{ __('Create Label') }}</a>
                    </div>
                </div>
            @endforelse
        </section>
    </div>
</x-app-layout>
