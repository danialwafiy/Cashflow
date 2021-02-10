<template>
    <div>
        <div class="flex min-h-screen bg-teal-500">
            <div class="flex flex-col md:flex-grow">
                <Navbar />

                <!-- Page Heading -->
                <!--                 <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <slot name="header"></slot>
                    </div>
                </header> -->

                <!-- Page Content -->
                <main>
                    <div class="flex flex-row max-w-7xl mx-auto">
                        <!--                         <transition name="slide">
                            <div
                                class="flex flex-col md:w-64 w-full shadow-xl sm:rounded-lg my-12"
                                v-if="isOpenSidebar"
                            >
                                <Sidebar />
                            </div>
                        </transition> -->
                        <div class="w-full py-16">
                            <slot></slot>
                        </div>
                    </div>
                </main>
                <!-- Modal Portal -->
                <portal-target name="modal" multiple> </portal-target>
            </div>
        </div>
    </div>
</template>

<style scoped>
.slide-enter-active,
.slide-leave-active {
    transition: width 0.5s !important;
}
.slide-enter,
.slide-leave-to {
    width: 0 !important;
}
</style>

<script>
import JetApplicationMark from "@/Jetstream/ApplicationMark";
import JetBanner from "@/Jetstream/Banner";
import JetDropdown from "@/Jetstream/Dropdown";
import JetDropdownLink from "@/Jetstream/DropdownLink";
import JetNavLink from "@/Jetstream/NavLink";
import JetResponsiveNavLink from "@/Jetstream/ResponsiveNavLink";
import Sidebar from "@/Layouts/Sidebar";
import Navbar from "@/Layouts/Navbar";

export default {
    components: {
        JetApplicationMark,
        JetBanner,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
        Sidebar,
        Navbar
    },

    data() {
        return {
            isOpenSidebar: true,
            showingNavigationDropdown: false
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
