<template>
    <div>
        <span style="color:#e61c9b; cursor:pointer;" class='bi bi-trash' @click="BorrarFila"></span>
    </div>

</template>

<script>
import axios from 'axios'

    export default {
        props: ['usuarioId'],

        mounted() {
            console.log('Component mounted.');
            
        },

        

        methods:{
            BorrarFila() {
                console.log('userId ' + this.userId);
                axios.delete('/usuarios/56')
                       
                    .then(response => {

                        console.log('Adentro');
                        console.log('userId ' + this.userId);
                        alert('Registro eliminado');
                                            
                    });
            }
        },

        
    }
</script>
