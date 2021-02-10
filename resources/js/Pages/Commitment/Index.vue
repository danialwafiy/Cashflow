<template>
    <app-layout>
        <div class="flex flex-col w-full">
            <h1 class="flex text-7xl font-bold text-gray-700">
                COMMITMENT
            </h1>
            <Commitment
                :commitments="commitments"
                :totalCommitment="totalCommitment"
            />
        </div>
        <div class="w-full mt-12">
            <form @submit.prevent="submit()">
                <div class="flex">
                    <div class="w-4/5 mr-3">
                        <label class="text-gray-700 w-full"
                            >Details
                            <span
                                class="text-white w-full"
                                v-if="
                                    !$v.form.details.required &&
                                        $v.form.details.$dirty
                                "
                                >- Required</span
                            >
                        </label>
                        <input
                            type="text"
                            class="mt-2 w-full border-2 rounded-lg bg-transparent border-gray-700 placeholder-white text-lg"
                            v-model="form.details"
                        />
                    </div>
                    <div class="w-1/5">
                        <label class="text-gray-700 w-full"
                            >Amount
                            <span
                                class="text-white w-full"
                                v-if="
                                    !$v.form.amount.required &&
                                        $v.form.amount.$dirty
                                "
                                >- Required</span
                            ></label
                        >
                        <input
                            type="number"
                            class="mt-2 w-full border-2 rounded-lg bg-transparent border-gray-700 placeholder-white text-lg"
                            v-model="form.amount"
                        />
                    </div>
                </div>
                <div class="flex justify-end">
                    <button class="mt-4 btn-default" type="submit">
                        <i class="lni lni-plus"></i>&nbsp;&nbsp;ADD
                    </button>
                </div>
            </form>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Commitment from "@/Pages/Commitment/Card";
import { required } from "vuelidate/lib/validators";

export default {
    props: {
        commitments: {}
    },
    data() {
        return {
            form: {
                details: "",
                amount: ""
            }
        };
    },
    validations: {
        form: { details: { required }, amount: { required } }
    },
    computed: {
        totalCommitment() {
            let total = 0;
            for (var i = 0; i < this.commitments.length; i++)
                total = total + parseFloat(this.commitments[i].amount);
            return total;
        }
    },
    methods: {
        submit() {
            this.$v.$touch();
            if (!this.$v.$invalid) {
                axios
                    .post("/commitment", this.form)
                    .then(res => {
                        this.commitments.push(res.data.commitment);
                        toast.fire({
                            icon: "success",
                            title: "Commitment created.",
                            timer: 3000
                        });
                        this.form = {
                            details: "",
                            amount: ""
                        };
                    })
                    .catch(e => {
                        console.log(e);
                    });
            }
        },
        delete(index, id) {}
    },
    mounted() {},
    components: {
        AppLayout,
        Commitment
    }
};
</script>
