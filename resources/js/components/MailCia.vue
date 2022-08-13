<template>
    <div>
        <button class="btn btn-outline-success btn-sm" @click="enviarMail" v-bind:disabled="disabledButton">A la cía.
            <span class="badge text-bg-success" v-text="badgeText"></span>
        </button>
        
        
        
    </div>

</template>

<script>
import axios from 'axios'

    export default {
        props: ['propuestaId','enviados','cantarchivos'],

        mounted() {
            console.log('Component mounted.');

            
        },

        data: function (){
            return{
                enviadosCount: this.enviados,
                carchivos: this.cantarchivos,         
            
            }
        },

        methods:{
            enviarMail() {
                this.$Progress.start()

                axios.get('/inspecciones/mailcia/' + this.propuestaId)
                       
                    .then(response => {

                        this.enviadosCount++;
                        alert('Inspeccion enviada a la Compañía con éxito');
                        console.log(this.enviados);
                        this.$Progress.finish();
                        
                    
                    });
            },

            
        },

        computed: {
            badgeText(){
                return (this.enviadosCount + ' envíos');
            },

            disabledButton(){
                
                if (this.carchivos==0) {
                    return true;
                } else {
                    return false;
                }   
            },
            
        },

        
    }

</script>
