<template>
    <div>
        <notifications position="top center" group="notifications" />

        <file></file>

        <search :phrase.sync="phrase"></search>

        <div class="row">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Zip</th>
                    <th class="text-center">Latitude</th>
                    <th class="text-center">Longitude</th>
                    <th class="text-center">Timezone</th>
                </tr>
                <tr v-for="city in cities.data" :key="city.id">
                    <td class="text-center">{{ city.id }}</td>
                    <td class="text-center">{{ city.name }}</td>
                    <td class="text-center">{{ city.zip }}</td>
                    <td class="text-center">{{ city.lat }}</td>
                    <td class="text-center">{{ city.lng }}</td>
                    <td class="text-center">{{ city.timezone }}</td>
                </tr>
                </tbody>
            </table>

            <pagination :data="cities" :limit=8 :align="'center'" @pagination-change-page="getResults"></pagination>
        </div>
    </div>
</template>

<script>
    import search from './SearchComponent'
    import file from './UploadFileComponent'

    export default {
        name: "IndexComponent",
        components: {
            search,
            file
        },
        data () {
            return {
                cities: {},
                phrase: '',
                self: this
            };
        },
        watch: {
            phrase: {
                handler(newPhrase) {
                    this.phrase = newPhrase;
                    //reload results with new search phrase
                    this.getResults();
                },
                immediate: true,
            }
        },
        mounted() {
            // Fetch initial results
            this.getResults();
        },
        methods: {
            getResults(page = 1) {
                if (this.phrase) {
                    axios.post('/search?phrase=' + this.phrase + '&page=' + page)
                        .then(response => {
                            this.cities = response.data;
                        }).catch(error => {
                            this.$notify({
                                group: 'notifications',
                                title: 'Error',
                                type: 'warn',
                                text: error.response.data.errors.phrase[0]
                            });
                    });
                } else {
                    axios.post('/paginate?page=' + page)
                        .then(response => {
                            this.cities = response.data;
                        });
                }
            },

            async uploadFile() {
                this.showPreloader = true;
                const promises = this.items.map(item => axios.get('/api/items/${item.id}/'));
                const results = await Promise.all(promises);
                this.showPreloader = false;
            }
        }
    }
</script>
