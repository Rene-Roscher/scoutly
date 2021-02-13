<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12 space-y-10">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Simple Statistics Grid -->

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-8">
                    <!-- Card: Simple Widget -->
                    <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
                        <!-- Card Body: Simple Widget -->
                        <div class="p-5 lg:p-6 flex-grow w-full">
                            <dl>
                                <dt class="text-2xl font-semibold">
                                    {{ registredCount }}
                                </dt>
                                <dd class="uppercase font-medium text-sm text-gray-500 tracking-wider">
                                    REGISTERED USERS
                                </dd>
                            </dl>
                        </div>
                        <!-- END Card Body: Simple Widget -->
                    </div>
                    <!-- END Card: Simple Widget -->

                    <!-- Card: Simple Widget -->
                    <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
                        <!-- Card Body: Simple Widget -->
                        <div class="p-5 lg:p-6 flex-grow w-full">
                            <dl>
                                <dt class="text-2xl font-semibold">
                                    {{ databaseEntryCount }}
                                </dt>
                                <dd class="uppercase font-medium text-sm text-gray-500 tracking-wider">
                                    Database Entries
                                </dd>
                            </dl>
                        </div>
                        <!-- END Card Body: Simple Widget -->
                    </div>
                    <!-- END Card: Simple Widget -->

                    <!-- Card: Simple Widget -->
                    <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
                        <!-- Card Body: Simple Widget -->
                        <div class="p-5 lg:p-6 flex-grow w-full">
                            <dl>
                                <dt class="text-2xl font-semibold">
                                    {{ ownOrganisationCount }}
                                </dt>
                                <dd class="uppercase font-medium text-sm text-gray-500 tracking-wider">
                                    Own Entries
                                </dd>
                            </dl>
                        </div>
                        <!-- END Card Body: Simple Widget -->
                    </div>
                    <!-- END Card: Simple Widget -->
                </div>
                <!-- END Simple Statistics Grid -->
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <welcome />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'

    export default {
        components: {
            AppLayout,
            Welcome,
        },
        props: [
            "registredCount",
            "databaseEntryCount",
            "ownOrganisationCount",
        ]
    }
</script>
