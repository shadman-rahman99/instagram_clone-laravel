
<template>
  <div>
  <button class="btn btn-primary p-2" style="font-size:20px;" @click="ReactToPost" v-text="buttonText"></button>
  </div>
</template>

<script>
    export default {

       props: ['userId','postId','reacts','reactCnt',],

        mounted() {
            console.log('Component mounted.')
        },

       data: function() {
       return {
       status: this.reacts,
        }
       },

        methods: {

            ReactToPost()
            {
              axios.post('/React/'+this.userId+'/'+this.postId+'/store')
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
        return (this.status) ? 'Unlike' : this.reactCnt+' Like';
           }
        },
    }
</script>
