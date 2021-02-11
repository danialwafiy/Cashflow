<template>
    <div
        class="mt-8 flex flex-col justify-evenly p-6 bg-transparent shadow-lg rounded-lg w-full h-auto"
    >
        <h1 class="text-gray-700 text-2xl font-bold">
            FIXED COMMITMENTS
        </h1>
        <ul class="text-lg mt-4">
            <li
                class="mb-1"
                v-for="(commitment, index) in commitments"
                :key="commitment.id"
            >
                <div class="flex justify-between">
                    <div>
                        <i class="lni lni-pointer-right"></i>&nbsp;
                        {{ commitment.details }}
                    </div>
                    <div>RM{{ commitment.amount }}</div>
                    <slot :commitmentID="commitment.id" :index="index"></slot>
                </div>
            </li>
        </ul>
        <div class="flex justify-between font-bold text-gray-700  text-lg mt-4">
            <div class="">TOTAL</div>
            <div>RM{{ totalCommitment }}</div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        commitments: {},
        totalCommitment: ""
    }
};
</script>
