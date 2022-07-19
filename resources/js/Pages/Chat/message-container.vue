<template>
    <div ref="msgContainer" class="h-full p-5 overflow-auto">
        <MessageItem :messages="messages" :chatroom="currentRoom" @editMessage="editMessage" :updatedMessage="editedMessage"/>
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
        updatedMessage: {
            type: Object,
        },
    },

    components: {
        MessageItem,
    },

    data() {
        return {
            messages: [],
            editedMessage: []
        };
    },

    methods: {
        connect() {
            if (this.currentRoom.id) {
                let vm = this;
                this.getRoomMessages(this.currentRoom.id);

                window.Echo.private("chatroom." + this.currentRoom.id).listen(
                    "NewMessage",
                    (e) => {
                        vm.getRoomMessages(this.currentRoom.id);
                    }
                );

                window.Echo.private("chatroom." + this.currentRoom.id).listen(
                    "DeleteMessage",
                    (e) => {
                        vm.getRoomMessages(this.currentRoom.id);
                    }
                );

                window.Echo.private("chatroom." + this.currentRoom.id).listen(
                    "EditMessage",
                    (e) => {
                        vm.getRoomMessages(this.currentRoom.id);
                    }
                );
            }
        },
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

        editMessage(id,message) {
            this.$emit("editMessage", id, message);
        },
    },

    watch: {
        currentRoom: function (newRoom, oldRoom) {
            this.connect();
        },
        newMessage: function (newMessage, oldMessage) {
            this.appendMessage(newMessage);
        },
        updatedMessage: function (newMessage, oldMessage) {
            this.editedMessage = newMessage;
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
