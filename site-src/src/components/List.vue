<script>
import axios from 'axios';
import Dialog from 'primevue/dialog';
import Button from 'primevue/button';
import InputText from 'primevue/inputtext';
import InputSwitch from 'primevue/inputswitch';
import BoxItem from './Item.vue';

const api_server = 'http://127.0.0.1:9501';
const actionHeaders = { headers: { 'Content-Type': 'multipart/form-data' } };

export default {
  components:{
    Dialog,
    Button,
    InputText,
    InputSwitch,
    BoxItem
  },
  data() {
    return {
      show: false,
      vTitulo: "",
      vAno: "",
      vDescricao: "",
      vMarca: "",
      vChecked: false,
      btCadastrar: false,
      btAtualizar: false,
      displayModal: false,
      selectedIndex: null,
      selectedItemId: null,
      seltectedItem: {},
      labelmodal: "Novo Veículo",
      itens: []
    }
  },
  mounted () {
    this.getVeiculos();
  },
  watch: {
    "$store.state.searchBarText": function () {
      if (this.$store.state.searchBarText != "" && this.$store.state.searchBarText.length >= 2) {
        this.hasSearch = true;
        let q = this.$store.state.searchBarText;
        this.findVeiculos(q);
      } else {
        this.hasSearch = false;
        this.getVeiculos();
      }
    },
  },
  methods: {
    showAlert(message) {
      this.$swal(message);
    },
    showSucessAlert() {
      this.$swal("Sucesso", "Dados cadastrado com sucesso!", "success");
    },
    showSucessUpdateAlert() {
      this.$swal("Sucesso", "Dados atualizados com sucesso!", "success");
    },
    showSucessDeleteAlert() {
      this.$swal("Sucesso", "Dados excluidos com sucesso!", "success");
    },
    showExcluirAlert(){
      this.$swal({
          title: 'Tem certeza que deseja excluir?',
          text: "Essa ação não pode ser revertida",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sim, excluir!',
          cancelButtonText: 'Não, cancelar!',
          buttonsStyling: true
      }).then((result) => {
          if(result.isConfirmed === true){
            this.excluir();
          }
      })
    },
    activate() {
      setTimeout(() => this.show = true, 60);
    },
    findVeiculos(q) {
       axios
         .get(api_server+"/veiculos/find?q="+q)
         .then((res) => {
            this.selectedItem = null;
            this.selectedIndex = null;
            this.itens = Object.assign({}, res.data);
            this.itens = this.objectToArray(this.itens);
         })
         .catch((error) => {
           console.log(error);
         });
    },
    getVeiculos() {
       axios
         .get(api_server+"/veiculos")
         .then((res) => {
            let item = Object.assign({}, res.data);
            this.itens = this.objectToArray(item);
         })
         .catch((error) => {
           console.log(error);
         });
    },
    objectToArray(obj){
        let arr = [];
        for(let i = 0; i < obj.rows; i++){
          arr.push(Object.assign({}, obj[i]));
        }
        return arr;
    },
    openCadModal(){
      this.labelmodal = "Novo veículo";
      this.displayModal = true;
      this.btCadastrar = true;
      this.btAtualizar = false;
      this.clearFields();
    },
    openEditModal(){
      this.labelmodal = "Editar veículo";
      this.displayModal = true;
      this.btAtualizar = true;
      this.fillEditableFields();
    },
    closeModal(){
      this.displayModal = false;
      this.btAtualizar = false;
      this.btCadastrar = false;
      this.clearFields();
    },
    fillEditableFields(){
      this.vTitulo = this.selectedItem.veiculo;
      this.vAno = this.selectedItem.ano;
      this.vDescricao = this.selectedItem.descricao;
      this.vMarca = this.selectedItem.id_marca;

      if(this.selectedItem.vendido == 1){
        this.vChecked = true ;
      }else{
        this.vChecked = false;
      }
    },
    clearFields(){
      this.vTitulo = "";
      this.vAno = "";
      this.vDescricao = "";
      this.vMarca = "";
      this.vChecked = false;
    },
    selectItem(itemId, i) { // seleciona item da lista de veiculos
      this.show = false;
      const result = this.itens.map(item => item.id_veiculo == itemId);
      if(result[i] == true){
        this.selectedIndex = i;
        this.selectedItemId = itemId;
        this.selectedItem = Object.assign({}, this.itens[i]);
        this.activate();
      }else{
        this.selectedIndex = null;
        this.selectedItem = {};
        this.selectedItemId = null;
      }
    },
    selectItemIndex(i) {
        this.selectedIndex = i;
        this.selectedItemId = this.itens[i].id_veiculo;
        this.selectedItem = Object.assign({}, this.itens[i]);
        console.log(Object.assign({}, this.itens[i]));
    },
    validadeFormData(){ // validacao basica do formulario
      if(this.vMarca !== "" && 
        this.vTitulo !== "" && 
        this.vAno !== "" && 
        this.vDescricao !== ""){
          return true;
        }else{
          return false;
        }
    },
    cadastrar(){ // cadastrar novo veiclo
      let formData = {
        action: 'cadastrar',
        id_marca: this.vMarca,
        veiculo: this.vTitulo,
        ano: this.vAno,
        descricao: this.vDescricao,
        vendido: this.vChecked ? 1 : 0
      }
      if(this.validadeFormData()){
        axios.post(api_server+"/veiculos", formData, actionHeaders)
          .then((res) => {
              console.log(Object.assign({}, res.data));

              this.closeModal();
              this.showSucessAlert();
              this.selectItemIndex(0);
              this.fillEditableFields();
          })
          .catch((error) => {
            console.log(error);
          });
        this.getVeiculos();
      }
    },
    atualizar(){ //atualizar cadastro
      let formData = {
        action: 'atualizar',
        id: this.selectedItemId,
        id_marca: this.vMarca,
        veiculo: this.vTitulo,
        ano: this.vAno,
        descricao: this.vDescricao,
        vendido: this.vChecked ? 1 : 0
      }
      if(this.validadeFormData()){
        axios.post(api_server+"/veiculos", formData, actionHeaders)
          .then((res) => {
              this.getVeiculos();
              this.showSucessUpdateAlert();
              this.closeModal();
              this.show = false;        
          })
          .catch((error) => {
            console.log(error);
        });
      }
    },
    excluir(){ // excluir cadastro
      let formData = {
        action: 'excluir',
        id: this.selectedItemId
      }
      axios.post(api_server+"/veiculos", formData, actionHeaders)
        .then((res) => {
            this.getVeiculos();
            this.showSucessDeleteAlert();   
            this.show = false;          
        })
        .catch((error) => {
          console.log(error);
      });
    }
  }
}
</script>

