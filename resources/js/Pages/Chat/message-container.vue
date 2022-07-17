<template>
    <div class="h-full p-5 overflow-auto">
        <MessageItem :messages="messages"/>
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
                    // console.log(this.messages);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
    watch: {
        currentRoom: function (newRoom, oldRoom) {
            this.getRoomMessages(newRoom.id)
        },
    },
};
</script>
