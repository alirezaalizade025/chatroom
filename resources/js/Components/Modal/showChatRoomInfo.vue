<template>
    <Transition>
        <div
            ref="modal"
            class="absolute inset-0 min-w-screen min-h-screen backdrop-blur transition duration-200 flex"
            v-if="showModal"
            @click="handleClickModal"
        >
            <div
                tabindex="0"
                class="bg-gradient-to-br from-[#1726ad] to-[#c3376354] md:w-2/3 p-10 text-white md:h-4/5 w-full h-full m-auto rounded-xl"
            >
                <div class="flex justify-between">
                    <div class="flex gap-3">
                        <div v-if="!editTitle" class="text-3xl font-black" v-text="room.name">
                        </div>
                        <input
                            v-if="editTitle"
                            id="editTitle"
                            type="text"
                            :value="room.name"
                            class="bg-transparent rounded-full px-3 py-2"
                        />
                        <i
                            v-if="is_admin"
                            @click="handleEditTitle"
                            class="fa-solid fa-pen-to-square text-xl ml-3 self-center cursor-pointer hover:scale-125 transition"
                        ></i>
                    </div>
                    <div class="self-center">
                        {{ room.users.length }}
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
                <div class="border-t mt-5 p-5 overflow-auto h-[90%]">
                    <div class="">members</div>
                    <div class="overflow-auto">
                        <div
                            v-for="(user, index) in room.users"
                            :key="index"
                            class="even:backdrop-blur-sm p-3 flex gap-5 items-center rounded-xl mx-2"
                        >
                            <div class="bg-white rounded-full w-12 h-12"></div>
                            <div class="font-bold">{{ user.name }}</div>
                            <div class="ml-auto">
                                {{ user.role == "admin" ? "admin" : null }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Transition>
</template>
<script>
import axios from "axios";
export default {
    props: {
        chatroomInfoShow: {
            type: Boolean,
            default: false,
        },
        room: {
            type: Object,
            required: true,
        },
        loggedUser: {
            type: String,
            required: true,
        },
    },
    data: function () {
        return {
            showModal: false,
            user: {},
            is_admin: false,
            editTitle: false,
        };
    },
    watch: {
        chatroomInfoShow(val) {
            this.showModal = true;
            this.user = JSON.parse(this.loggedUser);
            this.is_admin =
                this.room.users.filter(
                    (person) => person.id === this.user.id
                )[0].role == "admin";
        },
    },
    methods: {
        handleClickModal(e) {
            if (this.$el === e.target) {
                this.showModal = false;
                this.$emit("closeModal", false);
            }
        },
        handleEditTitle() {
            if (!this.editTitle) {
                this.editTitle = true;
            } else {
                if (
                    this.room.name !=
                        this.$refs.modal.querySelector("#editTitle").value &&
                    this.$refs.modal.querySelector("#editTitle").value != ""
                )
                    axios
                        .put(`chatrooms/${this.room.id}`, {
                            name: this.$refs.modal.querySelector("#editTitle")
                                .value,
                        })
                        .then((res) => {
                            if (res.status == 200) {
                                this.room.name = res.data.data.name;
                                this.editTitle = false;
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                this.editTitle = false;
            }
        },
    },
};
</script>
<style>
.v-enter-active,
.v-leave-active {
    transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
