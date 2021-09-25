<template>
    <input type="submit" class="btn btn-danger d-block w-100 mt-1" value="Eliminar" v-on:click="EliminarCurso">

</template>

<script>
export default {
    props: ['cursoId'],
    methods: {
        EliminarCurso() {
            this.$swal({
                title: 'Desea eliminar este curso?',
                text: "esta accion no es reversible!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    // para recibir la peticion
                    const params = {
                        id: this.cursoId
                    }
                    axios.post(`/cursos/${this.cursoId}`, {params, _method: 'delete'})
                        .then(respuesta => {
                            this.$swal(
                                'curso eliminado!',
                                'Tu curso se ha eliminado',
                                'success'
                            )
                            // con la siguiente linea salgo a cada componente padre para remover a su hijo
                            this.$el.parentElement.parentElement.parentElement.removeChild(this.$el.parentElement.parentElement);
                        })
                        .catch(error => {
                            console.log(error);
                        })
                }
            })
        }
    }
}
</script>

<style scoped>
</style>