<template>
    <div ref="msgContainer" class="h-full p-5 overflow-auto">
        <MessageItem :messages="messages" />
    </div>
</template>
<script>
import MessageItem from "./message-item.vue";

export default {
    props: {
        currentRoom: {
            type: Object,
            required: true,
        },
        newMessage: {
            type: Object,
        },
    },
    
    components: {
        MessageItem,
    },

    data() {
        return {
            messages: [],
        };
    },

    methods: {
        getRoomMessages(id) {
            axios
                .get(`/chatrooms/${id}/messages`)
                .then((res) => {
                    this.messages = res.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },

        appendMessage(message) {
            message.created_at =
                new Date(message.created_at).getHours() +
                ":" +
                new Date(message.created_at).getMinutes();
            this.messages.push(message);
        },
    },

    watch: {
        currentRoom: function (newRoom, oldRoom) {
            this.getRoomMessages(newRoom.id);
        },
        newMessage: function (newMessage, oldMessage) {
            this.appendMessage(newMessage);
        },
    },

    updated: function () {
        this.$nextTick(function () {
            this.$refs.msgContainer.scrollTop =
                this.$refs.msgContainer.scrollHeight;
        });
    },
};
</script>
