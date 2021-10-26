<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h3>Editar Desenvolvedor</h3>
                <hr>
                <form @submit.prevent="editarDev">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome:</label>
                                <input type="text" class="form-control" v-model="desenvolvedor.nome" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Sexo:</label>
                                <select v-model="desenvolvedor.sexo" class="form-control" required>
                                    <option value="m">Masculino</option>
                                    <option value="f">Feminino</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Idade:</label>
                                <input type="number" class="form-control" v-model="desenvolvedor.idade" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Hobby:</label>
                                <input type="text" class="form-control" v-model="desenvolvedor.hobby" required>
                            </div>
                        </div>
                        <div class="col md-6">
                            <label>Data de Nascimento:</label>
                            <input type="date" name="data_nascimento" class="form-control"
                                   v-model="desenvolvedor.dataNascimento" required>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">Editar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            desenvolvedor: {}
        }
    },
    created() {
        this.axios
            .get(`http://localhost:8000/api/developers/${this.$route.params.id}`)
            .then((res) => {
                this.desenvolvedor = res.data;
            });
    },
    methods: {
        editarDev() {
            this.axios
                .put(`http://localhost:8000/api/developers/${this.$route.params.id}`, this.desenvolvedor)
                .then(response => (
                    this.$router.push({name: 'home'})
                ))
                .catch(err => console.log(err))
                .finally(() => this.loading = false)
        }
    }
}
</script>
