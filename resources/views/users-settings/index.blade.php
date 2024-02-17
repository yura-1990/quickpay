<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            {{ __('Settings') }}
        </div>
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">

        <div class="overflow-hidden mb-8 w-full rounded-lg shadow-xs">
            <div class="overflow-x-auto w-full">
                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                    <!-- Card -->
                    <div class="flex items-center p-4 bg-blue-500 rounded-lg shadow-xs">
                        <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-white text-dark-500">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="text-lg font-semibold text-white text-gray-700 ">
                                {{ auth()->user()->email }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center p-4 bg-green-500 rounded-lg shadow-xs">
                        <div class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-white text-dark-500">
                                {{ __('Roles') }}
                            </p>
                            <p class="text-lg font-semibold text-white text-gray-700 ">
                                {{ count(auth()->user()->roles) }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center p-4 bg-purple-600  rounded-lg shadow-xs">
                        <div class="p-3 mr-4 text-red-500 bg-gray-500 rounded-full">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="mb-2 text-sm font-medium text-white text-dark-500">
                                {{ __('User Contacts') }}
                            </p>
                            <p class="text-lg font-semibold text-white text-gray-700 ">
                                {{ count(auth()->user()->userSettings()->get()) }}
                            </p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div class="overflow-hidden mb-8 w-full rounded-lg shadow-xs">
            <div class="overflow-x-auto w-full">
                <form action="{{ route('settings.store') }}" class="sm:px-6 md:px-0 w-full lg:px-0 space-y-6" method="POST">
                    @csrf
                    @if(count($userSettings) > 0)
                        @foreach($userSettings as $userSetting)
                            <div class="w-2/4">
                                <x-input-label class="capitalize"  value="{{ $userSetting->setting_key }}" />
                                <x-text-input  class="w-full" id="{{ $userSetting->setting_key }}" name="{{ $userSetting->setting_key }}"   value="{{ $userSetting->setting_value }}" />
                            </div>
                        @endforeach
                    @else
                        <div class="w-2/4">
                            <x-input-label class="capitalize" value="Email"  />
                            <x-text-input id="email" class="w-full"   name="email" />
                        </div>
                        <div class="w-2/4">
                            <x-input-label class="capitalize" value="Phone"  />
                            <x-text-input id="phone" class="w-full"   name="phone"   />
                        </div>
                        <div class="w-2/4">
                            <x-input-label class="capitalize" value="Telegram"  />
                            <x-text-input id="telegram" class="w-full"  name="telegram"   />
                        </div>
                    @endif

                    <x-primary-button id="save">{{ __('Save') }}</x-primary-button>
                    <x-primary-button
                        id="modal"
                        class="hidden"
                        type="button"
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-setting')"
                    ></x-primary-button>

                    <x-modal name="confirm-user-setting" class="p-3" :show="$errors->userDeletion->isNotEmpty()" focusable>
                        <div class="py-4 px-5" >
                            <h1 class="text-lg mb-4 font-medium text-gray-900">Send confirmation code to save your changes</h1>
                            <div class="flex items-center gap-4">
                                @if(count($userSettings) > 0)
                                    <select class="w-2/6 rounded capitalize" id="provider">
                                        @foreach($userSettings as $userSetting)
                                            <option class="capitalize" value="{{ $userSetting->setting_key }}">{{ $userSetting->setting_key }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select class="w-2/6 rounded capitalize" id="provider" >
                                        <option class="capitalize" value="email">Email</option>
                                        <option class="capitalize" value="phone">Phone</option>
                                        <option class="capitalize" value="telegram">Telegram</option>
                                    </select>
                                @endif
                                <x-text-input
                                    id="send"
                                    type="text"
                                    class=" block w-2/4"
                                    placeholder="{{ __('Your contact') }}"
                                />
                                <x-secondary-button type="button" id="send-confirmation" class="flex py-3 items-center">Send</x-secondary-button>
                            </div>

                            <p class="text-red-700 mt-6 text-2xl" id="incorrect"></p>
                            <div id="show-confirmation" class="mt-2 flex items-center hidden">
                                <x-text-input
                                    id="code"
                                    type="text"
                                    class="block w-3/4"
                                    placeholder="{{ __('Code') }}"
                                />
                                <div class="flex justify-end">
                                    <x-danger-button id="confirm-code" type="button" class="ms-3 py-2">
                                        {{ __('Confirm') }}
                                    </x-danger-button>
                                    <button type="submit" id="submit" hidden></button>
                                </div>
                            </div>

                        </div>
                    </x-modal>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    const save = document.getElementById('save')
    const send = document.getElementById('send')
    const code = document.getElementById('code')
    const email = document.getElementById('email')
    const modal = document.getElementById('modal')
    const phone = document.getElementById('phone')
    const submit = document.getElementById('submit')
    const provider = document.getElementById('provider')
    const telegram = document.getElementById('telegram')
    const incorrect = document.getElementById('incorrect')
    const confirmCode =  document.getElementById('confirm-code')
    const sendConfirmation =  document.getElementById('send-confirmation')
    const showConfirmation =  document.getElementById('show-confirmation')

    save.addEventListener('click', (e)=>{
        e.preventDefault()
        if(email.value !== "" || phone.value !== '' || telegram.value !== ''){
            modal.click()
        } else {
            email.classList.add('border-red-800')
            email.setAttribute('placeholder', 'email is required')
            phone.classList.add('border-red-800')
            phone.setAttribute('placeholder', 'or phone is required')
            telegram.classList.add('border-red-800')
            telegram.setAttribute('placeholder', 'or telegram required')
        }

    })

    provider.addEventListener('input', (e)=>{
        e.preventDefault();
        send.setAttribute('placeholder', `Enter your ${e.target.value}`)
        send.value = ''
        sendConfirmation.disabled = false
    })

    confirmCode.addEventListener('click', (e)=>{
        e.preventDefault();
        checkConfirmationCode(code.value)
    })

    async function checkConfirmationCode(code) {
        var url = "{{ route('confirm.code') }}";

        var params = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ code: code })
        };

        fetch(url, params)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 200) {
                    sendConfirmation.disabled = true
                    confirmCode.disabled = true
                    showConfirmation.classList.add('flex')
                    showConfirmation.classList.remove('hidden')
                    submit.click()
                    console.log(data);
                }
            })
            .catch(error => {
                incorrect.innerHTML = 'Incorrect code (: !'
                console.error('Error:', error);
            });
    }

    sendConfirmation.addEventListener('click', (e)=>{
        e.preventDefault();
        sendConfirmationCode(provider.value, send.value)
    })

    async function sendConfirmationCode(provider, contact) {
        var url = "{{ route('send.code') }}";
        var params = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ provider: provider, contact: contact })
        };

        fetch(url, params)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 200) {
                    sendConfirmation.disabled = true
                    showConfirmation.classList.add('flex')
                    showConfirmation.classList.remove('hidden')
                    console.log(data);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

</script>
