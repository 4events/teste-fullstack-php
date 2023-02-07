<script>
export default {
  props: {
    marcaItem: {
      type: String,
      required: true,
    },
    tituloItem: {
      type: String,
      required: true,
    },
    anoItem: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
    };
  },
  methods: {
  },
};
</script>

<template>
  <div class="list-a-item">
      <div class="list-a-item-txt">
          <div class="txt-titulo">{{ tituloItem }}</div>
          <div class="txt-marca">{{ marcaItem }}</div>
          <div>{{ anoItem }}</div>
      </div>
      <div class="list-a-item-index">
          <font-awesome-icon icon="fa-solid fa-tag" size="2x"/>
      </div>
  </div>
</template>

<style scoped>
.list-a-item{
  background-color: white;
  margin:10px;
  padding: 10px;
  height: 92px;
}
.list-a-item.selected > div
{
  color: green;
}
.list-a-item-txt{
  float: left;
}
.list-a-item-txt{
  background-color: transparent;
}
.list-a-item-index {
  float: right;
}
.list-a-item-none{
  background-color: white;
  margin:10px;
  padding: 10px;
  text-align: center;
}
.txt-titulo{
  font-size: 18px;
  font-weight: 500;
}
.txt-marca{
  font-size: 14px;
  text-transform: capitalize;
}
</style>
