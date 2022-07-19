<template>
    <!-- Messenger Clone -->
    <div
        class="h-screen w-full flex antialiased text-gray-200 bg-gray-900 overflow-hidden"
    >
        <div class="flex-1 flex flex-col">
            <main class="flex-grow flex flex-row min-h-0">
                <chat-menu @setRoom="setRoom" />
                <section
                    class="flex flex-col flex-auto border-l border-gray-800"
                >
                    <!-- chatroom info -->
                    <div
                        class="chat-header px-6 py-4 flex flex-row flex-none justify-between items-center shadow"
                    >
                        <div class="flex">
                            <div
                                class="w-12 h-12 mr-4 relative flex flex-shrink-0"
                            >
                                <img
                                    class="shadow-md rounded-full w-full h-full object-cover"
                                    src="https://randomuser.me/api/portraits/women/33.jpg"
                                    alt=""
                                />
                            </div>
                            <div class="text-sm">
                                <p class="font-bold">
                                    {{ this.currentRoom.name }}
                                </p>
                                <p>
                                    {{ this.currentRoom.created_at_formatted }}
                                </p>
                            </div>
                        </div>

                        <div class="flex">
                            <i
                                @click="
                                    handleChatRoomInfoModal(true, currentRoom)
                                "
                                class="fa-solid fa-circle-info text-3xl text-blue-700 cursor-pointer hover:scale-125 transition duration-100"
                            ></i>
                        </div>
                    </div>

                    <messageContainer
                        :currentRoom="currentRoom"
                        :newMessage="newMessage"
                        @editMessage="handleEditMessage"
                        :updatedMessage="editMessage"
                    />

                    <InputMessage
                        :currentRoom="currentRoom"
                        @messageSent="messageSent"
                        @messageEdit="messageEdit"
                        @disableEdit="disableEdit"
                        :editInput="editInput"
                    />
                </section>
            </main>
        </div>
    </div>

    <!-- modals -->
    <chatroomInfoModal
        :room="currentRoom"
        :chatroomInfoShow="showChatRoomInfoModal"
        @closeModal="handleChatRoomInfoModal"
        :loggedUser="loggedUser"
    />
</template>
<script>
import chatMenu from "./chatrooms-menu.vue";
import ChatroomsMenu from "./chatrooms-menu.vue";
import MessageContainer from "./message-container.vue";
import InputMessage from "./input-message.vue";
import chatroomInfoModal from "../../Components/Modal/showChatRoomInfo.vue";

export default {
    data: function () {
        return {
            currentRoom: [],
            newMessage: [],
            editMessage: [],
            editInput: {
                id: "",
                message: "",
            },
            showChatRoomInfoModal: false,
            loggedUser: document
                .querySelector("meta[name='user']")
                .getAttribute("content"),
        };
    },
    components: {
        chatMenu,
        ChatroomsMenu,
        MessageContainer,
        InputMessage,
        chatroomInfoModal,
    },
    methods: {
        setRoom(room) {
            this.currentRoom = room;
        },
        messageSent(message) {
            this.newMessage = message;
        },
        messageEdit(message) {
            this.editMessage = message;
        },
        handleEditMessage(id, message) {
            this.editInput.id = id;
            this.editInput.message = message;
        },
        disableEdit() {
            this.editInput.id = false;
            this.editInput.message = false;
        },
        handleChatRoomInfoModal(data, room = null) {
            this.showChatRoomInfoModal = data;
        },
    },
};
</script>

<style>
/* can be configured in tailwind.config.js */
.group:hover .group-hover\:block {
    display: block;
}
.hover\:w-64:hover {
    width: 45%;
}

/* NO NEED THIS CSS - just for custom scrollbar which can also be configured in tailwind.config.js*/
::-webkit-scrollbar {
    width: 2px;
    height: 2px;
}
::-webkit-scrollbar-button {
    width: 0px;
    height: 0px;
}
::-webkit-scrollbar-thumb {
    background: #2d3748;
    border: 0px none #ffffff;
    border-radius: 50px;
}
::-webkit-scrollbar-thumb:hover {
    background: #2b6cb0;
}
::-webkit-scrollbar-thumb:active {
    background: #000000;
}
::-webkit-scrollbar-track {
    background: #1a202c;
    border: 0px none #ffffff;
    border-radius: 50px;
}
::-webkit-scrollbar-track:hover {
    background: #666666;
}
::-webkit-scrollbar-track:active {
    background: #333333;
}
::-webkit-scrollbar-corner {
    background: transparent;
}
</style>
