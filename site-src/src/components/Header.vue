<script>
import InputText from 'primevue/inputtext';

export default {
  components:{
    InputText
  },
	data() {
		return {
      searchText: "",
      hasSearch: false
    }
	},
  watch: {
    "searchText": function () {
      if(this.searchText != "" && this.searchText.length >= 2){
        this.hasSearch = true;
      }
    }
  },
  methods: {
    setSearchText(){
      if(this.searchText != ""){
        this.$store.state.searchBarText = this.searchText;
      }else{
        this.$store.state.searchBarText = "";
      }
      this.hasSearch = false;
    }
  }
}
</script>

<template>
  <div class="grid">
      <div id="brand" class="col-6">
          <div id="brand-logo">
            <font-awesome-icon icon="fa-solid fa-droplet" size="2x"/>
          </div>
          <div id="brand-text"> FULLSTACK </div>
      </div>
      <div id="search" class="col-6">
        <span class="p-input-icon-right">
          <InputText id="search-bar" type="text" v-model="searchText" v-on:keyup.enter="setSearchText()" v-on:keyup.backspace="setSearchText()" placeholder="BUSCA por veículos..."/>
           <i class="pi" :class="{'pi-spin pi-spinner' : hasSearch }" />
           </span>  
      </div>
    </div>
</template>

<style scoped>
#brand{
  width: 50%;
  float: left;
  background-color: #364147;
  color: white;
  padding: 10px;
  padding-left: 30px;

}
#brand-logo{
  float: left;
  font-size: 20px;
}
#brand-text{
  float: left;
  font-size: 20px;
  padding-top: 5px;
  padding-left: 10px;
  font-weight: bolder;
}
#search{
  float: left;
  width: 50%;
  background-color: #2a3138;
  padding: 10px;

}
#search-bar{
  height: 44px;
  border: 0px;
  border-color: #2a3138;
  background-color: #2a3138;
  color: white;
  font-size: 20px;
  padding: 4px;
}
#search-bar:focus{
    outline: none;
    border-color: #5AB0DB;
}
#search-bar:hover {
    border: 1px solid #999;
}
</style>
