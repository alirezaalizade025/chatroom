<template>
    <Transition>
        <div
            ref="modal"
            class="absolute inset-0 min-w-screen min-h-screen backdrop-blur transition duration-200 flex"
            v-if="showModal"
            @click="handleClickModal"
        >
            <div
                class="bg-gradient-to-br from-[#1726ad] to-[#c3376354] md:w-2/3 p-10 text-white md:h-4/5 w-full h-full m-auto rounded-xl"
            >
                <div class="flex justify-between">
                    <div class="flex gap-3">
                        <div
                            v-if="!editTitle"
                            class="text-3xl font-black"
                            v-text="room.name"
                        ></div>
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
                    <div class="flex justify-around">
                        <div
                            @click="showUsers('users')"
                            class="p-2 rounded-xl bg-green-700 hover:bg-green-500 cursor-pointer"
                        >
                            members
                        </div>
                        <div
                            @click="showUsers('blocked')"
                            class="p-2 rounded-xl bg-red-700 hover:bg-red-500 cursor-pointer"
                        >
                            blocked
                        </div>
                    </div>
                    <div class="overflow-auto">
                        <div
                            v-for="(user, index) in usersList"
                            :key="index"
                            class="even:bg-gradient-to-br from-[#1726ad] to-[#c3376354] relative p-3 flex gap-5 items-center rounded-xl mx-2"
                        >
                            <i
                                v-if="is_admin && currentUser.id != user.id"
                                class="fa-solid fa-list-ul right-2 cursor-pointer group"
                            >
                                <div
                                    class="hidden group-hover:block absolute top-0 bg-gray-500 p-5 rounded-xl z-[99] space-y-5 text-sm"
                                >
                                    <div
                                        @click="addAdmin(user.id)"
                                        class="hover:text-teal-400"
                                    >
                                        {{
                                            user.role == "admin"
                                                ? "remove from admins"
                                                : "add to admins"
                                        }}
                                    </div>
                                    <div
                                        @click="blockUser(user.id)"
                                        class="hover:text-red-400"
                                    >
                                        block user
                                    </div>
                                </div>
                            </i>
                            <div class="bg-white rounded-full w-12 h-12 z-0"></div>
                            <div class="font-bold">
                                {{ user.name }}
                            </div>
                            <div
                                :class="[
                                    user.is_blocked
                                        ? 'ml-auto bg-red-500 p-2 rounded-xl'
                                        : null,
                                ]"
                            >
                                {{ user.is_blocked ? "blocked" : null }}
                            </div>
                            <div
                                :class="[
                                    user.role == 'admin'
                                        ? 'ml-auto bg-teal-800 p-2 rounded-xl'
                                        : null,
                                ]"
                            >
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
            currentUser: {},
            is_admin: false,
            editTitle: false,
            userList: "member",
            usersList: {},
        };
    },
    watch: {
        chatroomInfoShow(val) {
            this.showModal = true;
            this.currentUser = JSON.parse(this.loggedUser);
            this.is_admin =
                this.room.users.filter(
                    (person) => person.id === this.currentUser.id
                )[0].role == "admin";
            this.usersList = this.room.users;
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
        showUsers(type) {
            if (type == "blocked") {
                this.usersList = this.room.users.filter(
                    (user) => user.is_blocked == true
                );
            } else if (type == "users") {
                this.usersList = this.room.users;
            }
        },
        addAdmin(id) {
            axios
                .put(`chatrooms/${this.room.id}/add_admin`, {
                    user_id: id,
                })
                .then((res) => {
                    if (res.status == 200) {
                        this.room.users.filter(
                            (user) => user.id == id
                        )[0].role = res.data.role;
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        blockUser(id) {
            axios
                .put(`chatrooms/${this.room.id}/block_user`, {
                    user_id: id,
                })
                .then((res) => {
                    if (res.status == 200) {
                        this.room.users.filter(
                            (user) => user.id == id
                        )[0].is_blocked = !this.room.users.filter(
                            (user) => user.id == id
                        )[0].is_blocked;
                    }
                    console.log(res.data);
                })
                .catch((err) => {
                    console.log(err);
                });
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
