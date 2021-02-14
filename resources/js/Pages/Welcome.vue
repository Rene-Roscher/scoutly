<template>
    <guest-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Organisations
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div >
                    <inertia-table
                        :data="organisations"
                        id="id"
                        :headings="headings"
                        @item-selected="show"
                        :columns="columns">
                        <template slot-scope="column" slot="#">
                            <img
                                class="w-32"
                                :src="column.item.logo"
                                alt=""
                            />
                        </template>
                    </inertia-table>
                </div>
            </div>
        </div>
    </guest-layout>
</template>

<script>
    import InertiaTable from 'inertia-table-vuejs'
    import GuestLayout from '@/Layouts/GuestLayout'

    export default {
        props: {
            organisations: Array,
            columns: Array,
            headings: Array,
        },
        components: {
            InertiaTable, GuestLayout
        },
        methods: {
            show(organisation) {
                window.open(organisation.homepage, '_blank')
            }
        },
    }
</script>
