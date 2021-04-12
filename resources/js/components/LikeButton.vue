<template>
    <div>
         <span class="like-btn" @click="likePost" :class="{ 'like-active' : isActive }"></span>

         <p>{{ quantityLikes }} Likes</p>
    </div>

</template>

<script>
    export default {
        props: ['postId', 'like', 'likes'],
        data: function() {
            return {
                isActive: this.like,
                totalLikes: this.likes
            }
        },
        methods: {
            likePost() {
                axios.post('/posts/' + this.postId)
                    .then(respuesta => {
                        
                        if(respuesta.data.attached.length > 0 ) {
                            this.$data.totalLikes++;
                        } else {
                            this.$data.totalLikes--;
                        }

                        this.isActive = !this.isActive
                    })
                    .catch(error => {
                        if(error.response.status === 401) {
                            window.location = '/register';
                        }
                    });
            }
        }, 
        computed: {
            quantityLikes: function() {
                return this.totalLikes
            }
        }
    }
</script>