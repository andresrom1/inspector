<template>
    <div>
        <button class="btn btn-outline-success btn-sm" @click="enviarMail">Al tomador
            <span class="badge text-bg-success" v-text="badgeText"></span>
        </button>
        
        
        
    </div>

</template>

<script>
import axios from 'axios'

    export default {
        props: ['propuestaId','enviados'],

        mounted() {
            console.log('Component mounted.');
            
        },

        data: function (){
            return{
                enviadosCount: this.enviados,
            }
        },

        methods:{
            enviarMail() {
                this.$Progress.start()

                axios.get('/inspecciones/create/' + this.propuestaId)
                       
                    .then(response => {

                        this.enviadosCount++;
                        alert('Email enviado al tomador con éxito');
                        console.log(this.enviados);
                        this.$Progress.finish();
                        
                    
                    });
            }
        },

        computed: {
            badgeText(){
                return (this.enviadosCount + ' envíos');
            }
        }
    }
</script>
