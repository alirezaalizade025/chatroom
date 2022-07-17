<template>
    <div class="space-y-3">
        <div v-for="(message, index) in messages" :key="index">
            <div>
                <div
                    class="rounded-xl p-4 max-w-[60%]"
                    :class="[
                        message.is_mine ? 'bg-blue-800 ml-auto' : 'bg-gray-700',
                    ]"
                >
                    <div class="font-bold text-sm mb-1 flex justify-between">
                        <div>{{ message.user.name }}</div>
                        <div class="group flex flex-row-reverse gap-5 pb-2 pl-1">
                            <div class="cursor-pointer">option</div>                           
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 cursor-pointer">edit</div>
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-500 cursor-pointer">delete</div>
                        </div>
                    </div>
                    {{ message.message }}
                    <div class="text-right text-[0.8rem] mt-2">
                        {{ message.created_at }}
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="flex flex-row justify-start">
            <div class="w-8 h-8 relative flex flex-shrink-0 mr-4">
                <img
                    class="shadow-md rounded-full w-full h-full object-cover"
                    src="https://randomuser.me/api/portraits/women/33.jpg"
                    alt=""
                />
            </div>
            <div class="messages text-sm text-gray-700 grid grid-flow-row gap-2">
                <div class="flex items-center group">
                    <p
                        class="px-6 py-3 rounded-t-full rounded-r-full bg-gray-800 max-w-xs lg:max-w-md text-gray-200"
                    >
                        Hey! How are you?
                    </p>
                    <button
                        type="button"
                        class="hidden group-hover:block flex flex-shrink-0 focus:outline-none mx-2 block rounded-full text-gray-500 hover:text-gray-900 hover:bg-gray-700 bg-gray-800 w-8 h-8 p-2"
                    >
                        <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                            <path
                                d="M10.001,7.8C8.786,7.8,7.8,8.785,7.8,10s0.986,2.2,2.201,2.2S12.2,11.215,12.2,10S11.216,7.8,10.001,7.8z
     M3.001,7.8C1.786,7.8,0.8,8.785,0.8,10s0.986,2.2,2.201,2.2S5.2,11.214,5.2,10S4.216,7.8,3.001,7.8z M17.001,7.8
    C15.786,7.8,14.8,8.785,14.8,10s0.986,2.2,2.201,2.2S19.2,11.215,19.2,10S18.216,7.8,17.001,7.8z"
                            />
                        </svg>
                    </button>
                    <button
                        type="button"
                        class="hidden group-hover:block flex flex-shrink-0 focus:outline-none mx-2 block rounded-full text-gray-500 hover:text-gray-900 hover:bg-gray-700 bg-gray-800 w-8 h-8 p-2"
                    >
                        <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                            <path
                                d="M19,16.685c0,0-2.225-9.732-11-9.732V2.969L1,9.542l7,6.69v-4.357C12.763,11.874,16.516,12.296,19,16.685z"
                            />
                        </svg>
                    </button>
                    <button
                        type="button"
                        class="hidden group-hover:block flex flex-shrink-0 focus:outline-none mx-2 block rounded-full text-gray-500 hover:text-gray-900 hover:bg-gray-700 bg-gray-800 w-8 h-8 p-2"
                    >
                        <svg viewBox="0 0 24 24" class="w-full h-full fill-current">
                            <path
                                d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-3.54-4.46a1 1 0 0 1 1.42-1.42 3 3 0 0 0 4.24 0 1 1 0 0 1 1.42 1.42 5 5 0 0 1-7.08 0zM9 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm6 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"
                            />
                        </svg>
                    </button>
                </div>
                <div class="flex items-center group">
                    <p
                        class="px-6 py-3 rounded-r-full bg-gray-800 max-w-xs lg:max-w-md text-gray-200"
                    >
                        Shall we go for Hiking this weekend?
                    </p>
                    <button
                        type="button"
                        class="hidden group-hover:block flex flex-shrink-0 focus:outline-none mx-2 block rounded-full text-gray-500 hover:text-gray-900 hover:bg-gray-700 bg-gray-800 w-8 h-8 p-2"
                    >
                        <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                            <path
                                d="M10.001,7.8C8.786,7.8,7.8,8.785,7.8,10s0.986,2.2,2.201,2.2S12.2,11.215,12.2,10S11.216,7.8,10.001,7.8z
     M3.001,7.8C1.786,7.8,0.8,8.785,0.8,10s0.986,2.2,2.201,2.2S5.2,11.214,5.2,10S4.216,7.8,3.001,7.8z M17.001,7.8
    C15.786,7.8,14.8,8.785,14.8,10s0.986,2.2,2.201,2.2S19.2,11.215,19.2,10S18.216,7.8,17.001,7.8z"
                            />
                        </svg>
                    </button>
                    <button
                        type="button"
                        class="hidden group-hover:block flex flex-shrink-0 focus:outline-none mx-2 block rounded-full text-gray-500 hover:text-gray-900 hover:bg-gray-700 bg-gray-800 w-8 h-8 p-2"
                    >
                        <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                            <path
                                d="M19,16.685c0,0-2.225-9.732-11-9.732V2.969L1,9.542l7,6.69v-4.357C12.763,11.874,16.516,12.296,19,16.685z"
                            />
                        </svg>
                    </button>
                    <button
                        type="button"
                        class="hidden group-hover:block flex flex-shrink-0 focus:outline-none mx-2 block rounded-full text-gray-500 hover:text-gray-900 hover:bg-gray-700 bg-gray-800 w-8 h-8 p-2"
                    >
                        <svg viewBox="0 0 24 24" class="w-full h-full fill-current">
                            <path
                                d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-3.54-4.46a1 1 0 0 1 1.42-1.42 3 3 0 0 0 4.24 0 1 1 0 0 1 1.42 1.42 5 5 0 0 1-7.08 0zM9 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm6 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"
                            />
                        </svg>
                    </button>
                </div>
                <div class="flex items-center group">
                    <p
                        class="px-6 py-3 rounded-b-full rounded-r-full bg-gray-800 max-w-xs lg:max-w-md text-gray-200"
                    >
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                        do eiusmod tempor incididunt ut labore et dolore magna
                        aliqua. Volutpat lacus laoreet non curabitur gravida.
                    </p>
                    <button
                        type="button"
                        class="hidden group-hover:block flex flex-shrink-0 focus:outline-none mx-2 block rounded-full text-gray-500 hover:text-gray-900 hover:bg-gray-700 bg-gray-800 w-8 h-8 p-2"
                    >
                        <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                            <path
                                d="M10.001,7.8C8.786,7.8,7.8,8.785,7.8,10s0.986,2.2,2.201,2.2S12.2,11.215,12.2,10S11.216,7.8,10.001,7.8z
     M3.001,7.8C1.786,7.8,0.8,8.785,0.8,10s0.986,2.2,2.201,2.2S5.2,11.214,5.2,10S4.216,7.8,3.001,7.8z M17.001,7.8
    C15.786,7.8,14.8,8.785,14.8,10s0.986,2.2,2.201,2.2S19.2,11.215,19.2,10S18.216,7.8,17.001,7.8z"
                            />
                        </svg>
                    </button>
                    <button
                        type="button"
                        class="hidden group-hover:block flex flex-shrink-0 focus:outline-none mx-2 block rounded-full text-gray-500 hover:text-gray-900 hover:bg-gray-700 bg-gray-800 w-8 h-8 p-2"
                    >
                        <svg viewBox="0 0 20 20" class="w-full h-full fill-current">
                            <path
                                d="M19,16.685c0,0-2.225-9.732-11-9.732V2.969L1,9.542l7,6.69v-4.357C12.763,11.874,16.516,12.296,19,16.685z"
                            />
                        </svg>
                    </button>
                    <button
                        type="button"
                        class="hidden group-hover:block flex flex-shrink-0 focus:outline-none mx-2 block rounded-full text-gray-500 hover:text-gray-900 hover:bg-gray-700 bg-gray-800 w-8 h-8 p-2"
                    >
                        <svg viewBox="0 0 24 24" class="w-full h-full fill-current">
                            <path
                                d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-3.54-4.46a1 1 0 0 1 1.42-1.42 3 3 0 0 0 4.24 0 1 1 0 0 1 1.42 1.42 5 5 0 0 1-7.08 0zM9 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm6 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div> -->
    </div>
</template>
<script>
export default {
    props: {
        messages: {
            type: Array,
            default: () => [],
        },
    },
    watch: {
        messages: function (messages, oldRoom) {
            messages.forEach(function (message) {
                message.created_at =
                    new Date(message.created_at).getHours() +
                    ":" +
                    new Date(message.created_at).getMinutes();
            });
        },
    },
};
</script>
