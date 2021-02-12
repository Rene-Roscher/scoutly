<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <return-to :href="route('admin.index')">Users ({{ users.length }})</return-to>
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <inertia-table
                    :data="users"
                    id="id"
                    :headings="headings"
                    @item-selected="show"
                    :columns="columns">
                    <template slot-scope="column" slot="#">
                        <img
                            class="w-32"
                            :src="column.item.profile_photo_url"
                            alt=""
                        />
                    </template>
                </inertia-table>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import InertiaTable from 'inertia-table-vuejs';
    import ReturnTo from '../../../Misc/ReturnTo'

    export default {
        props: {
            users: Array,
            columns: Array,
            headings: Array,
        },
        methods: {
            show(user) {
                this.$inertia.get(route('admin.user.show', user));
            }
        },
        components: {
            AppLayout, InertiaTable, ReturnTo
        },
    }
</script>
