<template>
    <app-layout>
        <form @submit.prevent="submit()">
            <div class="flex w-full">
                <div class="w-1/2 flex flex-col content-between">
                    <h1 class="flex text-7xl font-bold text-gray-700">
                        NEW ENTRY
                    </h1>
                    <div class="mt-8">
                        <div>
                            <label class="text-gray-700"
                                >Select a month
                                <span
                                    class="text-white w-full"
                                    v-if="!$v.month.required && $v.month.$dirty"
                                    >- Required</span
                                >
                            </label>
                            <select
                                class="mt-2 w-full bg-transparent border-2 border-gray-700 text-2xl appearance-none rounded-lg"
                                v-model="month"
                            >
                                <option disabled selected value=""></option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <label class="text-gray-700"
                                >Select a year
                                <span
                                    class="text-white w-full"
                                    v-if="!$v.year.required && $v.year.$dirty"
                                    >- Required</span
                                >
                            </label>
                            <select
                                class="mt-2 w-full bg-transparent border-2 border-gray-700 text-2xl appearance-none rounded-lg"
                                v-model="year"
                            >
                                <option disabled selected value=""></option>
                                <option
                                    :value="year"
                                    v-for="(year, index) in years"
                                    :key="index"
                                    >{{ year }}</option
                                >
                            </select>
                        </div>
                        <div class="mt-4 items-center ">
                            <label class="text-gray-700"
                                >Initial Salary (RM)
                                <span
                                    class="text-white"
                                    v-if="
                                        !$v.initial_salary.required &&
                                            $v.initial_salary.$dirty
                                    "
                                    >- Required</span
                                >
                            </label>
                            <input
                                type="number"
                                class="mt-2 w-full bg-transparent border-2 border-gray-700 placeholder-black text-2xl appearance-none rounded-lg"
                                v-model="initial_salary"
                            />
                        </div>
                    </div>
                </div>
                <div class="w-1/2 px-8">
                    <Commitment
                        :commitments="commitments"
                        :totalCommitment="totalCommitment"
                    />
                    <div
                        class="mt-8 flex flex-col justify-evenly p-6 bg-transparent shadow-lg rounded-lg w-full h-auto"
                    >
                        <div
                            class="flex justify-between font-bold text-gray-700  text-2xl mt-4"
                        >
                            <div class="">TOTAL SPENDINGS</div>
                            <div>RM{{ total_spending }}</div>
                        </div>
                        <div
                            class="flex justify-between font-bold text-gray-700  text-2xl mt-4"
                        >
                            <div class="">BALANCE / SAVINGS</div>
                            <div>RM{{ savings }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex w-full mt-12">
                <div class="w-full">
                    <div class="flex justify-between">
                        <div class="flex items-center">
                            <button
                                class="btn-default"
                                type="button"
                                @click="addSpending()"
                            >
                                <i class="lni lni-plus"></i>&nbsp;&nbsp;ADD
                            </button>
                        </div>
                        <h1 class="text-7xl font-bold text-white">
                            SPENDINGS
                        </h1>
                    </div>
                    <div class="mt-8">
                        <div
                            class="grid grid-cols-9 w-full gap-3 mb-4"
                            v-for="(spending, index) in spendings"
                            :key="index"
                        >
                            <div class="col-span-6 ">
                                <label class="text-gray-700 w-full"
                                    >Details
                                </label>
                                <input
                                    type="text"
                                    class="mt-2 w-full border-2 rounded-lg bg-transparent border-gray-700 placeholder-white text-lg"
                                    v-model="spending.details"
                                    required
                                />
                            </div>
                            <div class="col-span-2">
                                <label class="text-gray-700 w-full"
                                    >Amount
                                </label>
                                <input
                                    type="number"
                                    class="mt-2 w-full border-2 rounded-lg bg-transparent border-gray-700 placeholder-white text-lg"
                                    v-model="spending.amount"
                                    required
                                />
                            </div>
                            <button @click="removeSpending(index)">
                                <i class="lni lni-trash text-2xl mt-5"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex w-full mt-8 justify-end">
                <button class="btn-default" type="submit">
                    <i class="lni lni-pointer"></i>&nbsp;&nbsp;FINISH
                </button>
            </div>
        </form>
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
            year: "",
            month: "",
            initial_salary: "",
            spendings: []
        };
    },
    validations: {
        month: { required },
        year: { required },
        initial_salary: { required }
    },
    computed: {
        years() {
            let years = [];
            var currentYear = new Date().getFullYear();
            for (var i = 0; i < 50; i++) {
                let newYear = parseInt(currentYear) + i;
                years.push(newYear);
            }
            return years;
        },
        totalCommitment() {
            let total = 0;
            for (var i = 0; i < this.commitments.length; i++)
                total = total + this.commitments[i].amount;
            return total;
        },
        total_spending() {
            let total = 0;
            for (var i = 0; i < this.spendings.length; i++) {
                total = total + parseFloat(this.spendings[i].amount);
            }
            return total;
        },
        savings() {
            return (
                this.initial_salary - this.total_spending - this.totalCommitment
            );
        },
        positive() {
            if (this.savings > 0) return 1;
            return 0;
        }
    },
    methods: {
        submit() {
            this.$v.$touch();
            if (!this.$v.$invalid) {
                let formData = new FormData();
                formData.append("year", this.year);
                formData.append("month", this.month);
                formData.append("initial_salary", this.initial_salary);
                formData.append("total_spending", this.total_spending);
                formData.append("savings", this.savings);
                formData.append("positive", this.positive);
                if (this.spendings != "")
                    formData.append(
                        "spendings",
                        JSON.stringify(this.spendings)
                    );
                axios
                    .post("/cashflow", formData)
                    .then(res => {
                        toast.fire({
                            icon: "success",
                            title: "Cashflow created.",
                            timer: 3000
                        });
                        this.year = "";
                        this.month = "";
                        this.initial_salary = "";
                        this.spendings = "";
                    })
                    .catch(e => {
                        console.log("Something went wrong", e);
                    });
            }
        },
        addSpending() {
            this.spendings.push({ details: "", amount: 0 });
        },
        removeSpending(index) {
            this.spendings.splice(index, 1);
        }
    },
    components: {
        AppLayout,
        Commitment
    }
};
</script>
