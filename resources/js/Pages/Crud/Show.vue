<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <return-to :href="route('admin.user.index')">{{ crud.title }} - #{{ crud.source.id }}</return-to>
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <jet-form-section @submitted="updateUser">
                    <template #title>
                        {{ crud.title }} Settings
                    </template>

                    <template #description>
                        {{ crud.description }}
                    </template>

                    <template #form>
                        <!-- Name -->
                        <div class="col-span-3" v-for="(value, key) in crud.source" :key="key">
                            <jet-label :for="key" :value="key.toUpperCase()"/>
                            <jet-input :id="key" :value="value" type="text" class="mt-1 block w-full" v-model="form[key]" :readonly="key === 'id'"/>
                            <jet-input-error :message="form.errors[key]" class="mt-2" />
                        </div>
                    </template>

                    <template #actions>
                        <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                            Saved.
                        </jet-action-message>

                        <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Save
                        </jet-button>
                    </template>
                </jet-form-section>

            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'
    import ReturnTo from "@/Misc/ReturnTo";

    export default {
        props: ['roles', 'permissions', 'crud'],
        components: {
            ReturnTo,
            AppLayout,
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },
        data() {
            return {
                form: this.$inertia.form({...{
                        _method: 'PUT',
                    }, ...this.crud.source}),
            }
        },
        methods: {
            updateUser() {
                this.form.post(route(this.crud.updateUrl, this.crud.source));
            },
        }
    }
</script>
