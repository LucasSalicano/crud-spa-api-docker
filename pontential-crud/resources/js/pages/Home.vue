<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>Desenvolvedores</h3>
                <hr>
                <div class="card">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Sexo</th>
                            <th>Idade</th>
                            <th>Hobby</th>
                            <th>Data Nascimento</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="desenvolvedor in desenvolvedores" :key="desenvolvedor.id">
                            <td>{{ desenvolvedor.id }}</td>
                            <td>{{ desenvolvedor.nome }}</td>
                            <td>{{ desenvolvedor.sexo.toUpperCase() }}</td>
                            <td>{{ desenvolvedor.idade }}</td>
                            <td>{{ desenvolvedor.hobby }}</td>
                            <td>{{ new Date(desenvolvedor.dataNascimento).toLocaleDateString() }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <router-link :to="{name: 'editar', params: { id: desenvolvedor.id }}"
                                                 class="btn btn-success mr-1">
                                        <fa icon="edit"/>
                                    </router-link>
                                    <button class="btn btn-danger" @click="deleteDeveloper(desenvolvedor.id)">
                                        <fa icon="trash"/>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            desenvolvedores: []
        }
    },
    created() {
        this.axios
            .get('http://localhost:8000/api/developers/')
            .then(response => {
                this.desenvolvedores = response.data.data;
            });
    },
    methods: {
        deleteDeveloper(id) {
            this.axios
                .delete(`http://localhost:8000/api/developers/${id}`)
                .then(response => {
                    let i = this.desenvolvedores.map(data => data.id).indexOf(id);
                    this.desenvolvedores.splice(i, 1);
                });
        }
    }
}
</script>
