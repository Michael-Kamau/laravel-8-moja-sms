<template>
    <div>
        <div class="w-full max-w-xs m-auto  p-2">
             <div v-if="this.error"
                class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                role="alert"
            >
                <strong class="font-bold">Error</strong>
                <span class="block sm:inline"
                    >Confirm you have adequate balance then try again.</span
                >

            </div>
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="username"
                    >
                        Phone
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="phone"
                        type="text"
                        placeholder="07xxxxxxxx"
                        v-model="smsPayload.phone"
                    />
                </div>

                <div class="flex justify-center">
                    <div class="mb-3 xl:w-96">
                        <label
                            for="exampleFormControlTextarea1"
                            class="form-label inline-block mb-2 text-gray-700"
                            >Message Content</label
                        >
                        <textarea
                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            id="exampleFormControlTextarea1"
                            rows="3"
                            placeholder="Your message"
                            v-model="smsPayload.message"
                        ></textarea>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="button"
                        @click="sendSingleSms()"
                    >
                        Send
                    </button>
                    <button
                        @click="closeModal()"
                        class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                        href="#"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default {
    computed: {},
    data() {
        return {
            smsPayload: {},
            error:false
        };
    },

    methods: {
        closeModal() {
            this.$emit("close-modal");
        },

        sendSingleSms() {
            axios
                .post(`/api/sendSingleSms`, this.smsPayload)
                .then((response) => {
                    console.log(response);
                    if (response.data.status == 200) {
                        this.closeModal();
                        this.allSms = response.data;
                    } else {
                        this.error = true
                    }
                })
                .catch((e) => {
                    this.error = true
                });
        },
    },
};
</script>
