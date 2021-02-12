<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <return-to :href="route(crud.back)">{{ crud.name }} ({{ crud.source.length }})</return-to>
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <inertia-table
                    :data="crud.source"
                    id="id"
                    :headings="headings"
                    @item-selected="show"
                    :columns="columns">
                </inertia-table>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import InertiaTable from 'inertia-table-vuejs';
    import ReturnTo from '../../Misc/ReturnTo'

    export default {
        props: {
            columns: Array,
            headings: Array,
            crud: Array
        },
        methods: {
            show(source) {
                this.$inertia.get(route(this.crud.show, source));
            }
        },
        components: {
            AppLayout, InertiaTable, ReturnTo
        },
    }
</script>
