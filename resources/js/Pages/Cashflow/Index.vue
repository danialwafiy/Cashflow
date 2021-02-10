<template>
    <app-layout>
        <div class="xl:px-0 px-12 w-full h-auto" v-if="cashflows[0]">
            <div class="flex flex-wrap">
                <div class="md:w-1/2 w-full md:mb-0 mb-8">
                    <div class="flex mb-8">
                        <h1
                            class="flex text-7xl font-bold text-gray-700 items-center"
                        >
                            {{ months[selected_cashflow.month - 1] }}
                            {{ selected_cashflow.year }}
                        </h1>
                    </div>
                    <div class="flex mb-4 items-end">
                        <h1
                            class="w-1/3 text-lg font-bold text-white items-end"
                        >
                            <i class="lni lni-wallet"></i
                            >&nbsp;&nbsp;INITIAL&nbsp;&nbsp;SALARY
                        </h1>
                        <span
                            class="w-2/3 ml-5 text-4xl text-teal-200 font-bold"
                            >RM{{ selected_cashflow.initial_salary }}</span
                        >
                    </div>
                    <div class="flex mb-4 items-end">
                        <h1
                            class="w-1/3 text-lg font-bold text-white items-end"
                        >
                            <i class="lni lni-cart-full"></i
                            >&nbsp;&nbsp;TOTAL&nbsp;&nbsp;SPENDING
                        </h1>
                        <span
                            class="w-2/3 ml-5 text-4xl text-teal-700 font-bold"
                            >RM{{ selected_cashflow.total_spending }}</span
                        >
                    </div>
                    <div class="flex mb-4 items-end">
                        <h1
                            class="w-1/3 text-lg font-bold text-white items-end"
                        >
                            <i class="lni lni-investment"></i
                            >&nbsp;&nbsp;BALANCE / SAVINGS
                        </h1>
                        <span
                            class="w-2/3 ml-5 text-4xl text-teal-200 font-bold"
                            >RM{{ selected_cashflow.savings }}</span
                        >
                    </div>
                </div>

                <div class="md:w-1/2 w-full">
                    <h1
                        class="flex text-7xl font-bold text-white md:justify-end justify-center items-center mb-8"
                    >
                        OVERVIEW
                    </h1>
                    <div
                        class="bg-white text-lg text-gray-600 p-5 rounded-lg h-auto"
                    >
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Voluptas itaque commodi quam qui iusto, molestiae
                        voluptate eum sed laborum reprehenderit, accusamus nobis
                        sunt officiis?
                    </div>
                </div>
            </div>

            <div class="mt-12 w-full">
                <div class="flex justify-end" v-if="!isShowMore">
                    <button class="btn-default" @click="isShowMore = true">
                        <i class="lni lni-menu"></i>&nbsp;&nbsp;MORE
                    </button>
                </div>
                <div v-else>
                    <div class="flex justify-between">
                        <h1 class="text-4xl text-gray-700 font-semibold">
                            SPENDING LIST
                        </h1>
                        <button class="btn-default" @click="isShowMore = false">
                            <i class="lni lni-close"></i>&nbsp;&nbsp;LESS
                        </button>
                    </div>
                    <ul class="mt-5">
                        <li
                            v-for="spending in selected_cashflow.spendings"
                            :key="spending.id"
                            class="bg-white py-2 px-5 rounded-lg text-gray-700 mt-2"
                        >
                            <div class="flex justify-between">
                                <div class="capitalize">
                                    {{ spending.details }}
                                </div>
                                <div>RM{{ spending.amount }}</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="grid md:grid-cols-3 grid-cols-1 gap-3 mt-12">
                <a
                    href="#"
                    class="flex justify-between bg-gray-700 py-3 px-5 rounded-lg"
                    v-for="cashflow in cashflows"
                    :key="cashflow.id"
                    @click="selectCashflow(cashflow)"
                >
                    <span class="font-semibold text-white">
                        {{ months[cashflow.month - 1] }}
                        {{ cashflow.year }}</span
                    >
                    <span class="font-semibold text-teal-600">
                        <i class="lni lni-cart-full"></i>&nbsp;&nbsp;RM{{
                            cashflow.total_spending
                        }}</span
                    >
                    <span class="font-semibold text-teal-200">
                        <i class="lni lni-investment"></i>&nbsp;&nbsp;RM{{
                            cashflow.savings
                        }}</span
                    >
                    <span class="font-semibold text-teal-200 content-end">
                        <i
                            class="lni lni-circle-plus"
                            v-if="cashflow.positive"
                        ></i>
                        <i class="lni lni-circle-minus" v-else></i>
                    </span>
                </a>
            </div>
        </div>
        <div v-else class="flex justify-center items-center">
            <div class="text-2xl text-gray-700">
                No cashflow. Create one now !
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";

export default {
    props: {
        cashflows: {}
    },
    data() {
        return {
            isShowMore: false,
            selected_cashflow: this.cashflows[0],
            months: [
                "JANUARY",
                "FEBRUARY",
                "MARCH",
                "APRIL",
                "MAY",
                "JUNE",
                "JULY",
                "AUGUST",
                "SEPTEMBER",
                "OCTOBER",
                "NOVEMBER",
                "DECEMBER"
            ]
        };
    },
    methods: {
        selectCashflow(cashflow) {
            this.selected_cashflow = cashflow;
        }
    },
    components: {
        AppLayout
    }
};
</script>
