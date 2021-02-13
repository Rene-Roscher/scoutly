<template>
    <div>
        <jet-banner />

        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white dark:bg-gray-800 border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">

                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex-shrink-0 flex items-center">
                                <inertia-link :href="route('welcome')">
                                    <jet-application-mark light class="block h-9 w-auto" />
                                </inertia-link>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <div class="ml-3 relative">
                                <inertia-link :href="route('dashboard')" v-if="$page.props.user">
                                    <secondary-button>Dashboard</secondary-button>
                                </inertia-link>
                                <inertia-link :href="route('dashboard')" v-else>
                                    <secondary-button>Login</secondary-button>
                                </inertia-link>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <jet-responsive-nav-link :href="route('dashboard')" v-if="$page.props.user">
                            <secondary-button>Dashboard</secondary-button>
                        </jet-responsive-nav-link>
                        <jet-responsive-nav-link :href="route('dashboard')" v-else>
                            <secondary-button>Login</secondary-button>
                        </jet-responsive-nav-link>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header"></slot>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot></slot>
            </main>

            <!-- Modal Portal -->
            <portal-target name="modal" multiple>
            </portal-target>
        </div>
        <div class='w-full text-center border-t border-grey p-4'>
            <inertia-link :href="route('imprint')" class="border-r border-1 px-4">Imprint</inertia-link>
            <inertia-link :href="route('privacy-policy')" class="px-2">Privacy Policy</inertia-link>
        </div>
    </div>
</template>

<script>
    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    import JetBanner from '@/Jetstream/Banner'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetNavLink from '@/Jetstream/NavLink'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
    import SecondaryButton from "@/Jetstream/SecondaryButton";

    export default {
        components: {
            SecondaryButton,
            JetApplicationMark,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },

        methods: {
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    }
</script>
