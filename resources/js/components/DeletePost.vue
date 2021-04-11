<template>
    <input 
        type="submit" 
        class="btn btn-danger d-block w-100 mb-2" 
        value="Delete ×"
        @click="deletePost"
    >
</template>

<script>
    export default {
        props: ['postId'],
        methods: {
            deletePost(){
                    this.$swal({
                        title: 'Do you want to delete this post?',
                        text: "Once deleted, the post cannot be recovered",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        if (result.value) {
                            const params = {
                                id: this.postId
                            }

                            // Enviar la petición al servidor
                            axios.post(`/posts/${this.postId}`, {params, _method: 'delete'})
                                .then(respuesta => {
                                    this.$swal({
                                        title: 'Post Deleted',
                                        text: 'Post has been deleted',
                                        icon: 'success'
                                    });

                                    // Eliminar receta del DOM
                                    this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);

                                })
                                .catch(error => {
                                    console.log(error)
                                })
                        }
                    })
            }
        }
    }

</script>