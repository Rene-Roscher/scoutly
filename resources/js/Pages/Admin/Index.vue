<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-4">
                    <inertia-link :href="link.url" class="p-6 p-6 dark:border-gray-700 md:border-t-0 md:border-l border-b" v-for="(link, index) in links" :key="link">
                        <div class="text-center transition transform hover:scale-110">
                            <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">{{ link.name }}</div>
                        </div>
                    </inertia-link>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import InertiaTable from 'inertia-table-vuejs';

    export default {
        props: {
            users: Array,
            columns: Array,
            headings: Array,
        },
        data() {
            return {
                links: [
                    {
                        name: "Users",
                        url: route('admin.user.index')
                    },
                    {
                        name: "Organizations",
                        url: route('admin.organisation.index')
                    }
                ]
            };
        },
        methods: {
            // show(user) {
                // this.$inertia.get(route(''));
            // }
        },
        components: {
            AppLayout, InertiaTable
        },
    }
</script>
