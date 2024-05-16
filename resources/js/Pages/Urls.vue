<template>
    <div class="m-10">
        <h1 class="mb-4">Stored URLs</h1>
        <!-- Form to add a new URL -->
        <form @submit.prevent="addUrl">
            <div class="mb-3">
                <label for="originalUrl" class="form-label">Original URL:</label>
                <input type="text" id="originalUrl" v-model="newUrl.original_url" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mb-3">Add URL</button>
        </form>
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
    </div>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';

export default {
    setup() {
        // Define a reactive property for URLs
        const urls = ref([]);

        // Object to store data for adding a new URL
        const newUrl = ref({
            original_url: ''
        });

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

        // Function to add a new URL
        const addUrl = () => {
            axios.post('/api/urls', newUrl.value)
                .then(() => {
                    // Refresh URLs list after successful addition
                    fetchUrls();
                    // Clear the input field
                    newUrl.value.original_url = '';
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

        // Function to redirect to a shortened URL
        const redirectTo = (shortenedUrl) => {
            window.location.href = "/" + shortenedUrl;
            console.log('Redirecting to:', shortenedUrl);
        };

        // Return properties and methods to be used in the component
        return {
            urls,
            newUrl,
            fetchUrls,
            addUrl,
            deleteUrl,
            redirectTo
        };
    }
};
</script>

<style>
/* No additional styles needed */
</style>