<template>
<div class="grid" >
  <div class="col-12">
    <div class="item-body">
      <div id="item-bar">
        <div id="item-add-bar" class="col-12">
          <div id="header-item-l">VEÍCULO</div>
          <div id="header-item-bt" class="col">
            <div id="add-button" @click="openCadModal()">
              <font-awesome-icon icon="fa-solid fa-plus" size="2x" />
            </div> 
          </div>
       </div>
     </div>
    </div>
  </div>
</div>

<div class="grid list-a">
  <div class="col-6">
    <div class="titulo-l">
      Lista de veículos
    </div>
    <div class="item-a">
      <div class="overflow-auto surface-overlay" style="height: 400px">
        <div class="item-a-item-none" v-if="!itens.length">
          NENHUM VEÍCULO DISPONÍVEL NO MOMENTO!
        </div>
        <BoxItem
          v-for="(item, i) in itens"
          :key="item.id_veiculo"
          :marcaItem="item.marca"
          :tituloItem="item.veiculo"
          :anoItem="item.ano"
          :isVendido="item.vendido"
          :class="{'selected': this.selectedIndex == i}"
          @click="selectItem(item.id_veiculo, i)"
        ></BoxItem>

      </div>
    </div>
  </div> 

<Transition>

  <div class="col-6" id="item-descricao" v-if="show && itens.length">
    <div class="titulo-l">
      Detalhes
    </div>
    <div class="selected" >
      <div v-if="selectedItem.vendido" class="vendido-a-item">Vendido</div>
      <div class="item-veic-val-txt ">{{ selectedItem ? selectedItem.veiculo : "" }}</div>
        <div class="grid item-val-item-text">
          <div class="col-6">
            Marca<br/>
            <div class="item-marca-val-txt">{{ selectedItem ? selectedItem.marca : "" }}</div>
          </div>
          <div class="col-6">
            Ano<br/>
            <div class="item-ano-val-txt">{{ selectedItem ? selectedItem.ano : "" }}</div>
          </div>
        </div>
        <div class="item-descricao-desc">
          {{ selectedItem ? selectedItem.descricao : "" }}
        </div>
    </div>

     <div class="line-item"></div>
    <div class="item-a-val-bar" v-if="selectedItem">
      <div class="item-a-val-button">
        <div id="edit-button" @click="openEditModal()">
          <font-awesome-icon icon="fa-solid fa-pen"/>
          <div id="edit-button-txt">EDITAR</div>
        </div> 
      </div>
      <div class="item-a-val-button">
        <div id="edit-button" @click="showExcluirAlert()">
          <font-awesome-icon icon="fa-solid fa-trash" />
          <div id="edit-button-txt">EXCLUIR</div>
        </div> 
      </div>
      <div class="item-a-item-tag tag-margin">
        <font-awesome-icon class="selected" icon="fa-solid fa-tag" size="2x"/>
      </div>
    </div>
  </div>
  </Transition> 
</div>

