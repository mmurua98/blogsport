<template>
    <span >{{ formatearFecha }} </span>
</template>

<script>
    export default {
        props: ['date'],
        computed: {
            formatearFecha() {
                return moment(this.date).locale('es').format('DD [de] MMMM [del] YYYY')
            }
        }
    }
</script>