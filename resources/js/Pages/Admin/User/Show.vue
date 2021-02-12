<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <return-to :href="route('admin.user.index')">Profile - #{{ userItem.id }}</return-to>
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <jet-form-section @submitted="updateUser">
                    <template #title>
                        Profile Settings
                    </template>

                    <template #description>
                        Update user's account settings.
                    </template>

                    <template #form>
                        <!-- Profile Photo -->
                        <div class="col-span-6 sm:col-span-4">
                            <!-- Profile Photo File Input -->
                            <jet-label for="photo" value="Photo" />

                            <div class="mt-2">
                                <img :src="userItem.profile_photo_url" :alt="userItem.name" class="rounded-full h-20 w-20 object-cover">
                            </div>
                        </div>

                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <jet-label for="name" value="Name" />
                            <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" autocomplete="name" />
                            <jet-input-error :message="form.errors.name" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <jet-label for="email" value="Email" />
                            <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" />
                            <jet-input-error :message="form.errors.email" class="mt-2" />
                        </div>

                        <!-- Roles -->
                        <div class="col-span-6 sm:col-span-4">
                            <jet-label for="roles" value="Roles" />
                            <select id="roles" class="mt-1 block w-full form-select" v-model="form.roles" multiple>
                                <option v-for="role in roles" :key="role.name">{{ role.name }}</option>
                            </select>
                            <jet-input-error :message="form.errors.email" class="mt-2" />
                        </div>
                        <!-- Permissions -->
                        <div class="col-span-6 sm:col-span-4">
                            <jet-label for="permissions" value="Permissions" />
                            <select id="permissions" class="mt-1 block w-full form-select" v-model="form.permissions" multiple>
                                <option v-for="permission in permissions" :key="permission.name" :selected="userPermissions.filter(p => p.name == permission.name).length">{{ permission.name }}</option>
                            </select>
                            <jet-input-error :message="form.errors.permissions" class="mt-2" />
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
        props: ['userItem', 'roles', 'permissions'],
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
                form: this.$inertia.form({
                    _method: 'PUT',
                    name: this.userItem.name,
                    email: this.userItem.email,
                    roles: this.userItem.roles.map(data => data.name),
                    permissions: this.userItem.permissions.map(data => data.name),
                }),

                userRoles: this.userItem.roles,
                userPermissions: this.userItem.permissions,
            }
        },
        methods: {
            updateUser() {
                this.form.post(route('admin.user.update', {user: this.userItem}));
            },
        }
    }
</script>