<Dialog v-model:visible="displayModal">
    <template #header>
		<h3>{{ labelmodal }}</h3>
	  </template>

    <div class="card">
      <div class="formgrid grid">

          <div class="field col-12 md:col-10">
              <label for="titulo">Veículo</label>
              <input v-model="vTitulo" id="titulo" type="text" class="text-base text-color surface-overlay p-2 border-1 border-solid surface-border border-round appearance-none outline-none focus:border-primary w-full">
          </div>
          <div class="field col-6 md:col-4">
              <label for="marca">Marca</label>
              <select v-model="vMarca" id="marca" class="w-full text-base text-color surface-overlay p-2 border-1 border-solid surface-border border-round outline-none focus:border-primary" style="appearance: auto">
                  <option value="1">FIAT</option>
                  <option value="2">CHEVROLET</option>
              </select>
          </div>

          <div class="field col-6 md:col-4">
            <label for="ano">Ano</label>
            <input v-model="vAno" id="ano" type="text" class="text-base text-color surface-overlay p-2 border-1 border-solid surface-border border-round appearance-none outline-none focus:border-primary w-full">
          </div>
          <div class="field col-6 md:col-">
            <label for="vendido">Vendido</label><br/>
            <InputSwitch v-model="vChecked" id="vendido"/>
          </div>

          <div class="field col-10">
              <label for="descricao">Descrição</label>
              <textarea v-model="vDescricao" id="descricao" type="text" rows="4" class="text-base text-color surface-overlay p-2 border-1 border-solid surface-border border-round appearance-none outline-none focus:border-primary w-full"></textarea>
          </div>
          
      </div>
  </div>

	<template #footer>
		<Button label="CADASTRAR" icon="pi pi-plus" v-if="btCadastrar"  @click="cadastrar()"/>
    <Button label="ATUALIZAR" icon="pi pi-plus" v-if="btAtualizar"  @click="atualizar()"/>
    <Button label="FECHAR" icon="pi pi-times"  @click="closeModal()"  class="p-button-text" />
	</template>
</Dialog>
</template>

<style scoped>
.line-item{
  border-bottom: 1px solid;
}
.list-a{
  display:flex;
  padding-left: 50px;
  padding-right: 50px;
  padding-bottom: 10px;
}
.titulo-l{
  font-size: 18px;
  padding-bottom: 10px;
}
.item-a{
  left: -20px;
}
.item-a-item{
  background-color: white;
  margin:10px;
  padding: 10px;
  height: 92px;
}
.item-a-item-tag .i-selected{
  color: green;
}
.item-a-item-txt{
  float: left;
}
.item-descricao-item-a{
  background-color: white;
}
.item-descricao-item-a .i-selected {
  background-color:#EDFBE1;
}
.item-a-item-txt{
  background-color: transparent;
}
.item-a-item-tag {
  float: right;
}
.item-a-val-bar {
  height: 80px;
  background-color:#EDFBE1;
}
.item-a-item-none{
  background-color: white;
  margin:10px;
  padding: 10px;
  text-align: center;
}
.item-descricao-a{
  background-color: white;
}

.item-a-item-txt{
  background-color: white;
}
.item-veic-val-txt{
  color: green;
  padding: 10px;
  padding-left: 18px;
  font-size: 25px;
}
.item-val-item-text{
  padding-left: 30px;
  padding-bottom: 30px;
}
.item-marca-val-txt{
  color: gray;
}
.item-ano-val-txt{
  color: gray;
}
.item-descricao-desc{
  padding: 5px 30px 30px 30px;
  text-align:justify;
}
#edit-button{
  background-color: #2a3138;
  width: 140px;
  height: 44px;
  color: white;
  font-size: 10px;
  padding-left: 15px;
  padding-top: 5px;
  cursor: pointer;
  font-size: 20px;
  float: left;
  margin-right: 10px;
}
#edit-button:hover{
  background-color: blue;
}
#edit-button-txt{
  display: inline;
  padding-left: 15px;
}
.item-a-val-bar{
  padding: 18px 0px 0px 15px;
}
.tag-margin{
  top: -4px;
  right: 10px;
  padding: 10px;
}
.selected{
  background-color:#EDFBE1;
}
.selected .item-a-item-tag {
  color: green;
}
.selected .item-a-item-txt{
  background-color:#EDFBE1;
}
.item-a-item-tag .selected{
  color: green;
}
.item-body{
  height: 100px;
  background-color: #e2e4e1;
  padding-left: 50px;
  padding-right: 50px;
}
#item-bar{
  top: -10px;
  border-bottom: 1px solid gray;
  padding-bottom: 15px;
}
#add-button{
  background-color: #2a3138;
  border-radius: 70px;
  width: 30px;
  height: 30px;
  color: white;
  font-size: 10px;
  padding-left: 6px;
  padding-top: 5px;
  cursor: pointer;
  
}
#add-button:hover{
  background-color: blue;
}
#header-item-l{
  font-size: 30px;
  top: 20px;
}
#header-item-bt{
  top: -32px;
  right: 10px;;
  float: right;
}
.vendido-a-item{
  float: right;
  background-color: red;
  width: 100px;
  font-size: 20px;
  font-weight: 500;
  color: white;
  padding-left: 14px;
  margin-top: -4px;
  -webkit-transform: skew(-15deg); /* Chrome, Opera */
      -ms-transform: skew(-15deg); /* IE */
          transform: skew(-15deg); /* Padrão */
}

/*** Transicao ***/
.v-enter-active,
.v-leave-active {
  transition: opacity 0.2s ease;
}
.v-enter-from,
.v-leave-to {
  opacity: 0;
}
/*** Transicao ***/

</style>
