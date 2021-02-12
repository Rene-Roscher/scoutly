<template>
    <guest-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ organisation.name }}
            </h2>
        </template>

        <div class="py-12">

            <div class="max-w-2xl mx-auto">
                <div class="grid grid-cols-1 gap-8 lg:gap-4">
                    <a :href="organisation.homepage" target="_blank" class="flex flex-col">
                        <img :src="organisation.logo" style="object-fit: scale-down;">
                    </a>
                </div>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Simple Statistics Grid -->

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-8">
                    <!-- Card: Simple Widget -->
                    <div class="flex flex-col rounded shadow-sm bg-white overflow-hidden">
                        <!-- Card Body: Simple Widget -->
                        <div class="p-5 lg:p-6 flex-grow w-full">
                            <dl>
                                <dt class="text-2xl font-semibold">
                                    87
                                </dt>
                                <dd class="uppercase font-medium text-sm text-gray-500 tracking-wider">
                                    Sales
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
                                    $4.570
                                </dt>
                                <dd class="uppercase font-medium text-sm text-gray-500 tracking-wider">
                                    Earnings
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
                                    $27.910
                                </dt>
                                <dd class="uppercase font-medium text-sm text-gray-500 tracking-wider">
                                    Wallet
                                </dd>
                            </dl>
                        </div>
                        <!-- END Card Body: Simple Widget -->
                    </div>
                    <!-- END Card: Simple Widget -->
                </div>
                <!-- END Simple Statistics Grid -->
            </div>

        </div>
    </guest-layout>
</template>

<script>
    import GuestLayout from '@/Layouts/GuestLayout'
    import DangerButton from "@/Jetstream/DangerButton";

    export default {
        props: {
            organisation: Array,
        },
        components: {
            DangerButton,
            GuestLayout
        }
    }
</script>
