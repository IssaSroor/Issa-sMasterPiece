<x-guest-layout>
    <div class="auth-container">
        <div class="auth-form">
            <!-- Page Title -->
            <h2>{{ $title }}</h2>

            <form method="POST" action="{{ $action }}">
                @csrf

                <!-- Form Fields -->
                @foreach ($fields as $field)
                    <div class="mt-4">
                        <x-input-label for="{{ $field['name'] }}" :value="__(ucwords($field['label']))" />
                        <x-text-input id="{{ $field['name'] }}" class="block mt-1 w-full" 
                                      type="{{ $field['type'] }}" name="{{ $field['name'] }}" 
                                      :value="old($field['name'])" {{ $field['required'] }} />
                        <x-input-error :messages="$errors->get($field['name'])" class="mt-2" />
                    </div>
                @endforeach

                <!-- Submit Button -->
                <x-primary-button class="mt-4">{{ $submitText }}</x-primary-button>

                <!-- Conditional Links -->
                @isset($extraLink)
                    <div class="mt-4">
                        <a href="{{ $extraLink['url'] }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md">
                            {{ $extraLink['text'] }}
                        </a>
                    </div>
                @endisset
            </form>
        </div>
    </div>
</x-guest-layout>
