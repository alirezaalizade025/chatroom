<template>
    <div class="space-y-3">
        <div v-for="(message, index) in messages" :key="index">
            <div :ref="'message_' + message.id">
                <div
                    class="rounded-xl p-4 max-w-[60%] break-all"
                    :class="[
                        message.is_mine ? 'bg-blue-800 ml-auto' : 'bg-gray-700',
                    ]"
                >
                    <div class="font-bold text-sm mb-1 flex justify-between">
                        <div>{{ message.user.name }}</div>
                        <div
                            v-if="message.is_mine"
                            class="group flex flex-row-reverse gap-5 pb-2 pl-1"
                        >
                            <div class="cursor-pointer"><i class="fa-solid fa-ellipsis"></i></div>
                            <div
                                @click="
                                    editMessage(message.id, message.message)
                                "
                                class="opacity-0 scale-110 group-hover:opacity-100 transition duration-200 cursor-pointer hover:text-teal-500 hover:scale-150"
                            >
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                            <div
                                @click="deleteMessage(message.id, index)"
                                class="opacity-0 scale-110 group-hover:opacity-100 transition duration-[600ms] cursor-pointer hover:text-red-500 hover:scale-150"
                            >
                                <i class="fa-solid fa-eraser"></i>
                            </div>
                        </div>
                    </div>
                    {{ message.message }}
                    <div class="flex justify-between text-[0.8rem] mt-2">
                        <div v-if="message.is_edit">edited</div>
                        <div class="ml-auto">{{ message.created_at }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        messages: {
            type: Array,
            default: () => [],
        },
        chatroom: {
            type: Object,
            required: true,
        },
        updatedMessage: {
            type: Object,
            default: () => {},
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
        updatedMessage: function (message) {
            this.messages.filter((msg) => msg.id === message.id)[0].message =
                message.message;
            this.messages.filter(
                (msg) => msg.id === message.id
            )[0].is_edit = true;
        },
    },
    methods: {
        deleteMessage(id, index) {
            axios
                .delete(`chatrooms/${this.chatroom.id}/messages/${id}`)
                .then((res) => {
                    if (res.status == 200) {
                        this.messages.splice(index, 1);
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        editMessage(id, message) {
            this.$emit("editMessage", id, message);
        },
    },
};
</script>
