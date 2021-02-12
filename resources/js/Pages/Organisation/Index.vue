<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Organizations ({{ organisations.length }})
<!--                {{ $page.props }}-->
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <store-request :organisations="organisations" />
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import StoreRequest from "@/Pages/Organisation/StoreRequest";

    export default {
        props: {
            organisations: Array,
        },

        components: {
            StoreRequest,
            AppLayout,
        },
    }
</script>
