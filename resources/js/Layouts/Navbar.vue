<template>
    <div>
        <a
            href="#"
            class="text-center md:mb-0 mb-2 md:hidden block py-3"
            @click="isShowNavbar = !isShowNavbar"
        >
            <i class="lni lni-text-align-left text-2xl text-white"></i>
        </a>
        <nav
            class="md:py-4 py-16 shadow-md"
            :class="isShowNavbar ? 'block' : 'hidden'"
        >
            <!-- Primary Navigation Menu -->
            <div class="w-full px-12 mx-auto">
                <div class="flex justify-between items-center h-14 text-sm">
                    <!-- Navigation Links -->
                    <div
                        class="flex md:flex-row flex-col flex-wrap justify-center w-full"
                    >
                        <inertia-link
                            :href="route('cashflow.index')"
                            :class="
                                route().current() == 'cashflow.index'
                                    ? 'bg-white text-gray-700'
                                    : ''
                            "
                            class="bg-gray-700 px-5 py-2 text-gray-100 rounded-full mx-2 md:mb-0 mb-2"
                        >
                            <i class="lni lni-home"></i>&nbsp;&nbsp;CASHFLOW
                        </inertia-link>
                        <inertia-link
                            :href="route('cashflow.create')"
                            :class="
                                route().current() == 'cashflow.create'
                                    ? 'bg-white text-gray-700'
                                    : ''
                            "
                            class="bg-gray-700 px-5 py-2 text-gray-100 rounded-full mx-2 md:mb-0 mb-2"
                        >
                            <i class="lni lni-pencil-alt"></i>&nbsp;&nbsp;NEW
                            ENTRY
                        </inertia-link>
                        <inertia-link
                            :href="route('commitment.index')"
                            :class="
                                route().current() == 'commitment.index'
                                    ? 'bg-white text-gray-700'
                                    : ''
                            "
                            class="bg-gray-700 px-5 py-2 text-gray-100 rounded-full mx-2 md:mb-0 mb-2"
                        >
                            <i class="lni lni-briefcase"></i
                            >&nbsp;&nbsp;COMMITMENTS
                        </inertia-link>
                        <a
                            href="#"
                            @click="logout()"
                            class="bg-gray-700 px-5 py-2 text-gray-100 rounded-full mx-2"
                        >
                            <i class="lni lni-exit"></i>&nbsp;&nbsp;LOGOUT
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isShowNavbar: true
        };
    },
    methods: {
        switchToTeam(team) {
            this.$inertia.put(
                route("current-team.update"),
                {
                    team_id: team.id
                },
                {
                    preserveState: false
                }
            );
        },
        logout() {
            this.$inertia.post(route("logout"));
        }
    }
};
</script>
