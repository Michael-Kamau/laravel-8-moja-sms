<template>
    <div>
        <nav class="bg-gray-800">
            <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                <div class="relative flex items-center justify-between h-16">
                    <span class="text-white">Moja SMS Laravel</span>
                </div>
            </div>
        </nav>
        <div class="w-full flex flex-row">
            <div class="w-full">
                <!-- component -->
                <div class="bg-white p-8 rounded-md w-full">
                    <div class="flex items-center justify-between pb-6">
                        <div>
                            <h2 class="text-gray-600 font-semibold">
                                SMS Balance: {{ this.smsBalance }}
                            </h2>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="lg:ml-40 ml-10 space-x-8">
                                <button
                                    @click="showModal('single-sms-modal')"
                                    class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer"
                                >
                                    Single SMS
                                </button>
                                <button
                                    @click="showModal('bulk-sms-modal')"
                                    class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer"
                                >
                                    Bulk SMS
                                </button>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div
                            class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto"
                        >
                            <div
                                class="inline-block min-w-full shadow rounded-lg overflow-hidden"
                            >
                                <table class="min-w-full leading-normal">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                            >
                                                Phone
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                            >
                                                Message
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                            >
                                                Created at
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                            >
                                                Updated at
                                            </th>
                                            <th
                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                            >
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="sms in this.allSms">
                                            <tr :key="sms.id">
                                                <td
                                                    class="px-3 py-5 bg-white text-sm"
                                                >
                                                    <div
                                                        class="flex items-center"
                                                    >
                                                        <div
                                                            class="flex-shrink-0 w-10 h-10 pt-2"
                                                        >
                                                            <svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                class="h-6 w-6"
                                                                fill="none"
                                                                viewBox="0 0 24 24"
                                                                stroke="currentColor"
                                                            >
                                                                <path
                                                                    stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"
                                                                />
                                                            </svg>
                                                        </div>
                                                        <div class="ml-2">
                                                            <p
                                                                class="text-gray-900 whitespace-no-wrap"
                                                            >
                                                                {{ sms.phone }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td
                                                    class="px-5 py-5 bg-white text-sm"
                                                >
                                                    <p
                                                        class="text-gray-900 whitespace-no-wrap"
                                                    >
                                                        {{ sms.message }}
                                                    </p>
                                                </td>
                                                <td
                                                    class="px-5 py-5 bg-white text-sm"
                                                >
                                                    <p
                                                        class="text-gray-900 whitespace-no-wrap"
                                                    >
                                                        {{ sms.created_at }}
                                                    </p>
                                                </td>
                                                <td
                                                    class="px-5 py-5 bg-white text-sm"
                                                >
                                                    <p
                                                        class="text-gray-900 whitespace-no-wrap"
                                                    >
                                                        {{ sms.updated_at }}
                                                    </p>
                                                </td>
                                                <td
                                                    class="px-5 py-5 bg-white text-sm"
                                                >
                                                    <span
                                                        class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight"
                                                    >
                                                        <span
                                                            aria-hidden
                                                            :class="{
                                                                'bg-green-200':
                                                                    sms.status ==
                                                                    'sent',
                                                                'bg-blue-200':
                                                                    sms.status ==
                                                                    'pending',
                                                                'bg-red-200':
                                                                    sms.status ==
                                                                    'failed',
                                                            }"
                                                            class="absolute inset-0 bg-orange-200 opacity-50 rounded-full"
                                                        ></span>
                                                        <span
                                                            class="relative"
                                                            >{{
                                                                sms.status
                                                            }}</span
                                                        >
                                                    </span>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <modal
            name="single-sms-modal"
            height="auto"
            width="50%"
            :scrollable="true"
        >
            <div>
                <SingleSms @close-modal="hideModal('single-sms-modal')" />
            </div>
        </modal>

        <modal
            name="bulk-sms-modal"
            height="auto"
            width="50%"
            :scrollable="true"
        >
            <div>
                <BulkSms @close-modal="hideModal('bulk-sms-modal')" />
            </div>
        </modal>
    </div>
</template>
<script>
import SingleSms from "../Modals/SingleSms.vue";
import BulkSms from "../Modals/BulkSms.vue";
import axios from "axios";

export default {
    mounted() {
        this.updateData();
    },
    components: { SingleSms, BulkSms },
    data() {
        return {
            smsBalance: 0,
            allSms: [],
        };
    },
    methods: {
        showModal(modal) {
            this.$modal.show(modal);
        },
        hideModal(modal) {
          this.updateData()
            this.$modal.hide(modal);
        },

        updateData(){
          this.fetchAllSms()
          this.getSmsBalance()
        },

        fetchAllSms() {
            axios
                .get(`/api/allSms`)
                .then((response) => {
                    console.log(response);
                    if (response.status == 200) {
                        this.allSms = response.data.data;
                    }
                })
                .catch((e) => {
                    console.log(e);
                });
        },

        getSmsBalance() {
            axios
                .get(`/api/getSmsBalance`)
                .then((response) => {
                  console.log('Balance response',response)
                    if (response.status == 200) {
                        this.smsBalance = response?.data?.data?.data?.balance;
                    }
                })
                .catch((e) => {
                    console.log(e);
                });
        },
    },
    computed: {},
};
</script>
