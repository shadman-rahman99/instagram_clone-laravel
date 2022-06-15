
<template>
  <div>
  <button class="btn btn-primary p-2" style="font-size:15px;" @click="ReactToComment" v-text="buttonText"></button>
  </div>
</template>

<script>
    export default {

       props: ['commentId','reacts',],

        mounted() {
            console.log('Component mounted.')
        },

       data: function() {
       return {
       status: this.reacts,
        }
       },

        methods: {

            ReactToComment()
            {
              axios.post('/commentReact/'+this.commentId+'/store')
                  .then(response=> {
                   this.status = ! this.status;
                   console.log(response.data);
                  })
                  .catch(errors => {
                  if(errors.response.status == 401){
                      window.location = '/login';
                    }
                  });
            }
        },


        computed: {
        buttonText()
        {
        return (this.status) ? 'Unlike' : 'Like';
           }
        },
    }
</script>
