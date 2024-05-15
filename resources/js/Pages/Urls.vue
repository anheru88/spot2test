<template>
    <div class="m-10">
        <h1 class="mb-4">Stored URLs</h1>
        <button type="button" class="btn btn-primary mb-3" @click="showAddUrlModal = false">Add New URL</button>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Original URL</th>
                    <th>Shortened URL</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="url in urls" :key="url.id">
                    <td>{{ url.original_url }}</td>
                    <td>{{ url.shortened_url }}</td>
                    <td>
                        <button @click="redirectTo(url.shortened_url)" class="btn btn-primary me-2">Redirect</button>
                        <button @click="deleteUrl(url.id)" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <!-- Include Add URL Modal Component -->
        <AddUrlModal v-model="showAddUrlModal" @url-added="fetchUrls"/>
    </div>
</template>

<script>
import { ref } from 'vue';
import AddUrlModal from './AddUrlModal.vue';
import axios from 'axios';

export default {
    components: {
        AddUrlModal
    },
    setup() {
        // Define a reactive property for URLs
        const urls = ref([]);

        const showAddUrlModal = ref(false);

        // Function to fetch URLs from the server
        const fetchUrls = () => {
            axios.get('/api/urls')
                .then(response => {
                    // Update the value of 'urls'
                    urls.value = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        };

        // Function to delete a URL
        const deleteUrl = (id) => {
            axios.delete(`/api/urls/${id}`)
                .then(() => {
                    // Refresh URLs list after successful deletion
                    fetchUrls();
                })
                .catch(error => {
                    console.error(error);
                });
        };

        // Initial fetch of URLs when component is mounted
        fetchUrls();

        // Return properties and methods to be used in the component
        return {
            urls,
            fetchUrls,
            showAddUrlModal,
            deleteUrl
        };
    }
};
</script>

<style>
/* No additional styles needed */
</style>
